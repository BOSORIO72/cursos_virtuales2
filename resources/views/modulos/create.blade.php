@extends('layouts.app')
@section('content')

<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px">
    <h1>➕ Nuevo Módulo — {{ $curso->nombre }}</h1>
    <a href="{{ route('cursos.modulos.index', $curso) }}" class="btn btn-secondary">← Volver</a>
</div>

<form action="{{ route('cursos.modulos.store', $curso) }}" method="POST">
    @csrf
    <div class="form-group">
        <label>Título del módulo</label>
        <input type="text" name="titulo" value="{{ old('titulo') }}" required>
        @error('titulo') <p class="form-error">{{ $message }}</p> @enderror
    </div>
    <div class="form-group">
        <label>Contenido</label>
        <textarea name="contenido" rows="6"
                  placeholder="Escribe el contenido del módulo aquí...">{{ old('contenido') }}</textarea>
    </div>
    <div class="form-group">
        <label>Orden</label>
        <input type="number" name="orden" value="{{ old('orden', 1) }}" min="1" required>
    </div>
    <div class="form-group" style="display:flex; align-items:center; gap:10px">
        <input type="checkbox" name="es_prueba" id="es_prueba" value="1"
               {{ old('es_prueba') ? 'checked' : '' }}
               style="width:auto; margin:0">
        <label for="es_prueba" style="margin:0">
            Es módulo de prueba gratuita
            <small style="color:#6b7280; font-weight:normal">
                (los estudiantes sin pago pueden verlo)
            </small>
        </label>
    </div>
    <button type="submit" class="btn btn-primary">Guardar Módulo</button>
</form>

@endsection
