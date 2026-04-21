@extends('layouts.app')
@section('content')

<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px">
    <h1> Lista de Inscripciones</h1>
    <a href="{{ route('inscripciones.create') }}" class="btn btn-primary">+ Nueva Inscripción</a>
</div>

@if(session('success'))
    <div class="alert-success">{{ session('success') }}</div>
@endif
@if(session('error'))
    <div class="alert-error">{{ session('error') }}</div>
@endif

<table>
    <thead>
        <tr><th>#</th><th>Estudiante</th><th>Curso</th><th>Fecha</th><th>Acciones</th></tr>
    </thead>
    <tbody>
        @forelse($inscripciones as $ins)
        <tr>
            <td>{{ $ins->id }}</td>
            <td><strong>{{ $ins->estudiante->nombre }}</strong></td>
            <td>{{ $ins->curso->nombre }}</td>
            <td>{{ $ins->created_at->format('d/m/Y') }}</td>
            <td>
                <form action="{{ route('inscripciones.destroy', $ins) }}" method="POST">
                    @csrf @method('DELETE')
                    <button class="btn btn-danger" onclick="return confirm('¿Cancelar inscripción?')">Cancelar</button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="5" style="text-align:center; color:#9ca3af; padding:30px">No hay inscripciones registradas.</td>
        </tr>
        @endforelse
    </tbody>
</table>

@endsection