<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckSessionTimeout
{
    /**
     * Handle an incoming request.
     *
     * Verifica que la sesión sea válida y no haya expirado.
     * Redirige al login si la sesión es inválida.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Si no hay usuario autenticado, permitir acceso (el middleware auth maneja esto)
        if (! Auth::check()) {
            return $next($request);
        }

        // Verificar que la sesión esté activa
        $session = $request->session();

        // Si la sesión está expirada o no existe
        if (! $session->has('last_activity')) {
            $session->put('last_activity', time());
        }

        // Verificar timeout de sesión (30 minutos)
        $lastActivity = $session->get('last_activity', 0);
        $timeout = config('session.lifetime', 30) * 60; // en segundos

        if (time() - $lastActivity > $timeout) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect('/')->with('message', 'Tu sesión ha expirado. Por favor, inicia sesión nuevamente.');
        }

        // Actualizar last activity
        $session->put('last_activity', time());

        return $next($request);
    }
}
