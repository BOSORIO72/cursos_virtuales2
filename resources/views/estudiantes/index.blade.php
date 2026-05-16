@extends('layouts.app')
@section('content')

<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px">
    <h1> Lista de Estudiantes</h1>
    @if(auth()->user()->role == 'administrador' || auth()->user()->role == 'editor')
        <a href="{{ route('estudiantes.create') }}" class="btn btn-primary">+ Nuevo Estudiante</a>
    @endif
</div>

@if(session('success'))
    <div class="alert-success">{{ session('success') }}</div>
@endif

<div class="table-wrapper">
<table>
    <thead>
        <tr>
            <th>Nombre</th><th>Email</th><th>Teléfono</th><th>Cursos</th><th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @forelse($estudiantes as $est)
        <tr>
            <td><strong>{{ $est->nombre }}</strong></td>
            <td>{{ $est->email }}</td>
            <td>{{ $est->telefono ?? 'N/A' }}</td>
            <td>{{ $est->cursos->count() }}</td>
            <td>
                <div class="table-actions">
                    <a href="{{ route('estudiantes.show', $est) }}" class="btn btn-success">Ver</a>
                    @if(auth()->user()->role == 'administrador' || auth()->user()->role == 'editor')
                        <a href="{{ route('estudiantes.edit', $est) }}" class="btn btn-warning">Editar</a>
                    @endif
                    @if(auth()->user()->role == 'administrador')
                        <form action="{{ route('estudiantes.destroy', $est) }}" method="POST">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger" onclick="return confirm('¿Eliminar estudiante?')">Eliminar</button>
                        </form>
                    @endif
                </div>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="5" class="empty-state">No hay estudiantes registrados.</td>
        </tr>
        @endforelse
    </tbody>
</table>
</div>

@endsection