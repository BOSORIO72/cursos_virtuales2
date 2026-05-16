<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Cursos Virtuales</title>
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

        @keyframes fadeInDown {
            from { opacity: 0; transform: translateY(-30px); }
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

        .login-card {
            background: white;
            border-radius: 20px;
            padding: 45px 40px;
            width: 420px;
            max-width: 100%;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            animation: fadeInDown 0.5s ease;
        }

        .login-icon {
            display: block;
            text-align: center;
            font-size: 52px;
            margin-bottom: 8px;
            animation: pulse 2s ease-in-out infinite;
        }

        .login-title {
            font-size: 26px;
            color: #1e3a5f;
            font-weight: 700;
            text-align: center;
            margin-bottom: 4px;
        }

        .login-subtitle {
            color: #64748b;
            text-align: center;
            font-size: 15px;
            margin-bottom: 30px;
        }

        .login-alert-success,
        .login-alert-error {
            padding: 12px 16px;
            border-radius: 10px;
            margin-bottom: 16px;
            font-size: 13px;
            font-weight: 500;
            animation: fadeIn 0.3s ease;
        }
        .login-alert-success {
            background: #f0fdf4;
            border-left: 4px solid #10b981;
            color: #065f46;
        }
        .login-alert-error {
            background: #fef2f2;
            border-left: 4px solid #ef4444;
            color: #991b1b;
        }

        .form-group {
            margin-bottom: 18px;
        }
        .form-group label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: #374151;
            margin-bottom: 6px;
        }
        .form-group input {
            width: 100%;
            padding: 12px 14px;
            border: 1.5px solid #cbd5e1;
            border-radius: 10px;
            font-size: 14px;
            color: #111827;
            background: white;
            transition: all 0.2s ease;
        }
        .form-group input:focus {
            outline: none;
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37,99,235,0.15);
        }
        .form-group input::placeholder {
            color: #94a3b8;
        }
        .field-error {
            color: #dc2626;
            font-size: 12px;
            margin-top: 4px;
            font-weight: 500;
        }

        .btn-login {
            width: 100%;
            padding: 12px;
            background: #1e3a5f;
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.2s ease;
        }
        .btn-login:hover {
            background: #2563eb;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(30,58,95,0.3);
        }
    </style>
</head>
<body>
    <div class="login-card">
        <span class="login-icon">🎓</span>
        <h1 class="login-title">Cursos Virtuales</h1>
        <p class="login-subtitle">Inicia sesión para continuar</p>

        @if(session('success'))
            <div class="login-alert-success">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="login-alert-error">{{ session('error') }}</div>
        @endif

        <form action="{{ route('login') }}" method="POST">
            @csrf

            <div class="form-group">
                <label>Correo electrónico</label>
                <input type="email" name="email" value="{{ old('email') }}" placeholder="tu@correo.com" required>
                @error('email')
                    <p class="field-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label>Contraseña</label>
                <input type="password" name="password" placeholder="••••••••" required>
                @error('password')
                    <p class="field-error">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="btn-login">Iniciar sesión</button>
        </form>
    </div>
</body>
</html>
