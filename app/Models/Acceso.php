<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Acceso extends Model
{
    protected $table = 'accesos';
    protected $fillable = ['estudiante_id', 'curso_id', 'estado', 'fecha_solicitud', 'fecha_aprobacion'];

    protected $casts = [
        'fecha_solicitud'  => 'datetime',
        'fecha_aprobacion' => 'datetime',
    ];

    public function curso()
    {
        return $this->belongsTo(Curso::class);
    }

    public function estudiante()
    {
        return $this->belongsTo(Estudiante::class);
    }
}
