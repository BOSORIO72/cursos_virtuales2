<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login - Cursos Virtuales</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .card {
            background: white;
            padding: 30px;
            border-radius: 10px;
            width: 350px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h2 { margin-bottom: 5px; }
        label { font-size: 14px; font-weight: bold; }
        input {
            width: 100%;
            padding: 10px;
            margin-top: 6px;
            margin-bottom: 14px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            width: 100%;
            padding: 10px;
            background: #111827;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            font-size: 15px;
        }
        button:hover { background: #374151; }
        .error   { color: red;   font-size: 13px; margin-bottom: 10px; }
        .success { color: green; font-size: 13px; margin-bottom: 10px; }
    </style>
</head>
<body>
    <div class="card">
        <h2>Cursos Virtuales</h2>
        <p style="color:#666; margin-bottom:20px">Inicia sesión para continuar</p>

        @if(session('success'))
            <p class="success">{{ session('success') }}</p>
        @endif

        <form action="{{ route('login') }}" method="POST">
            @csrf

            <label>Correo electrónico</label>
            <input type="email" name="email" value="{{ old('email') }}" required>
            @error('email')
                <p class="error">{{ $message }}</p>
            @enderror

            <label>Contraseña</label>
            <input type="password" name="password" required>
            @error('password')
                <p class="error">{{ $message }}</p>
            @enderror

            <button type="submit">Ingresar</button>
        </form>
    </div>
</body>
</html>