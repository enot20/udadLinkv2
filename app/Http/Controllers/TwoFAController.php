<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Contracts\Encryption\EncryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PragmaRX\Google2FALaravel\Google2FA;

class TwoFAController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('validateCode');
    }

    /**
     * Mostrar formulario para activar 2FA.
     */
    public function enable()
    {
        $user = Auth::user();

        if ($user->google2fa_enabled) {
            return redirect()->route('profile.edit')->with('status', '2FA ya está activado.');
        }

        $google2fa = new Google2FA(request());

        if (session()->has('google2fa_secret_temp')) {
            $secret = session('google2fa_secret_temp');
        } else {
            $secret = $google2fa->generateSecretKey();
            session(['google2fa_secret_temp' => $secret]);
        }

        $companyName = config('app.name', 'UCADLink');
        $imageUrl = $google2fa->getQRCodeInline($companyName, $user->email, $secret, 200);

        return view('profile.two-factor-enable', compact('imageUrl', 'secret'));
    }

    /**
     * Guardar y activar 2FA.
     */
    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|digits:6',
        ], [
            'code.required' => 'El código es requerido.',
            'code.digits' => 'El código debe tener exactamente 6 dígitos.',
        ]);

        $user = Auth::user();
        $secret = session('google2fa_secret_temp');

        if (! $secret) {
            return redirect()->route('2fa.enable')->withErrors(['code' => 'Sesión expirada. Por favor, intenta de nuevo.']);
        }

        $google2fa = new Google2FA(request());
        $valid = $google2fa->verifyKey($secret, $request->code);

        if ($valid) {
            try {
                $user->google2fa_secret = encrypt($secret);
            } catch (EncryptException $e) {
                return back()->withErrors(['code' => 'Error al guardar la clave. Por favor, intenta de nuevo.']);
            }
            $user->google2fa_enabled = true;
            $user->save();

            session()->forget('google2fa_secret_temp');
            session()->put('2fa_passed', true);

            return redirect()->route('profile.edit')->with('status', '¡2FA activado correctamente!');
        }

        return back()->withErrors(['code' => 'Código inválido. Por favor, verifica que el código de tu app esté correcto.']);
    }

    /**
     * Desactivar 2FA.
     */
    public function disable(Request $request)
    {
        $request->validate([
            'password' => 'required|string',
        ]);

        $user = Auth::user();

        if (! password_verify($request->password, $user->password)) {
            return back()->withErrors(['password' => 'Contraseña incorrecta.']);
        }

        $user->google2fa_secret = null;
        $user->google2fa_enabled = false;
        $user->save();

        $request->session()->forget('2fa_passed');
        $request->session()->forget('2fa_pending');

        return redirect()->route('profile.edit')->with('status', '2FA desactivado.');
    }

    /**
     * Mostrar formulario de validación 2FA.
     */
    public function validateForm()
    {
        $user = Auth::user();

        if (! $user->google2fa_enabled) {
            return redirect()->route('dashboard');
        }

        return view('auth.two-factor-challenge');
    }

    /**
     * Validar código 2FA.
     */
    public function validateCode(Request $request)
    {
        $request->validate([
            'code' => 'required|digits:6',
        ], [
            'code.required' => 'El código es requerido.',
            'code.digits' => 'El código debe tener exactamente 6 dígitos.',
        ]);

        $user = Auth::user();

        if (! $user || ! $user->google2fa_enabled || ! $user->google2fa_secret) {
            return redirect()->route('dashboard');
        }

        try {
            $secret = decrypt($user->google2fa_secret);
        } catch (DecryptException $e) {
            $user->google2fa_secret = null;
            $user->google2fa_enabled = false;
            $user->save();
            $request->session()->forget('2fa_passed');
            $request->session()->forget('2fa_pending');

            return redirect()->route('dashboard')->with('status', 'La configuración de 2FA ha sido reiniciada debido a un error de seguridad. Por favor, reactívalo.');
        }

        $google2fa = new Google2FA(request());
        $valid = $google2fa->verifyKey($secret, $request->code);

        if ($valid) {
            $request->session()->forget('2fa_pending');
            $request->session()->put('2fa_passed', true);

            return redirect()->intended(route('dashboard'));
        }

        return back()->withErrors(['code' => 'Código inválido. Por favor, verifica que el código de tu app esté actualizado.']);
    }
}
