@extends('layouts.app')
@section('content')

<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px">
    <h1>{{ $estudiante->nombre }}</h1>
    <a href="{{ route('estudiantes.index') }}" class="btn btn-secondary">← Volver</a>
</div>

<p><strong>Email:</strong> {{ $estudiante->email }}</p>
<p style="margin-top:10px"><strong>Teléfono:</strong> {{ $estudiante->telefono ?? 'N/A' }}</p>

<h2 style="margin-top:30px; margin-bottom:15px; font-size:18px">Cursos inscritos</h2>
<table>
    <thead><tr><th>Curso</th><th>Cupos disponibles</th></tr></thead>
    <tbody>
        @forelse($estudiante->cursos as $curso)
        <tr>
            <td>{{ $curso->nombre }}</td>
            <td style="color:{{ $curso->cuposDisponibles() > 0 ? '#059669' : '#dc2626' }}; font-weight:bold">
                {{ $curso->cuposDisponibles() }}
            </td>
        </tr>
        @empty
        <tr><td colspan="2" style="text-align:center; color:#9ca3af; padding:20px">Sin cursos inscritos.</td></tr>
        @endforelse
    </tbody>
</table>

@endsection