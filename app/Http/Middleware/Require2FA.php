<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Require2FA
{
    /**
     * Rutas que deben ser excluidas de la verificación 2FA.
     */
    protected array $excludedRoutes = [
        '2fa.validate',
        '2fa.storeCode',
        '2fa.enable',
        '2fa.store',
        '2fa.disable',
        'logout',
    ];

    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        if (! $user) {
            return $next($request);
        }

        if (! $user->google2fa_enabled) {
            return $next($request);
        }

        if ($this->isExcludedRoute($request)) {
            return $next($request);
        }

        if ($request->session()->has('2fa_passed')) {
            return $next($request);
        }

        if ($request->session()->has('2fa_pending')) {
            return redirect()->route('2fa.validate');
        }

        return redirect()->route('2fa.validate');
    }

    /**
     * Verificar si la ruta actual está excluida.
     */
    protected function isExcludedRoute(Request $request): bool
    {
        foreach ($this->excludedRoutes as $route) {
            if ($request->routeIs($route)) {
                return true;
            }
        }

        return false;
    }
}
