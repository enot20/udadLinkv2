<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class ComunidadController extends Controller
{
    /**
     * Módulo 1: Dashboard de Perfil (Ruta: /dashboard)
     */
    public function dashboard(): View
    {
        $usuarios = User::with('proyectos')->latest()->get();
        $mensajes = []; // Previene error de variable indefinida en el blade

        return view('dashboard', compact('usuarios', 'mensajes'));
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