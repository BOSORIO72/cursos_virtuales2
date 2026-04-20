<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    protected $fillable = ['nombre', 'email', 'telefono'];

    public function cursos()
    {
        return $this->belongsToMany(Curso::class, 'inscripciones');
    }
}