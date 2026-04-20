<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cursos Virtuales</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: Arial, sans-serif;
            background: #eef2ff;
            min-height: 100vh;
        }

        /* NAV */
        nav {
            background: #111827;
            padding: 14px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        nav .nav-brand {
            color: white;
            font-size: 18px;
            font-weight: bold;
            text-decoration: none;
        }
        nav .nav-links {
            display: flex;
            gap: 10px;
            align-items: center;
        }
        nav .nav-links a {
            color: #d1d5db;
            text-decoration: none;
            padding: 8px 16px;
            border-radius: 6px;
            font-size: 14px;
            transition: background 0.2s;
        }
        nav .nav-links a:hover { background: #374151; color: white; }
        nav .nav-links a.active { background: #4f46e5; color: white; }

        .btn-logout-nav {
            background: #dc2626;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 6px;
            font-size: 14px;
            cursor: pointer;
            transition: background 0.2s;
        }
        .btn-logout-nav:hover { background: #b91c1c; }

        /* CONTENEDOR PRINCIPAL */
        .main-container {
            max-width: 1000px;
            margin: 40px auto;
            padding: 0 20px;
        }

        /* CARD */
        .card {
            background: white;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.08);
        }

        /* TÍTULOS */
        h1 {
            font-size: 24px;
            color: #111827;
            margin-bottom: 20px;
        }

        /* ALERTAS */
        .alert-success {
            background: #dcfce7;
            color: #166534;
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
        }
        .alert-error {
            background: #fee2e2;
            color: #991b1b;
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        /* BOTONES */
        .btn {
            display: inline-block;
            padding: 10px 20px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: bold;
            text-decoration: none;
            cursor: pointer;
            border: none;
            transition: opacity 0.2s;
        }
        .btn:hover { opacity: 0.85; }
        .btn-primary   { background: #4f46e5; color: white; }
        .btn-success   { background: #059669; color: white; }
        .btn-warning   { background: #d97706; color: white; }
        .btn-danger    { background: #dc2626; color: white; }
        .btn-secondary { background: #6b7280; color: white; }

        /* TABLA */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
            font-size: 14px;
        }
        thead tr { background: #111827; color: white; }
        thead th { padding: 12px 16px; text-align: left; }
        tbody tr { border-bottom: 1px solid #e5e7eb; }
        tbody tr:hover { background: #f9fafb; }
        tbody td { padding: 12px 16px; color: #374151; }

        /* FORMULARIOS */
        .form-group { margin-bottom: 18px; }
        .form-group label {
            display: block;
            font-size: 14px;
            font-weight: bold;
            color: #374151;
            margin-bottom: 6px;
        }
        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 10px 14px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 14px;
            color: #111827;
            transition: border 0.2s;
        }
        .form-group input:focus,
        .form-group textarea:focus,
        .form-group select:focus {
            outline: none;
            border-color: #4f46e5;
        }
        .form-error {
            color: #dc2626;
            font-size: 12px;
            margin-top: 4px;
        }

        /* ACCIONES EN TABLA */
        .table-actions { display: flex; gap: 8px; align-items: center; }
        .table-actions form { margin: 0; }
    </style>
</head>
<body>

<nav>
    <a href="{{ route('dashboard') }}" class="nav-brand">🎓 Cursos Virtuales</a>
    <div class="nav-links">
        <a href="{{ route('cursos.index') }}"
           class="{{ request()->is('cursos*') ? 'active' : '' }}">
            📚 Cursos
        </a>
        <a href="{{ route('estudiantes.index') }}"
           class="{{ request()->is('estudiantes*') ? 'active' : '' }}">
            👨‍🎓 Estudiantes
        </a>
        <a href="{{ route('inscripciones.index') }}"
           class="{{ request()->is('inscripciones*') ? 'active' : '' }}">
            📝 Inscripciones
        </a>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="btn-logout-nav" type="submit">🚪 Salir</button>
        </form>
    </div>
</nav>

<div class="main-container">
    <div class="card">
        @yield('content')
    </div>
</div>

</body>
</html>