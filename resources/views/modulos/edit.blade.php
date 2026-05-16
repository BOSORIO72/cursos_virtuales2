@extends('layouts.app')
@section('content')

<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px">
    <h1>✏️ Editar Módulo — {{ $curso->nombre }}</h1>
    <a href="{{ route('cursos.modulos.index', $curso) }}" class="btn btn-secondary">← Volver</a>
</div>

<form action="{{ route('cursos.modulos.update', [$curso, $modulo]) }}" method="POST">
    @csrf @method('PUT')
    <div class="form-group">
        <label>Título del módulo</label>
        <input type="text" name="titulo" value="{{ old('titulo', $modulo->titulo) }}" required>
    </div>
    <div class="form-group">
        <label>Contenido</label>
        <textarea name="contenido" rows="6">{{ old('contenido', $modulo->contenido) }}</textarea>
    </div>
    <div class="form-group">
        <label>Orden</label>
        <input type="number" name="orden" value="{{ old('orden', $modulo->orden) }}" min="1" required>
    </div>
    <div class="form-group" style="display:flex; align-items:center; gap:10px">
        <input type="checkbox" name="es_prueba" id="es_prueba" value="1"
               {{ $modulo->es_prueba ? 'checked' : '' }}
               style="width:auto; margin:0">
        <label for="es_prueba" style="margin:0">Es módulo de prueba gratuita</label>
    </div>
    <button type="submit" class="btn btn-warning">Actualizar Módulo</button>
</form>

@endsection
