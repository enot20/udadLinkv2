<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    // ahora incluimos categoria_id
    protected $fillable = ['user_id', 'ruta', 'tipo', 'categoria_id', 'descripcion'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // relación con la tabla categorias
    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }
}
