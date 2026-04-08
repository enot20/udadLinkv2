
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

    // Dashboard Principal
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['verified'])->name('dashboard');

    // Perfil de Usuario
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
