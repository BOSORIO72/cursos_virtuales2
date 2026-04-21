@extends('layouts.app')
@section('content')

<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px">
    <h1> Lista de Cursos</h1>
    <a href="{{ route('cursos.create') }}" class="btn btn-primary">+ Nuevo Curso</a>
</div>

@if(session('success'))
    <div class="alert-success">{{ session('success') }}</div>
@endif

<table>
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Cupos totales</th>
            <th>Disponibles</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @forelse($cursos as $curso)
        <tr>
            <td><strong>{{ $curso->nombre }}</strong></td>
            <td>{{ $curso->descripcion ?? 'Sin descripción' }}</td>
            <td>{{ $curso->cupos }}</td>
            <td>
                <span style="color: {{ $curso->cuposDisponibles() > 0 ? '#059669' : '#dc2626' }}; font-weight:bold">
                    {{ $curso->cuposDisponibles() }}
                </span>
            </td>
            <td>
                <div class="table-actions">
                    <a href="{{ route('cursos.edit', $curso) }}" class="btn btn-warning">Editar</a>
                    <form action="{{ route('cursos.destroy', $curso) }}" method="POST">
                        @csrf @method('DELETE')
                        <button class="btn btn-danger" onclick="return confirm('¿Eliminar este curso?')">Eliminar</button>
                    </form>
                </div>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="5" style="text-align:center; color:#9ca3af; padding:30px">
                No hay cursos registrados aún.
            </td>
        </tr>
        @endforelse
    </tbody>
</table>

@endsection