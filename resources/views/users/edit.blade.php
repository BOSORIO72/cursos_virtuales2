@extends('layouts.app')
@section('content')

<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px">
    <h1>✏️ Editar Usuario</h1>
    <a href="{{ route('users.index') }}" class="btn btn-secondary">← Volver</a>
</div>

@if($errors->any())
    <div class="alert-error">
        @foreach($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif

<form action="{{ route('users.update', $user) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="form-group">
        <label>Nombre</label>
        <input type="text" name="name" value="{{ old('name', $user->name) }}" required>
        @error('name') <p class="form-error">{{ $message }}</p> @enderror
    </div>

    <div class="form-group">
        <label>Email</label>
        <input type="email" name="email" value="{{ old('email', $user->email) }}" required>
        @error('email') <p class="form-error">{{ $message }}</p> @enderror
    </div>

    <div class="form-group">
        <label>Rol</label>
        <select name="role" required>
            <option value="administrador" {{ $user->role == 'administrador' ? 'selected' : '' }}>Administrador</option>
            <option value="editor"        {{ $user->role == 'editor'        ? 'selected' : '' }}>Editor</option>
            <option value="invitado"      {{ $user->role == 'invitado'      ? 'selected' : '' }}>Invitado</option>
        </select>
        @error('role') <p class="form-error">{{ $message }}</p> @enderror
    </div>

    <div class="form-group">
        <label>Foto de perfil</label>
        @if($user->photo)
            <div style="margin-bottom:10px">
                <img src="{{ asset('storage/' . $user->photo) }}"
                     width="80" height="80"
                     style="border-radius:50%; object-fit:cover; display:block; margin-bottom:8px">
                <small style="color:#6b7280">Foto actual. Sube una nueva para reemplazarla.</small>
            </div>
        @endif
        <input type="file" name="photo" accept="image/*">
        @error('photo') <p class="form-error">{{ $message }}</p> @enderror
    </div>

    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
</form>

@endsection
