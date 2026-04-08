<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PreventBackNavigation
{
    /**
     * Handle an incoming request.
     *
     * Previene que el usuario pueda navegar hacia atrás/adelante
     * usando los botones del navegador después de cerrar sesión
     * o acceder a páginas desde el historial.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Evitar que el navegador guarde en caché páginas autenticadas
        $response->headers->set('Cache-Control', 'no-cache, no-store, must-revalidate');
        $response->headers->set('Pragma', 'no-cache');
        $response->headers->set('Expires', '0');

        // Prevenir problemas con el botón atrás en aplicaciones sensibles
        $response->headers->set('X-Frame-Options', 'DENY');
        $response->headers->set('X-Content-Type-Options', 'nosniff');

        return $response;
    }
}
