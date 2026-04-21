@extends('layouts.app')
@section('content')

<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px">
    <h1> Nuevo Curso</h1>
    <a href="{{ route('cursos.index') }}" class="btn btn-secondary">← Volver</a>
</div>

<form action="{{ route('cursos.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label>Nombre del curso</label>
        <input type="text" name="nombre" value="{{ old('nombre') }}" required>
        @error('nombre') <p class="form-error">{{ $message }}</p> @enderror
    </div>
    <div class="form-group">
        <label>Descripción</label>
        <textarea name="descripcion" rows="3">{{ old('descripcion') }}</textarea>
    </div>
    <div class="form-group">
        <label>Cupos disponibles</label>
        <input type="number" name="cupos" value="{{ old('cupos') }}" min="1" required>
        @error('cupos') <p class="form-error">{{ $message }}</p> @enderror
    </div>
    <button type="submit" class="btn btn-primary">Guardar Curso</button>
</form>

@endsection