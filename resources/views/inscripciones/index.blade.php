@extends('layouts.app')
@section('content')

<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px">
    <h1> Lista de Inscripciones</h1>
    @if(auth()->user()->role == 'administrador' || auth()->user()->role == 'editor')
        <a href="{{ route('inscripciones.create') }}" class="btn btn-primary">+ Nueva Inscripción</a>
    @endif
</div>

@if(session('success'))
    <div class="alert-success">{{ session('success') }}</div>
@endif
@if(session('error'))
    <div class="alert-error">{{ session('error') }}</div>
@endif

<div class="table-wrapper">
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
                @if(auth()->user()->role == 'administrador')
                    <form action="{{ route('inscripciones.destroy', $ins) }}" method="POST">
                        @csrf @method('DELETE')
                        <button class="btn btn-danger" onclick="return confirm('¿Cancelar inscripción?')">Cancelar</button>
                    </form>
                @endif
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="5" class="empty-state">No hay inscripciones registradas.</td>
        </tr>
        @endforelse
    </tbody>
</table>
</div>

@endsection