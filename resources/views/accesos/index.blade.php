@extends('layouts.app')
@section('content')

<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px">
    <h1>🔑 Gestión de Accesos</h1>
</div>

@if(session('success'))
    <div class="alert-success">{{ session('success') }}</div>
@endif

<div class="table-wrapper">
<table>
    <thead>
        <tr>
            <th>Estudiante</th>
            <th>Curso</th>
            <th>Precio</th>
            <th>Fecha solicitud</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @forelse($accesos as $acceso)
        <tr>
            <td><strong>{{ $acceso->estudiante->nombre }}</strong></td>
            <td>{{ $acceso->curso->nombre }}</td>
            <td>
                ${{ number_format($acceso->curso->precio, 0, ',', '.') }}
            </td>
            <td>{{ $acceso->fecha_solicitud ? $acceso->fecha_solicitud->format('d/m/Y H:i') : 'N/A' }}</td>
            <td>
                @if($acceso->estado == 'aprobado')
                    <span style="background:#dcfce7; color:#065f46; padding:4px 12px;
                          border-radius:20px; font-size:12px; font-weight:600">✅ Aprobado</span>
                @elseif($acceso->estado == 'pendiente')
                    <span style="background:#fef3c7; color:#92400e; padding:4px 12px;
                          border-radius:20px; font-size:12px; font-weight:600">⏳ Pendiente</span>
                @else
                    <span style="background:#fee2e2; color:#991b1b; padding:4px 12px;
                          border-radius:20px; font-size:12px; font-weight:600">❌ Rechazado</span>
                @endif
            </td>
            <td>
                <div class="table-actions">
                    @if($acceso->estado == 'pendiente')
                        <form action="{{ route('accesos.aprobar', $acceso) }}" method="POST">
                            @csrf
                            <button class="btn btn-success"
                                    onclick="return confirm('¿Aprobar acceso?')">
                                Aprobar
                            </button>
                        </form>
                        <form action="{{ route('accesos.rechazar', $acceso) }}" method="POST">
                            @csrf
                            <button class="btn btn-danger"
                                    onclick="return confirm('¿Rechazar acceso?')">
                                Rechazar
                            </button>
                        </form>
                    @else
                        <span style="color:#9ca3af; font-size:13px">Sin acciones</span>
                    @endif
                </div>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="6" class="empty-state">
                No hay solicitudes de acceso aún.
            </td>
        </tr>
        @endforelse
    </tbody>
</table>
</div>

@endsection
