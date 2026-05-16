<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Cursos Virtuales</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background: linear-gradient(135deg, #1e3a5f 0%, #2563eb 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .dashboard-card {
            background: white;
            border-radius: 20px;
            padding: 50px 45px;
            width: 900px;
            max-width: 100%;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            animation: fadeInUp 0.5s ease;
        }

        .welcome {
            font-size: 28px;
            color: #1e3a5f;
            font-weight: 700;
            margin-bottom: 6px;
        }

        .welcome-sub {
            color: #64748b;
            font-size: 15px;
            margin-bottom: 35px;
        }

        .dash-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
        }

        .dash-card {
            border-radius: 16px;
            padding: 30px 24px;
            text-decoration: none;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            transition: all 0.3s ease;
            cursor: pointer;
            border: 2px solid transparent;
        }
        .dash-card:hover {
            transform: translateY(-4px);
        }

        .dash-card--cursos {
            background: linear-gradient(135deg, #eff6ff, #dbeafe);
            border-color: #2563eb;
        }
        .dash-card--cursos:hover {
            box-shadow: 0 12px 32px rgba(37,99,235,0.25);
        }

        .dash-card--estudiantes {
            background: linear-gradient(135deg, #ecfdf5, #d1fae5);
            border-color: #10b981;
        }
        .dash-card--estudiantes:hover {
            box-shadow: 0 12px 32px rgba(16,185,129,0.25);
        }

        .dash-card--inscripciones {
            background: linear-gradient(135deg, #f5f3ff, #ede9fe);
            border-color: #7c3aed;
        }
        .dash-card--inscripciones:hover {
            box-shadow: 0 12px 32px rgba(124,58,237,0.25);
        }

        .dash-card-icon {
            font-size: 44px;
            margin-bottom: 14px;
            display: block;
        }
        .dash-card h2 {
            font-size: 20px;
            color: #1e3a5f;
            font-weight: 700;
            margin-bottom: 6px;
        }
        .dash-card p {
            color: #64748b;
            font-size: 13px;
            line-height: 1.4;
        }

        .logout-wrap {
            text-align: center;
            margin-top: 35px;
        }
        .logout-btn {
            background: none;
            border: 1.5px solid #e2e8f0;
            color: #94a3b8;
            padding: 10px 24px;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
        }
        .logout-btn:hover {
            background: #fef2f2;
            border-color: #fca5a5;
            color: #dc2626;
        }
    </style>
</head>
<body>
    <div class="dashboard-card">
        <h1 class="welcome">👋 Bienvenido, {{ Auth::user()->name }}</h1>
        <p class="welcome-sub">¿A dónde quieres ir hoy?</p>

        <div class="dash-grid">
            <a href="{{ route('cursos.index') }}" class="dash-card dash-card--cursos">
                <span class="dash-card-icon">📚</span>
                <h2>Cursos</h2>
                <p>Administra los cursos disponibles, edita contenidos y revisa cupos</p>
            </a>
            <a href="{{ route('estudiantes.index') }}" class="dash-card dash-card--estudiantes">
                <span class="dash-card-icon">🎓</span>
                <h2>Estudiantes</h2>
                <p>Gestiona los estudiantes registrados y su información</p>
            </a>
            <a href="{{ route('inscripciones.index') }}" class="dash-card dash-card--inscripciones">
                <span class="dash-card-icon">📋</span>
                <h2>Inscripciones</h2>
                <p>Controla las inscripciones y matriculas a los cursos</p>
            </a>
        </div>

        <div class="logout-wrap">
            <form action="{{ route('logout') }}" method="POST" style="display:inline">
                @csrf
                <button type="submit" class="logout-btn">🚪 Cerrar sesión</button>
            </form>
        </div>
    </div>
</body>
</html>
