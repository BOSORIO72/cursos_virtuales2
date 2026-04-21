<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #eef2ff;
            padding: 40px;
            margin: 0;
        }
        .container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            max-width: 700px;
            margin: auto;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .links {
            margin-top: 30px;
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
        }
        .btn {
            padding: 12px 24px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 15px;
            color: white;
        }
        .btn-cursos        { background: #4f46e5; }
        .btn-estudiantes   { background: #0891b2; }
        .btn-inscripciones { background: #059669; }
        .btn-logout {
            margin-top: 30px;
            padding: 10px 20px;
            background: #dc2626;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
        }
        .btn-logout:hover { background: #b91c1c; }
    </style>
</head>
<body>
    <div class="container">
        <h1> Bienvenido, {{ Auth::user()->name }}</h1>
        <p style="color:#555">Has iniciado sesión correctamente. ¿A dónde quieres ir?</p>

        <div class="links">
            <a href="{{ route('cursos.index') }}"        class="btn btn-cursos"> Cursos</a>
            <a href="{{ route('estudiantes.index') }}"   class="btn btn-estudiantes"> Estudiantes</a>
            <a href="{{ route('inscripciones.index') }}" class="btn btn-inscripciones"> Inscripciones</a>
        </div>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="btn-logout" type="submit"> Cerrar sesión</button>
        </form>
    </div>
</body>
</html>