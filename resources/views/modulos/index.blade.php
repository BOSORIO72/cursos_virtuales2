@extends('layouts.app')
@section('content')

<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px">
    <div>
        <h1>📚 Módulos — {{ $curso->nombre }}</h1>
        <small style="color:#6b7280">
            Precio: {{ $curso->es_gratis ? 'Gratis' : '$'.number_format($curso->precio,0,',','.') }}
        </small>
    </div>
    <div style="display:flex; gap:10px">
        <a href="{{ route('cursos.index') }}" class="btn btn-secondary">← Volver</a>
        @if(auth()->user()->role == 'administrador' || auth()->user()->role == 'editor')
        <a href="{{ route('cursos.modulos.create', $curso) }}" class="btn btn-primary">+ Nuevo Módulo</a>
        @endif
    </div>
</div>

@if(session('success'))
    <div class="alert-success">{{ session('success') }}</div>
@endif
@if(session('error'))
    <div class="alert-error">{{ session('error') }}</div>
@endif

@php
    $estudiante = \App\Models\Estudiante::where('email', auth()->user()->email)->first();
    $tieneAcceso = false;
    $solicitudPendiente = false;
    if ($estudiante) {
        $acceso = \App\Models\Acceso::where('curso_id', $curso->id)
            ->where('estudiante_id', $estudiante->id)->first();
        $tieneAcceso = $acceso && $acceso->estado == 'aprobado';
        $solicitudPendiente = $acceso && $acceso->estado == 'pendiente';
    }
    $esAdmin = auth()->user()->role == 'administrador';
@endphp

@if(!$curso->es_gratis && !$tieneAcceso && !$esAdmin)
<div style="background:#fffbeb; border-left:4px solid #f59e0b; border-radius:10px;
            padding:20px; margin-bottom:24px">
    <h3 style="color:#92400e; margin-bottom:8px">🔒 Curso de pago</h3>
    <p style="color:#78350f; margin-bottom:14px">
        Este curso tiene un costo de
        <strong>${{ number_format($curso->precio, 0, ',', '.') }}</strong>.
        Los módulos marcados como "Prueba gratuita" son visibles sin costo.
        Para acceder al contenido completo debes realizar el pago.
    </p>
    @if($solicitudPendiente)
        <span style="background:#fef3c7; color:#92400e; padding:8px 16px;
              border-radius:8px; font-weight:600">
            ⏳ Solicitud enviada — esperando aprobación del administrador
        </span>
    @else
        <form action="{{ route('accesos.solicitar', $curso) }}" method="POST" style="display:inline">
            @csrf
            <button class="btn btn-primary" type="submit">
                💳 Solicitar acceso — ${{ number_format($curso->precio, 0, ',', '.') }}
            </button>
        </form>
    @endif
</div>
@elseif($tieneAcceso && !$esAdmin)
<div style="background:#f0fdf4; border-left:4px solid #10b981; border-radius:10px;
            padding:14px 18px; margin-bottom:24px">
    <strong style="color:#065f46">✅ Tienes acceso completo a este curso</strong>
</div>
@endif

<div class="table-wrapper">
<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Módulo</th>
            <th>Tipo</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @forelse($modulos as $modulo)
        @php
            $bloqueado = !$modulo->es_prueba && !$tieneAcceso && !$esAdmin;
        @endphp
        <tr style="{{ $bloqueado ? 'opacity:0.5' : '' }}">
            <td>{{ $modulo->orden }}</td>
            <td>
                {{ $modulo->titulo }}
                @if($bloqueado)
                    <span style="font-size:16px">🔒</span>
                @endif
            </td>
            <td>
                @if($modulo->es_prueba)
                    <span style="background:#dcfce7; color:#065f46; padding:3px 10px;
                          border-radius:20px; font-size:12px; font-weight:600">
                        Prueba gratuita
                    </span>
                @else
                    <span style="background:#dbeafe; color:#1e40af; padding:3px 10px;
                          border-radius:20px; font-size:12px; font-weight:600">
                        Premium
                    </span>
                @endif
            </td>
            <td>
                <div class="table-actions">
                    @if(!$bloqueado)
                        <a href="{{ route('cursos.modulos.ver', [$curso, $modulo]) }}"
                           class="btn btn-success">Ver</a>
                    @endif
                    @if(auth()->user()->role == 'administrador' || auth()->user()->role == 'editor')
                        <a href="{{ route('cursos.modulos.edit', [$curso, $modulo]) }}"
                           class="btn btn-warning">Editar</a>
                    @endif
                    @if(auth()->user()->role == 'administrador')
                        <form action="{{ route('cursos.modulos.destroy', [$curso, $modulo]) }}"
                              method="POST" style="display:inline">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger"
                                    onclick="return confirm('¿Eliminar módulo?')">Eliminar</button>
                        </form>
                    @endif
                </div>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="4" class="empty-state">
                Este curso no tiene módulos aún.
            </td>
        </tr>
        @endforelse
    </tbody>
</table>
</div>

@endsection
