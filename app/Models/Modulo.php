<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Modulo extends Model
{
    protected $table = 'modulos';
    protected $fillable = ['curso_id', 'titulo', 'contenido', 'orden', 'es_prueba'];

    public function curso()
    {
        return $this->belongsTo(Curso::class);
    }
}
