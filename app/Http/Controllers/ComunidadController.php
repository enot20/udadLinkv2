<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;

class ComunidadController extends Controller
{
    public function index(): View
    {
        // Trae usuarios reales con las columnas que sí existen
        $miembros = User::select('id','name','carrera','foto_perfil','carnet','email')
                        ->take(8)
                        ->get();

        return view('conectar', compact('miembros'));
    }
}

