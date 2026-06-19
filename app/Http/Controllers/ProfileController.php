<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use App\Models\Documento; // ✅ Importación correcta, arriba de la clase
use App\Models\Categoria; 


class ProfileController extends Controller
{
    /**
     * Mostrar el formulario de perfil del usuario.
     */
    public function edit(Request $request): View
{
    $user = $request->user();
    $categorias = Categoria::all(); // 👈 traemos todas las categorías

    return view('profile.edit', [
        'user' => $user,
        'categorias' => $categorias, // 👈 pasamos a la vista
    ]);
}

    /**
     * Actualizar la información del perfil (texto + imagen).
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        
        // Campos validados (name, carnet, carrera, email)
        $user->fill($request->validated());

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        // Procesar avatar
        if ($request->hasFile('avatar')) {
            if ($user->foto_perfil) {
                Storage::disk('public')->delete($user->foto_perfil);
            }

            $path = $request->file('avatar')->store('avatars', 'public');
            $user->foto_perfil = $path;
        }

        $user->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }
  /**
 * Subir archivos generales del perfil.
 */
public function subirArchivo(Request $request): RedirectResponse
{
    $request->validate([
        'nombre_archivo' => ['required', 'string', 'max:255'], 
        'archivo'        => ['required', 'file', 'max:10240'], 
        'categoria_id'   => ['required', 'exists:categorias,id'],
        'descripcion'    => ['required', 'string', 'max:1000'], 
    ]);

    // Guardar archivo físico
    $path = $request->file('archivo')->store('archivos', 'public');

    // Crear registro en DB
    Documento::create([
        'user_id'      => $request->user()->id,
        'ruta'         => $path,
        'tipo'         => $request->file('archivo')->getClientOriginalExtension(),
        'categoria_id' => $request->categoria_id,
        'descripcion'  => $request->descripcion,
    ]);

    return Redirect::route('profile.edit')
        ->with('status', 'Archivo subido con éxito: '.$path);
}


    /**
     * Eliminar la cuenta del usuario.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();
        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
