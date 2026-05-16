<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    protected $fillable = ['nombre', 'descripcion', 'cupos', 'precio', 'es_gratis'];

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

    public function modulos()
    {
        return $this->hasMany(Modulo::class)->orderBy('orden');
    }

    public function modulosDePrueba()
    {
        return $this->hasMany(Modulo::class)->where('es_prueba', true)->orderBy('orden');
    }

    public function accesos()
    {
        return $this->hasMany(Acceso::class);
    }
}
