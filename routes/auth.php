<?php

// ───────────────────────────────────────────────────────────────
// Importación de controladores de autenticación
// ---------------------------------------------------------------
// Cada controlador gestiona una parte específica del flujo de login,
// registro, recuperación de contraseña y verificación de correo.
// ───────────────────────────────────────────────────────────────
use App\Http\Controllers\Auth\AuthenticatedSessionController;       // Maneja inicio y cierre de sesión
use App\Http\Controllers\Auth\ConfirmablePasswordController;        // Confirma contraseña antes de acciones sensibles
use App\Http\Controllers\Auth\EmailVerificationNotificationController; // Envía notificaciones de verificación de correo
use App\Http\Controllers\Auth\EmailVerificationPromptController;    // Muestra aviso para verificar correo
use App\Http\Controllers\Auth\NewPasswordController;                // Establece nueva contraseña tras reset
use App\Http\Controllers\Auth\PasswordController;                   // Actualiza contraseña del usuario autenticado
use App\Http\Controllers\Auth\PasswordResetLinkController;          // Envía enlace de recuperación de contraseña
use App\Http\Controllers\Auth\RegisteredUserController;             // Maneja registro de nuevos usuarios
use App\Http\Controllers\Auth\VerifyEmailController;                // Verifica dirección de correo electrónico
use Illuminate\Support\Facades\Route;                               // Facade para definir rutas en Laravel

// ───────────────────────────────────────────────────────────────
// Grupo de rutas para invitados (usuarios no autenticados)
// ---------------------------------------------------------------
// Se aplica el middleware 'guest', que asegura que estas rutas
// solo estén disponibles para usuarios que aún no han iniciado sesión.
// ───────────────────────────────────────────────────────────────
Route::middleware('guest')->group(function () {
    // Registro de usuario: formulario de creación
    Route::get('register', [RegisteredUserController::class, 'create'])
        ->middleware('guest')
        ->name('register');

    // Registro de usuario: envío de datos
    Route::post('register', [RegisteredUserController::class, 'store'])
        ->middleware('guest');

    // Login: formulario de inicio de sesión
    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    // Login: envío de credenciales
    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    // Recuperación de contraseña: formulario para solicitar enlace
    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');

    // Recuperación de contraseña: envío de correo con enlace
    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');

    // Reset de contraseña: formulario con token
    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');

    // Reset de contraseña: envío de nueva contraseña
    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->name('password.store');
});

// ───────────────────────────────────────────────────────────────
// Grupo de rutas para usuarios autenticados
// ---------------------------------------------------------------
// Se aplica el middleware 'auth', que asegura que estas rutas
// solo estén disponibles para usuarios que ya iniciaron sesión.
// ───────────────────────────────────────────────────────────────
Route::middleware('auth')->group(function () {
    // Aviso de verificación de correo
    Route::get('verify-email', EmailVerificationPromptController::class)
        ->name('verification.notice');

    // Verificación de correo: enlace firmado con id y hash
    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1']) // signed: valida firma, throttle: limita intentos
        ->name('verification.verify');

    // Reenvío de notificación de verificación de correo
    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1') // limita a 6 intentos por minuto
        ->name('verification.send');


        
    // Ruta para procesar la subida del archivo en el controlador
    Route::post('profile/subir-archivos', [ProfileController::class, 'subirArchivo'])
        ->middleware(['auth', 'throttle:10,1']) // Protegido y con límite de 10 subidas por minuto
        ->name('archivos.store');



    // Confirmación de contraseña: formulario
    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('password.confirm');

    // Confirmación de contraseña: envío de datos
    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    // Actualización de contraseña del usuario autenticado
    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    // Logout: se permite tanto con GET como con POST para compatibilidad
    Route::get('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});
