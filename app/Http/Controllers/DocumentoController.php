<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DocumentoController extends Controller
{
    public function show($id)
{
    $documento = \App\Models\Documento::findOrFail($id);

    // Si el archivo existe en storage, redirige directamente al archivo
    if ($documento->ruta && file_exists(storage_path('app/public/' . $documento->ruta))) {
        return response()->file(storage_path('app/public/' . $documento->ruta));
    }

    // Si no existe, muestra la vista con mensaje
   return view('show', compact('documento'));

}


}
