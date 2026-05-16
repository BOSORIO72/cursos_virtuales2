<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cursos Virtuales</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background: #f1f5f9;
            min-height: 100vh;
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to   { opacity: 1; }
        }
        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50%      { transform: scale(1.05); }
        }

        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: #f1f5f9; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 3px; }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }

        nav {
            background: linear-gradient(90deg, #1e3a5f 0%, #2563eb 100%);
            padding: 0 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 64px;
            box-shadow: 0 2px 20px rgba(0,0,0,0.15);
            position: sticky;
            top: 0;
            z-index: 100;
        }
        nav .nav-brand {
            color: white;
            font-size: 20px;
            font-weight: 700;
            text-decoration: none;
            letter-spacing: 0.5px;
        }
        nav .nav-links {
            display: flex;
            gap: 4px;
            align-items: center;
        }
        nav .nav-links a {
            color: rgba(255,255,255,0.85);
            text-decoration: none;
            padding: 8px 14px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            position: relative;
            transition: all 0.3s ease;
        }
        nav .nav-links a::after {
            content: '';
            position: absolute;
            bottom: 2px;
            left: 50%;
            transform: translateX(-50%);
            width: 0;
            height: 2px;
            background: white;
            border-radius: 2px;
            transition: width 0.3s ease;
        }
        nav .nav-links a:hover { background: rgba(255,255,255,0.1); color: white; }
        nav .nav-links a:hover::after { width: 60%; }
        nav .nav-links a.active {
            background: rgba(255,255,255,0.15);
            color: white;
        }
        nav .nav-links a.active::after { width: 60%; }

        .nav-profile-img {
            border-radius: 50%;
            object-fit: cover;
            vertical-align: middle;
            width: 34px;
            height: 34px;
            border: 2px solid rgba(255,255,255,0.6);
            transition: border-color 0.3s;
        }
        .nav-profile-img:hover { border-color: white; }

        .nav-profile-name {
            color: rgba(255,255,255,0.85);
            font-size: 14px;
            font-weight: 500;
        }

        .btn-logout-nav {
            background: rgba(239,68,68,0.7);
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
            margin-left: 6px;
        }
        .btn-logout-nav:hover { background: #dc2626; }

        .main-container {
            max-width: 1100px;
            margin: 40px auto;
            padding: 0 24px;
        }
        .card {
            background: white;
            border-radius: 16px;
            padding: 35px;
            box-shadow: 0 4px 24px rgba(0,0,0,0.07);
            animation: fadeInUp 0.4s ease;
        }

        h1 {
            font-size: 26px;
            color: #1e3a5f;
            font-weight: 700;
            margin-bottom: 20px;
            display: inline-block;
        }
        h1::after {
            content: '';
            display: block;
            width: 60px;
            height: 3px;
            background: #2563eb;
            border-radius: 3px;
            margin-top: 4px;
        }

        .alert-success,
        .alert-error {
            padding: 14px 18px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-size: 14px;
            font-weight: 500;
            animation: fadeIn 0.3s ease;
        }
        .alert-success {
            background: #f0fdf4;
            border-left: 4px solid #10b981;
            color: #065f46;
        }
        .alert-success::before { content: '✓ '; font-weight: 700; }
        .alert-error {
            background: #fef2f2;
            border-left: 4px solid #ef4444;
            color: #991b1b;
        }
        .alert-error::before { content: '✗ '; font-weight: 700; }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 10px 20px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
            border: none;
            transition: all 0.2s ease;
        }
        .btn:hover { transform: translateY(-1px); }
        .btn-primary   { background: #2563eb; color: white; }
        .btn-primary:hover {
            background: #1d4ed8;
            box-shadow: 0 4px 12px rgba(37,99,235,0.4);
        }
        .btn-success   { background: #10b981; color: white; }
        .btn-success:hover {
            background: #059669;
            box-shadow: 0 4px 12px rgba(16,185,129,0.4);
        }
        .btn-warning   { background: #f59e0b; color: white; }
        .btn-warning:hover {
            background: #d97706;
            box-shadow: 0 4px 12px rgba(245,158,11,0.4);
        }
        .btn-danger    { background: #ef4444; color: white; }
        .btn-danger:hover {
            background: #dc2626;
            box-shadow: 0 4px 12px rgba(239,68,68,0.4);
        }
        .btn-secondary { background: #64748b; color: white; }
        .btn-secondary:hover {
            background: #475569;
            box-shadow: 0 4px 12px rgba(100,116,139,0.4);
        }

        .table-wrapper {
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 1px 8px rgba(0,0,0,0.06);
            margin-top: 15px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
        }
        thead tr {
            background: linear-gradient(135deg, #1e3a5f, #2563eb);
            color: white;
        }
        thead th {
            padding: 14px 16px;
            text-align: left;
            font-weight: 600;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        tbody tr {
            border-bottom: 1px solid #e2e8f0;
            transition: background 0.2s ease;
        }
        tbody tr:hover { background: #eff6ff; }
        tbody td {
            padding: 14px 16px;
            color: #374151;
        }
        tbody td:first-child { font-weight: 600; }

        .empty-state {
            text-align: center;
            color: #9ca3af;
            padding: 30px !important;
        }

        .form-group { margin-bottom: 20px; }
        .form-group label {
            display: block;
            font-weight: 600;
            color: #374151;
            font-size: 14px;
            margin-bottom: 6px;
        }
        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 11px 14px;
            border: 1.5px solid #cbd5e1;
            border-radius: 10px;
            font-size: 14px;
            color: #111827;
            background: white;
            transition: all 0.2s ease;
            font-family: inherit;
        }
        .form-group input:focus,
        .form-group textarea:focus,
        .form-group select:focus {
            outline: none;
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37,99,235,0.15);
        }
        .form-group input::placeholder,
        .form-group textarea::placeholder { color: #94a3b8; }
        .form-error {
            color: #dc2626;
            font-size: 12px;
            margin-top: 4px;
            font-weight: 500;
        }

        .table-actions { display: flex; gap: 8px; align-items: center; flex-wrap: wrap; }
        .table-actions form { margin: 0; }

        .role-badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }
        .role-badge--administrador { background: #dbeafe; color: #1e40af; }
        .role-badge--editor        { background: #dcfce7; color: #065f46; }
        .role-badge--invitado      { background: #f3f4f6; color: #374151; }
    </style>
</head>
<body>

<nav>
    <a href="{{ route('dashboard') }}" class="nav-brand">📚 Cursos Virtuales</a>
    <div class="nav-links">
        <a href="{{ route('cursos.index') }}"
           class="{{ request()->is('cursos*') ? 'active' : '' }}">
            📚 Cursos
        </a>
        <a href="{{ route('estudiantes.index') }}"
           class="{{ request()->is('estudiantes*') ? 'active' : '' }}">
            🎓 Estudiantes
        </a>
        <a href="{{ route('inscripciones.index') }}"
           class="{{ request()->is('inscripciones*') ? 'active' : '' }}">
            📋 Inscripciones
        </a>
        @if(auth()->check() && auth()->user()->role == 'administrador')
            <a href="{{ route('users.index') }}"
               class="{{ request()->is('users*') ? 'active' : '' }}">
                👥 Usuarios
            </a>
            <a href="{{ route('accesos.index') }}"
               class="{{ request()->is('accesos*') ? 'active' : '' }}">
                🔑 Accesos
            </a>
        @endif
        @if(auth()->check())
            @if(auth()->user()->photo)
                <img src="{{ asset('storage/' . auth()->user()->photo) }}"
                     class="nav-profile-img" alt="Foto">
            @else
                <span class="nav-profile-name">{{ auth()->user()->name }}</span>
            @endif
        @endif
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
