@extends('layouts.app')
@section('content')

<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px">
    <h1> Lista de Cursos</h1>
    @if(auth()->user()->role == 'administrador' || auth()->user()->role == 'editor')
        <a href="{{ route('cursos.create') }}" class="btn btn-primary">+ Nuevo Curso</a>
    @endif
</div>

@if(session('success'))
    <div class="alert-success">{{ session('success') }}</div>
@endif

<div class="table-wrapper">
<table>
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Cupos totales</th>
            <th>Disponibles</th>
            <th>Precio</th>
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
                @if($curso->es_gratis)
                    <span style="background:#dcfce7; color:#065f46; padding:4px 10px;
                          border-radius:20px; font-size:13px; font-weight:600">
                        Gratis
                    </span>
                @else
                    <span style="background:#dbeafe; color:#1e40af; padding:4px 10px;
                          border-radius:20px; font-size:13px; font-weight:600">
                        ${{ number_format($curso->precio, 0, ',', '.') }}
                    </span>
                @endif
            </td>
            <td>
                <div class="table-actions">
                    @if(auth()->user()->role == 'administrador' || auth()->user()->role == 'editor')
                        <a href="{{ route('cursos.edit', $curso) }}" class="btn btn-warning">Editar</a>
                    @endif
                    <a href="{{ route('cursos.modulos.index', $curso) }}" class="btn btn-success">
                        Módulos
                    </a>
                    @if(auth()->user()->role == 'administrador')
                        <form action="{{ route('cursos.destroy', $curso) }}" method="POST">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger" onclick="return confirm('¿Eliminar este curso?')">Eliminar</button>
                        </form>
                    @endif
                </div>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="6" class="empty-state">
                No hay cursos registrados aún.
            </td>
        </tr>
        @endforelse
    </tbody>
</table>
</div>

@endsection