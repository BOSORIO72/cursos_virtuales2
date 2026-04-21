@extends('layouts.app')
@section('content')

<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px">
    <h1>{{ $curso->nombre }}</h1>
    <a href="{{ route('cursos.index') }}" class="btn btn-secondary">← Volver</a>
</div>

<p><strong>Descripción:</strong> {{ $curso->descripcion ?? 'Sin descripción' }}</p>
<p style="margin-top:10px"><strong>Cupos totales:</strong> {{ $curso->cupos }}</p>
<p style="margin-top:10px"><strong>Cupos disponibles:</strong>
    <span style="color:{{ $curso->cuposDisponibles() > 0 ? '#059669' : '#dc2626' }}; font-weight:bold">
        {{ $curso->cuposDisponibles() }}
    </span>
</p>

<h2 style="margin-top:30px; margin-bottom:15px; font-size:18px">Estudiantes inscritos</h2>
<table>
    <thead><tr><th>Nombre</th><th>Email</th></tr></thead>
    <tbody>
        @forelse($curso->estudiantes as $est)
        <tr>
            <td>{{ $est->nombre }}</td>
            <td>{{ $est->email }}</td>
        </tr>
        @empty
        <tr><td colspan="2" style="text-align:center; color:#9ca3af; padding:20px">Sin estudiantes inscritos.</td></tr>
        @endforelse
    </tbody>
</table>

@endsection