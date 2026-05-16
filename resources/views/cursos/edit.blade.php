@extends('layouts.app')
@section('content')

<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px">
    <h1> Editar Curso</h1>
    <a href="{{ route('cursos.index') }}" class="btn btn-secondary">← Volver</a>
</div>

<form action="{{ route('cursos.update', $curso) }}" method="POST">
    @csrf @method('PUT')
    <div class="form-group">
        <label>Nombre del curso</label>
        <input type="text" name="nombre" value="{{ $curso->nombre }}" required>
        @error('nombre') <p class="form-error">{{ $message }}</p> @enderror
    </div>
    <div class="form-group">
        <label>Descripción</label>
        <textarea name="descripcion" rows="3">{{ $curso->descripcion }}</textarea>
    </div>
    <div class="form-group">
        <label>Cupos</label>
        <input type="number" name="cupos" value="{{ $curso->cupos }}" min="1" required>
        @error('cupos') <p class="form-error">{{ $message }}</p> @enderror
    </div>
    <div class="form-group">
        <label>Precio del curso</label>
        <input type="number" name="precio" step="0.01" min="0"
               value="{{ old('precio', $curso->precio ?? 0) }}"
               placeholder="0 = Gratis">
        <small style="color:#6b7280">Deja en 0 si el curso es gratis</small>
        @error('precio') <p class="form-error">{{ $message }}</p> @enderror
    </div>
    <button type="submit" class="btn btn-warning">Actualizar</button>
</form>

@endsection