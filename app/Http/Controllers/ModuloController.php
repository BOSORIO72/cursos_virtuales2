<?php

namespace App\Http\Controllers;

use App\Models\Modulo;
use App\Models\Curso;
use App\Models\Estudiante;
use App\Models\Acceso;
use Illuminate\Http\Request;

class ModuloController extends Controller
{
    public function index(Curso $curso)
    {
        $modulos = $curso->modulos;
        return view('modulos.index', compact('curso', 'modulos'));
    }

    public function create(Curso $curso)
    {
        return view('modulos.create', compact('curso'));
    }

    public function store(Request $request, Curso $curso)
    {
        $request->validate([
            'titulo'    => 'required|string|max:255',
            'contenido' => 'nullable|string',
            'orden'     => 'required|integer|min:1',
            'es_prueba' => 'boolean',
        ]);

        $data = $request->all();
        $data['curso_id']  = $curso->id;
        $data['es_prueba'] = $request->has('es_prueba');

        Modulo::create($data);
        return redirect()->route('cursos.modulos.index', $curso)
            ->with('success', 'Módulo creado correctamente.');
    }

    public function edit(Curso $curso, Modulo $modulo)
    {
        return view('modulos.edit', compact('curso', 'modulo'));
    }

    public function update(Request $request, Curso $curso, Modulo $modulo)
    {
        $request->validate([
            'titulo'    => 'required|string|max:255',
            'contenido' => 'nullable|string',
            'orden'     => 'required|integer|min:1',
        ]);

        $data = $request->all();
        $data['es_prueba'] = $request->has('es_prueba');

        $modulo->update($data);
        return redirect()->route('cursos.modulos.index', $curso)
            ->with('success', 'Módulo actualizado.');
    }

    public function destroy(Curso $curso, Modulo $modulo)
    {
        $modulo->delete();
        return redirect()->route('cursos.modulos.index', $curso)
            ->with('success', 'Módulo eliminado.');
    }

    public function ver(Curso $curso, Modulo $modulo)
    {
        $estudiante = Estudiante::where('email', auth()->user()->email)->first();

        if (!$modulo->es_prueba) {
            $tieneAcceso = false;
            if ($estudiante) {
                $acceso = Acceso::where('curso_id', $curso->id)
                    ->where('estudiante_id', $estudiante->id)
                    ->where('estado', 'aprobado')
                    ->first();
                $tieneAcceso = $acceso !== null;
            }

            if (!$tieneAcceso && auth()->user()->role !== 'administrador') {
                return redirect()->route('cursos.modulos.index', $curso)
                    ->with('error', 'Necesitas acceso completo para ver este módulo.');
            }
        }

        return view('modulos.ver', compact('curso', 'modulo'));
    }
}
