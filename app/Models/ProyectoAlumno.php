<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Proyecto extends Model
{
    /**
     * Los atributos que se pueden asignar masivamente.
     */
    protected $fillable = [
        'user_id',
        'titulo',
        'descripcion',
        'categoria'
    ];

    /**
     * RELACIÓN INVERSA: Un proyecto le pertenece a un estudiante (User)
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}