<?php

// ───────────────────────────────────────────────────────────────
// Importación de Middlewares y clases fundamentales de Laravel
// ---------------------------------------------------------------
// Cada 'use' trae al alcance del archivo una clase específica.
// Los middlewares son piezas de lógica que se ejecutan antes o
// después de las peticiones HTTP, permitiendo aplicar seguridad,
// validaciones o transformaciones.
// ───────────────────────────────────────────────────────────────
use App\Http\Middleware\CheckSessionTimeout;       // Middleware personalizado: controla expiración de sesión
use App\Http\Middleware\PreventBackNavigation;     // Middleware personalizado: evita navegación hacia atrás tras logout
use App\Http\Middleware\Require2FA;                // Middleware personalizado: exige verificación en dos pasos (2FA)
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse; // Agrega cookies encoladas a la respuesta
use Illuminate\Cookie\Middleware\EncryptCookies;   // Encripta cookies para mayor seguridad
use Illuminate\Foundation\Application;             // Clase principal que representa la aplicación Laravel
use Illuminate\Foundation\Configuration\Exceptions;// Configuración centralizada de manejo de excepciones
use Illuminate\Foundation\Configuration\Middleware;// Configuración centralizada de middlewares
use Illuminate\Foundation\Http\Middleware\ValidateCsrfToken; // Protege contra ataques CSRF
use Illuminate\Http\Middleware\HandleCors;         // Maneja políticas CORS (Cross-Origin Resource Sharing)
use Illuminate\Routing\Middleware\SubstituteBindings; // Sustituye parámetros de ruta por modelos
use Illuminate\Session\Middleware\StartSession;    // Inicia y gestiona la sesión del usuario
use Illuminate\View\Middleware\ShareErrorsFromSession; // Comparte errores de validación con las vistas

// ───────────────────────────────────────────────────────────────
// Configuración de la aplicación Laravel
// ---------------------------------------------------------------
// Se crea y configura la instancia principal de la aplicación.
// Aquí se definen rutas, middlewares y manejo de excepciones.
// ───────────────────────────────────────────────────────────────
return Application::configure(basePath: dirname(__DIR__)) // Define la ruta base del proyecto

    // ───────────────────────────────────────────────────────────
    // Configuración de rutas
    // -----------------------------------------------------------
    // Se especifican los archivos que contienen las rutas web,
    // de consola y la ruta de salud (health check).
    // ───────────────────────────────────────────────────────────
    ->withRouting(
        web: __DIR__.'/../routes/web.php',       // Rutas HTTP tradicionales
        commands: __DIR__.'/../routes/console.php', // Comandos de consola Artisan
        health: '/up',                           // Ruta de verificación de estado
    )

    // ───────────────────────────────────────────────────────────
    // Configuración de Middlewares
    // -----------------------------------------------------------
    // Se definen alias y grupos de middlewares que se aplican
    // a las rutas. Esto permite organizar la lógica transversal
    // como seguridad, sesiones y validaciones.
    // ───────────────────────────────────────────────────────────
    ->withMiddleware(function (Middleware $middleware) {
        // Alias: permite referirse a un middleware con un nombre corto
        $middleware->alias([
            '2fa' => Require2FA::class, // Alias '2fa' apunta al middleware de doble autenticación
        ]);

        // Grupo 'web': conjunto de middlewares aplicados a todas las rutas web
        $middleware->group('web', [
            EncryptCookies::class,              // Encripta cookies
            AddQueuedCookiesToResponse::class,  // Agrega cookies encoladas
            StartSession::class,                // Inicia sesión
            ShareErrorsFromSession::class,      // Comparte errores con vistas
            ValidateCsrfToken::class,           // Protege contra CSRF
            SubstituteBindings::class,          // Sustituye parámetros de ruta
            HandleCors::class,                  // Maneja CORS
            PreventBackNavigation::class,       // Evita navegación hacia atrás
            CheckSessionTimeout::class,         // Controla expiración de sesión
        ]);
    })

    // ───────────────────────────────────────────────────────────
    // Configuración de Excepciones
    // -----------------------------------------------------------
    // Aquí se puede personalizar el manejo de errores y excepciones
    // de la aplicación. Actualmente está vacío, pero es el lugar
    // donde se definirían estrategias de logging o reportes.
    // ───────────────────────────────────────────────────────────
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })

    // ───────────────────────────────────────────────────────────
    // Creación final de la aplicación
    // -----------------------------------------------------------
    // Se devuelve la instancia configurada de la aplicación Laravel.
    // ───────────────────────────────────────────────────────────
    ->create();
