<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    protected $fillable = ['nombre', 'descripcion', 'cupos'];

    public function inscripciones()
    {
        return $this->hasMany(Inscripcion::class);
    }

    public function estudiantes()
    {
        return $this->belongsToMany(Estudiante::class, 'inscripciones');
    }

    public function cuposDisponibles()
    {
        return $this->cupos - $this->inscripciones()->count();
    }
}
