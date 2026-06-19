<?php

namespace App\Http\Controllers;

use App\Models\Documento;

class DocumentoController extends Controller
{
    public function index()
    {
        // Trae todos los documentos de todos los usuarios con su categoría
        $documentos = Documento::with(['user', 'categoria'])->get();

        // Renderiza la vista proyectos.blade.php con todos los documentos
        return view('proyectos', compact('documentos'));
    }

    public function show($id)
    {
        $documento = Documento::findOrFail($id);

        if ($documento->ruta && file_exists(storage_path('app/public/' . $documento->ruta))) {
            return response()->file(storage_path('app/public/' . $documento->ruta));
        }

        return view('documentos.show', compact('documento'));
    }
}
