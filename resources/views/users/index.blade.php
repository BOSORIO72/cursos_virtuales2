@extends('layouts.app')
@section('content')

<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px">
    <h1>👥 Gestión de Usuarios</h1>
</div>

@if(session('success'))
    <div class="alert-success">{{ session('success') }}</div>
@endif

<div class="table-wrapper">
<table>
    <thead>
        <tr>
            <th>Foto</th>
            <th>Nombre</th>
            <th>Email</th>
            <th>Rol</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @forelse($users as $user)
        <tr>
            <td>
                @if($user->photo)
                    <img src="{{ asset('storage/' . $user->photo) }}"
                         width="50" height="50"
                         style="border-radius:50%; object-fit:cover;">
                @else
                    <span style="color:#9ca3af">Sin foto</span>
                @endif
            </td>
            <td><strong>{{ $user->name }}</strong></td>
            <td>{{ $user->email }}</td>
            <td>
                <span class="role-badge role-badge--{{ $user->role }}">
                    {{ ucfirst($user->role) }}
                </span>
            </td>
            <td>
                <a href="{{ route('users.edit', $user) }}" class="btn btn-warning">Editar</a>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="5" class="empty-state">
                No hay usuarios registrados.
            </td>
        </tr>
        @endforelse
    </tbody>
</table>
</div>

@endsection
