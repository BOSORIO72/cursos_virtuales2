<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Curso;

class CursoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
public function index()
{
    $cursos = Curso::all();
    return view('cursos.index', compact('cursos'));
}

public function create()
{
    return view('cursos.create');
}

public function store(Request $request)
{
    $request->validate([
        'nombre' => 'required',
        'cupos'  => 'required|integer|min:1',
        'precio' => 'nullable|numeric|min:0',
    ]);
    $data = $request->all();
    $data['es_gratis'] = $request->precio == 0 || $request->precio == null;
    Curso::create($data);
    return redirect()->route('cursos.index')->with('success', 'Curso creado.');
}

public function show(Curso $curso)
{
    return view('cursos.show', compact('curso'));
}

public function edit(Curso $curso)
{
    return view('cursos.edit', compact('curso'));
}

public function update(Request $request, Curso $curso)
{
    $request->validate([
        'nombre' => 'required',
        'cupos'  => 'required|integer|min:1',
        'precio' => 'nullable|numeric|min:0',
    ]);
    $data = $request->all();
    $data['es_gratis'] = $request->precio == 0 || $request->precio == null;
    $curso->update($data);
    return redirect()->route('cursos.index')->with('success', 'Curso actualizado.');
}

public function destroy(Curso $curso)
{
    $curso->delete();
    return redirect()->route('cursos.index')->with('success', 'Curso eliminado.');
}
}
