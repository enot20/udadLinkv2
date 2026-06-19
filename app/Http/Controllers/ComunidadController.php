<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

use App\Models\Documento; 

class ComunidadController extends Controller
{
        public function dashboard(): View
    {
        // Traemos los usuarios con sus proyectos para el feed
        $usuarios = User::with('proyectos')->latest()->get();
        $mensajes = []; 

        // Solo documentos del usuario autenticado
        $documentos = \App\Models\Documento::where('user_id', Auth::id())->get();

        return view('dashboard', compact('usuarios', 'mensajes', 'documentos'));
    }
   

    /**
     * Módulo 2: Sección Conectar / Miembros (Ruta: /conectar)
     */
    public function conectar(): View
    {
        $miembros = User::select('id', 'name', 'carrera', 'foto_perfil', 'carnet', 'email')
                        ->take(8)
                        ->get();

        return view('conectar', compact('miembros'));
    }

    public function index(): View
    {
        if (request()->is('conectar')) {
            return $this->conectar();
        }
        return $this->dashboard();
    }
}