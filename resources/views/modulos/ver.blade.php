@extends('layouts.app')
@section('content')

<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px">
    <div>
        <small style="color:#6b7280">{{ $curso->nombre }}</small>
        <h1>{{ $modulo->titulo }}</h1>
    </div>
    <a href="{{ route('cursos.modulos.index', $curso) }}" class="btn btn-secondary">← Volver</a>
</div>

@if($modulo->es_prueba)
    <span style="background:#dcfce7; color:#065f46; padding:4px 12px;
          border-radius:20px; font-size:13px; font-weight:600; margin-bottom:20px; display:inline-block">
        ✓ Módulo de prueba gratuita
    </span>
@else
    <span style="background:#dbeafe; color:#1e40af; padding:4px 12px;
          border-radius:20px; font-size:13px; font-weight:600; margin-bottom:20px; display:inline-block">
        ⭐ Módulo Premium
    </span>
@endif

<div style="margin-top:20px; line-height:1.8; color:#374151; font-size:15px">
    {!! nl2br(e($modulo->contenido)) !!}
</div>

@endsection
