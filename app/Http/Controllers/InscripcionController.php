<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inscripcion;
use App\Models\Curso;
use App\Models\Estudiante;
use Illuminate\Support\Facades\DB;

class InscripcionController extends Controller
{
  public function index()
{
    $inscripciones = Inscripcion::with(['curso', 'estudiante'])->get();
    return view('inscripciones.index', compact('inscripciones'));
}

public function create()
{
    $cursos = Curso::all();
    $estudiantes = Estudiante::all();
    return view('inscripciones.create', compact('cursos', 'estudiantes'));
}

public function store(Request $request)
{
    $request->validate([
        'curso_id'      => 'required|exists:cursos,id',
        'estudiante_id' => 'required|exists:estudiantes,id',
    ]);

    $curso = Curso::find($request->curso_id);

    if ($curso->cuposDisponibles() <= 0) {
        return back()->with('error', 'No hay cupos disponibles en este curso.');
    }

    $existe = Inscripcion::where('curso_id', $request->curso_id)
        ->where('estudiante_id', $request->estudiante_id)
        ->exists();

    if ($existe) {
        return back()->with('error', 'El estudiante ya está inscrito en este curso.');
    }

    Inscripcion::create($request->all());
    return redirect()->route('inscripciones.index')->with('success', 'Inscripción realizada con éxito.');
}

public function destroy(Inscripcion $inscripcione)
{
    \Log::info('Objeto inscripcion: ' . json_encode($inscripcione->toArray()));

    $resultado = $inscripcione->delete();

    \Log::info('Resultado delete: ' . ($resultado ? 'true' : 'false'));

    return redirect()->route('inscripciones.index')->with('success', 'Inscripción cancelada.');
}
}
