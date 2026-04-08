<?php

namespace App\Http\Controllers\Auth; // Define el espacio de nombres: este controlador pertenece al módulo de autenticación

// ───────────────────────────────────────────────────────────────
// Importación de dependencias necesarias
// ---------------------------------------------------------------
// Se incluyen clases para manejar peticiones, respuestas, vistas,
// autenticación y validación de login.
// ───────────────────────────────────────────────────────────────
use App\Http\Controllers\Controller;       // Clase base de controladores en Laravel
use App\Http\Requests\Auth\LoginRequest;   // Request especializado para validar login
use Illuminate\Http\RedirectResponse;      // Clase para respuestas de redirección
use Illuminate\Http\Request;               // Representa la petición HTTP entrante
use Illuminate\Support\Facades\Auth;       // Facade para manejar autenticación de usuarios
use Illuminate\View\View;                  // Clase para renderizar vistas

// ───────────────────────────────────────────────────────────────
// Controlador de sesiones autenticadas
// ---------------------------------------------------------------
// Gestiona el ciclo de vida de la sesión del usuario:
// - Mostrar login
// - Procesar autenticación
// - Cerrar sesión
// ───────────────────────────────────────────────────────────────
class AuthenticatedSessionController extends Controller
{
    /**
     * Mostrar la vista de login.
     * -------------------------------------------------------------
     * En este caso, redirige directamente al login principal (/).
     * Se utiliza RedirectResponse para enviar al usuario a la ruta raíz.
     */
    public function create(): RedirectResponse
    {
        return redirect('/');
    }

    /**
     * Procesar una solicitud de autenticación entrante.
     * -------------------------------------------------------------
     * 1. Valida credenciales mediante LoginRequest::authenticate().
     * 2. Regenera la sesión para evitar ataques de fijación de sesión.
     * 3. Verifica si el usuario tiene 2FA activado.
     *    - Si sí: marca la sesión como pendiente de 2FA y redirige al reto.
     *    - Si no: redirige al dashboard.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate(); // Ejecuta validación de credenciales

        $request->session()->regenerate(); // Regenera ID de sesión por seguridad

        $user = Auth::user(); // Obtiene el usuario autenticado

        // Si el usuario tiene 2FA activado, se marca como pendiente
        if ($user->google2fa_enabled) {
            $request->session()->put('2fa_pending', true);

            return redirect()->route('2fa.validate'); // Redirige al reto 2FA
        }

        // Si no tiene 2FA, redirige al dashboard
        return redirect()->intended(route('dashboard', absolute: false));
    }

    /**
     * Cerrar una sesión autenticada.
     * -------------------------------------------------------------
     * 1. Cierra sesión en el guard 'web'.
     * 2. Invalida la sesión actual y regenera el token CSRF.
     * 3. Redirige al inicio con cabeceras que previenen el uso del
     *    botón atrás (evita que el navegador muestre páginas cacheadas).
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout(); // Cierra sesión del usuario

        $request->session()->invalidate();      // Invalida sesión actual
        $request->session()->regenerateToken(); // Regenera token CSRF

        // Redirige al inicio y fuerza cabeceras anti-cache
        return redirect('/')->withHeaders([
            'Cache-Control' => 'no-cache, no-store, must-revalidate',
            'Pragma' => 'no-cache',
            'Expires' => '0',
        ]);
    }
}
