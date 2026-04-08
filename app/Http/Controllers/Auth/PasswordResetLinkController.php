<?php

namespace App\Http\Controllers\Auth; // Espacio de nombres: este controlador pertenece al módulo de autenticación

// ───────────────────────────────────────────────────────────────
// Importación de dependencias
// ---------------------------------------------------------------
// Se incluyen clases y facades para manejar controladores,
// peticiones HTTP, usuarios, base de datos, logs, envío de correos
// y generación de cadenas aleatorias.
// ───────────────────────────────────────────────────────────────
use App\Http\Controllers\Controller;   // Clase base de controladores
use App\Mail\BypassSendmail;           // Clase personalizada para enviar correos sin usar el pipeline estándar
use App\Models\User;                   // Modelo Eloquent que representa la tabla 'users'
use Illuminate\Http\RedirectResponse;  // Clase para respuestas de redirección
use Illuminate\Http\Request;           // Representa la petición HTTP entrante
use Illuminate\Support\Facades\DB;     // Facade para interactuar con la base de datos
use Illuminate\Support\Facades\Log;    // Facade para registrar logs
use Illuminate\Support\Facades\Password;// Facade para funciones de recuperación de contraseña
use Illuminate\Support\Str;            // Utilidad para generar cadenas aleatorias
use Illuminate\View\View;              // Clase para renderizar vistas

// ───────────────────────────────────────────────────────────────
// Controlador para enlaces de recuperación de contraseña
// ---------------------------------------------------------------
// Gestiona el flujo de "olvidé mi contraseña":
// - Mostrar formulario
// - Validar correo institucional
// - Generar token seguro
// - Guardar token en BD
// - Enviar correo con enlace de recuperación
// ───────────────────────────────────────────────────────────────
class PasswordResetLinkController extends Controller
{
    /**
     * Mostrar formulario de recuperación de contraseña.
     * -------------------------------------------------------------
     * Retorna la vista 'auth.forgot-password' donde el usuario
     * puede ingresar su correo institucional.
     */
    public function create(): View
    {
        return view('auth.forgot-password');
    }

    /**
     * Procesar solicitud de recuperación de contraseña.
     * -------------------------------------------------------------
     * 1. Valida que el correo sea institucional (@ucad.edu.sv).
     * 2. Verifica que el usuario exista en la base de datos.
     * 3. Genera un token seguro y lo guarda hasheado en la tabla
     *    'password_reset_tokens'.
     * 4. Construye la URL de recuperación con el token sin hashear.
     * 5. Renderiza el correo y lo envía usando BypassSendmail.
     * 6. Si falla, intenta con el mecanismo estándar de Laravel.
     */
    public function store(Request $request): RedirectResponse
    {
        // Validación del correo: requerido, formato válido y dominio institucional
        $request->validate([
            'email' => ['required', 'email', 'ends_with:ucad.edu.sv'],
        ], [
            'email.ends_with' => 'El correo debe ser institucional (@ucad.edu.sv)',
        ]);

        // Buscar usuario en la base de datos
        $user = User::where('email', $request->email)->first();

        // Si no existe, retorna error
        if (! $user) {
            return back()->withInput($request->only('email'))
                ->withErrors(['email' => 'No se pudo enviar el enlace de recuperación. Verifica que el correo esté registrado.']);
        }

        // Generar token seguro y hashearlo para almacenar en BD
        $token = Str::random(64);       // Token en texto plano
        $hashedToken = bcrypt($token);  // Token hasheado

        // Insertar o actualizar token en la tabla 'password_reset_tokens'
        if (! DB::table('password_reset_tokens')->where('email', $request->email)->exists()) {
            DB::table('password_reset_tokens')->insert([
                'email' => $request->email,
                'token' => $hashedToken,
                'created_at' => now(),
            ]);
        } else {
            DB::table('password_reset_tokens')->where('email', $request->email)->update([
                'token' => $hashedToken,
                'created_at' => now(),
            ]);
        }

        // Generar URL de recuperación con el token sin hashear
        $url = route('password.reset', ['token' => $token, 'email' => $request->email]);

        // Renderizar cuerpo del correo usando vista 'emails.password-reset'
        $body = view('emails.password-reset', [
            'name' => $user->name,
            'url' => $url,
            'expires' => 60, // Tiempo de expiración en minutos
        ])->render();

        // Registrar intento de envío en logs
        Log::info('Intentando enviar email de recuperación a: '.$request->email);

        // Enviar correo usando bypass (método alternativo)
        $sent = BypassSendmail::sendHtml(
            $request->email,
            'Recuperar tu contraseña - UCADLink',
            $body
        );

        // Registrar resultado en logs
        Log::info('Resultado del envío: '.($sent ? 'Éxito' : 'Fallido'));

        // Si el envío fue exitoso, retorna mensaje de confirmación
        if ($sent) {
            return back()->with('status', 'Se ha enviado el enlace de recuperación a tu correo.');
        }

        // Si falla, intentar con el mecanismo estándar de Laravel
        $status = Password::sendResetLink($request->only('email'));

        return $status == Password::RESET_LINK_SENT
            ? back()->with('status', 'Se ha enviado el enlace de recuperación a tu correo.')
            : back()->withInput($request->only('email'))
                ->withErrors(['email' => 'No se pudo enviar el enlace de recuperación. Intenta más tarde.']);
    }
}
