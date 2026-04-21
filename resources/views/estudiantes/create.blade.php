@extends('layouts.app')
@section('content')

<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px">
    <h1>Nuevo Estudiante</h1>
    <a href="{{ route('estudiantes.index') }}" class="btn btn-secondary">← Volver</a>
</div>

<form action="{{ route('estudiantes.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label>Nombre completo</label>
        <input type="text" name="nombre" value="{{ old('nombre') }}" required>
        @error('nombre') <p class="form-error">{{ $message }}</p> @enderror
    </div>
    <div class="form-group">
        <label>Email</label>
        <input type="email" name="email" value="{{ old('email') }}" required>
        @error('email') <p class="form-error">{{ $message }}</p> @enderror
    </div>
    <div class="form-group">
        <label>Teléfono (opcional)</label>
        <input type="text" name="telefono" value="{{ old('telefono') }}">
    </div>
    <button type="submit" class="btn btn-primary">Guardar Estudiante</button>
</form>

@endsection