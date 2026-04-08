<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Verificación 2FA - UCADLink</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=poppins:400,500,600,700&display=swap" rel="stylesheet" />
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
    @endif
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { 
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
            background: linear-gradient(135deg, #1e3a5f 0%, #2d5a87 50%, #3d7ab5 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1.5rem;
        }
        
        .verify-card {
            width: 100%;
            max-width: 400px;
            background: #ffffff;
            border-radius: 16px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.35);
            padding: 2.5rem 2rem;
        }
        
        .input-code {
            width: 100%;
            padding: 1rem;
            border: 1.5px solid #e5e7eb;
            border-radius: 10px;
            font-size: 1.5rem;
            text-align: center;
            letter-spacing: 0.5em;
            font-weight: 600;
            transition: all 0.2s ease;
            background: #f9fafb;
        }
        
        .input-code:focus {
            border-color: #2563eb;
            background: #ffffff;
            outline: none;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }
        
        .btn-verify {
            width: 100%;
            padding: 0.9rem;
            background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
            color: white;
            font-weight: 600;
            font-size: 1rem;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.2s ease;
        }
        
        .btn-verify:hover {
            background: linear-gradient(135deg, #1d4ed8 0%, #1e40af 100%);
            transform: translateY(-1px);
            box-shadow: 0 8px 20px rgba(37, 99, 235, 0.3);
        }
        
        .icon-shield {
            width: 64px;
            height: 64px;
            background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
        }
    </style>
</head>
<body>
    <div class="verify-card">
        <!-- Header -->
        <div class="text-center mb-6">
            <div class="icon-shield">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                </svg>
            </div>
            <h1 class="text-xl font-bold text-gray-900">Verificación de Seguridad</h1>
            <p class="text-gray-500 text-sm mt-2">Ingresa el código de 6 dígitos de tu aplicación autenticadora</p>
        </div>

        <!-- Form -->
        <form method="POST" action="{{ route('2fa.validate') }}">
            @csrf

            <div class="mb-6">
                <input 
                    id="code" 
                    name="code" 
                    type="text" 
                    required 
                    autofocus
                    maxlength="6"
                    inputmode="numeric"
                    pattern="[0-9]*"
                    class="input-code"
                    placeholder="000000"
                    oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                >
                @error('code')
                    <p class="text-red-500 text-sm mt-2 text-center">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="btn-verify">
                Verificar Código
            </button>
        </form>

        <!-- Logout -->
        <div class="mt-6 pt-6 border-t border-gray-100 text-center">
            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="text-gray-500 text-sm hover:text-gray-700">
                Cancelar y salir
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </div>
</body>
</html>