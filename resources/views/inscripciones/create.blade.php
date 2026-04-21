@extends('layouts.app')
@section('content')

<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px">
    <h1>Nueva Inscripción</h1>
    <a href="{{ route('inscripciones.index') }}" class="btn btn-secondary">← Volver</a>
</div>

@if(session('error'))
    <div class="alert-error">{{ session('error') }}</div>
@endif

<form action="{{ route('inscripciones.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label>Estudiante</label>
        <select name="estudiante_id" required>
            <option value="">-- Selecciona un estudiante --</option>
            @foreach($estudiantes as $est)
                <option value="{{ $est->id }}">{{ $est->nombre }} ({{ $est->email }})</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label>Curso</label>
        <select name="curso_id" required>
            <option value="">-- Selecciona un curso --</option>
            @foreach($cursos as $curso)
                <option value="{{ $curso->id }}">
                    {{ $curso->nombre }} — {{ $curso->cuposDisponibles() }} cupos disponibles
                </option>
            @endforeach
        </select>
    </div>
    <button type="submit" class="btn btn-success">Inscribir Estudiante</button>
</form>

@endsection