<?php

namespace App\Http\Controllers;

use App\Models\Acceso;
use App\Models\Curso;
use App\Models\Estudiante;
use Illuminate\Http\Request;

class AccesoController extends Controller
{
    public function solicitar(Curso $curso)
    {
        $estudiante = Estudiante::where('email', auth()->user()->email)->first();

        if (!$estudiante) {
            return back()->with('error', 'Tu usuario no está registrado como estudiante.');
        }

        $yaExiste = Acceso::where('curso_id', $curso->id)
            ->where('estudiante_id', $estudiante->id)
            ->exists();

        if ($yaExiste) {
            return back()->with('error', 'Ya tienes una solicitud de acceso para este curso.');
        }

        Acceso::create([
            'curso_id'        => $curso->id,
            'estudiante_id'   => $estudiante->id,
            'estado'          => 'pendiente',
            'fecha_solicitud' => now(),
        ]);

        return back()->with('success', 'Solicitud enviada. El administrador revisará tu pago.');
    }

    public function index()
    {
        $accesos = Acceso::with(['curso', 'estudiante'])
            ->orderBy('estado')
            ->orderBy('created_at', 'desc')
            ->get();
        return view('accesos.index', compact('accesos'));
    }

    public function aprobar(Acceso $acceso)
    {
        $acceso->update([
            'estado'           => 'aprobado',
            'fecha_aprobacion' => now(),
        ]);
        return back()->with('success', 'Acceso aprobado correctamente.');
    }

    public function rechazar(Acceso $acceso)
    {
        $acceso->update(['estado' => 'rechazado']);
        return back()->with('success', 'Acceso rechazado.');
    }
}
