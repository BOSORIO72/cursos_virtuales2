@extends('layouts.app')
@section('content')

<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px">
    <h1>✏️ Editar Estudiante</h1>
    <a href="{{ route('estudiantes.index') }}" class="btn btn-secondary">← Volver</a>
</div>

<form action="{{ route('estudiantes.update', $estudiante) }}" method="POST">
    @csrf @method('PUT')
    <div class="form-group">
        <label>Nombre completo</label>
        <input type="text" name="nombre" value="{{ $estudiante->nombre }}" required>
        @error('nombre') <p class="form-error">{{ $message }}</p> @enderror
    </div>
    <div class="form-group">
        <label>Email</label>
        <input type="email" name="email" value="{{ $estudiante->email }}" required>
        @error('email') <p class="form-error">{{ $message }}</p> @enderror
    </div>
    <div class="form-group">
        <label>Teléfono</label>
        <input type="text" name="telefono" value="{{ $estudiante->telefono }}">
    </div>
    <button type="submit" class="btn btn-warning">Actualizar</button>
</form>

@endsection