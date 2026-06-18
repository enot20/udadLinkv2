<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TwoFAController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Ruta de inicio
Route::get('/', function () {
    return view('welcome');
});

// Verificación de email en tiempo real (Pública)
Route::post('/check-email', function (Request $request) {
    $email = $request->email;

    if (! filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return response()->json(['exists' => false, 'message' => 'Formato inválido']);
    }

    $userExists = User::where('email', $email)->exists();

    return response()->json([
        'exists' => $userExists,
        'message' => $userExists ? 'Usuario encontrado' : 'Usuario no registrado',
    ]);
})->name('check.email');

// Rutas de Autenticación (Login, Registro, Password, etc.)
require __DIR__.'/auth.php';

// ==========================================================
// GRUPO 1: Rutas de VALIDACIÓN 2FA (Solo requieren 'auth')
// Importante: NO llevan el middleware '2fa' para evitar bucles.
// Aquí el usuario llega cuando el middleware lo redirige.
// ==========================================================
Route::middleware('auth')->group(function () {
    // Mostrar formulario de desafío
    Route::get('/2fa/validate', [TwoFAController::class, 'validateForm'])->name('2fa.validate');

    // Procesar el código ingresado
    Route::post('/2fa/validate', [TwoFAController::class, 'validateCode'])->name('2fa.storeCode');

    // Gestión 2FA - enable requiere sesión normal, disable requiere password
    Route::get('/2fa/enable', [TwoFAController::class, 'enable'])->name('2fa.enable');
    Route::post('/2fa/store', [TwoFAController::class, 'store'])->name('2fa.store');
    Route::post('/2fa/disable', [TwoFAController::class, 'disable'])->name('2fa.disable');
});

// ==========================================================
// GRUPO 2: Rutas PROTEGIDAS CON 2FA (Requieren 'auth' + '2fa')
// El middleware '2fa' verificará si falta validar y redirigirá al Grupo 1.
// ==========================================================
Route::middleware(['auth', '2fa'])->group(function () {

// Ruta para el Dashboard (Llama a la función dashboard)
Route::get('/dashboard', 'App\Http\Controllers\ComunidadController@dashboard')
    ->name('dashboard')
    ->middleware(['auth', 'verified']);

// Ruta para Conectar (Llama a la función conectar)
Route::get('/conectar', 'App\Http\Controllers\ComunidadController@conectar')
    ->name('conectar')
    ->middleware(['auth']);



    // Nosotros
    Route::get('/nosotros', function () {
        return view('nosotros');
    })->name('nosotros');



    // Proyectos
    Route::get('/proyectos', function () {
        return view('proyectos');
    })->name('proyectos');

    // Conectar
    Route::get('/conectar', function () {
    return view('conectar');
    })->name('conectar');

    Route::get('/conectar', [\App\Http\Controllers\ComunidadController::class, 'index'])
    ->name('conectar');


    // Perfil de Usuario
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Ruta exclusiva para subir la foto de perfil
    Route::post('/profile/avatar', [ProfileController::class, 'updateAvatar'])->name('profile.avatar');
    
    Route::post('/profile/subir-archivos', [ProfileController::class, 'subirArchivo'])
    ->middleware(['auth', 'throttle:10,1'])
    ->name('archivos.store');

    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});