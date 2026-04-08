<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Activar 2FA - UCADLink</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=poppins:400,500,600,700&display=swap" rel="stylesheet" />
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
    @endif
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: { ucad: { 500: '#0066CC', 600: '#0052A3' } }
                }
            }
        }
    </script>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { 
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
            background: linear-gradient(135deg, #1e3a5f 0%, #2d5a87 50%, #3d7ab5 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
        }
        
        .enable-card {
            width: 100%;
            max-width: 420px;
            background: #ffffff;
            border-radius: 20px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.4);
            padding: 2rem;
        }
        
        .qr-container {
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            border: 2px dashed #e2e8f0;
            border-radius: 16px;
            padding: 1.5rem;
            text-align: center;
            margin-bottom: 1.5rem;
        }
        
        .qr-code {
            width: 180px;
            height: 180px;
            border-radius: 12px;
            background: white;
            padding: 0.5rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        
        .secret-code {
            font-family: 'Courier New', monospace;
            font-size: 1.1rem;
            font-weight: 700;
            letter-spacing: 0.15em;
            color: #1e293b;
            background: #f1f5f9;
            padding: 0.75rem 1rem;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.2s ease;
        }
        
        .secret-code:hover {
            background: #e2e8f0;
        }
        
        .input-code {
            width: 100%;
            padding: 1rem;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            font-size: 1.5rem;
            text-align: center;
            letter-spacing: 0.5em;
            font-weight: 600;
            transition: all 0.2s ease;
            background: #f8fafc;
        }
        
        .input-code:focus {
            border-color: #0066CC;
            background: #ffffff;
            outline: none;
            box-shadow: 0 0 0 4px rgba(0, 102, 204, 0.15);
        }
        
        .btn-activate {
            width: 100%;
            padding: 1rem;
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
            font-weight: 700;
            font-size: 1rem;
            border: none;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.2s ease;
        }
        
        .btn-activate:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(16, 185, 129, 0.4);
        }
        
        .step-icon {
            width: 28px;
            height: 28px;
            background: #0066CC;
            color: white;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 0.875rem;
            margin-right: 0.75rem;
        }
        
        @media (max-width: 480px) {
            .enable-card {
                padding: 1.5rem;
            }
            .qr-code {
                width: 150px;
                height: 150px;
            }
        }
    </style>
</head>
<body>
    <div class="enable-card">
        <!-- Header -->
        <div class="text-center mb-6">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-br from-green-500 to-green-600 rounded-2xl mb-4 shadow-lg shadow-green-500/30">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                </svg>
            </div>
            <h1 class="text-xl font-bold text-gray-900">Activar 2FA</h1>
            <p class="text-gray-500 text-sm mt-1">Autenticación de Doble Factor</p>
        </div>

        <!-- Pasos -->
        <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl p-4 mb-6 border border-blue-100">
            <div class="flex items-center mb-3">
                <span class="step-icon">1</span>
                <span class="text-sm font-medium text-gray-700">Escanea el código QR</span>
            </div>
            <div class="flex items-center mb-3">
                <span class="step-icon">2</span>
                <span class="text-sm font-medium text-gray-700">Ingresa el código de 6 dígitos</span>
            </div>
            <div class="flex items-center">
                <span class="step-icon">3</span>
                <span class="text-sm font-medium text-gray-700">Activa la protección</span>
            </div>
        </div>

        <!-- QR Code -->
        <div class="qr-container">
            <div class="qr-code inline-block">
                {!! $imageUrl !!}
            </div>
            <p class="text-xs text-gray-500 mt-3">Usa Google Authenticator, Authy o similar</p>
        </div>

        <!-- Código manual -->
        <div class="text-center mb-6">
            <p class="text-xs text-gray-500 mb-2">¿No puedes escanear? Copia este código:</p>
            <div class="secret-code" onclick="copySecret()" title="Clic para copiar">
                {{ $secret }}
            </div>
            <p id="copy-msg" class="text-xs text-green-600 mt-2 hidden">¡Código copiado!</p>
        </div>

        <!-- Form -->
        <form method="POST" action="{{ route('2fa.store') }}">
            @csrf

            <div class="mb-5">
                <label for="code" class="block text-sm font-semibold text-gray-700 mb-2 text-center">Código de tu app</label>
                <input 
                    id="code" 
                    name="code" 
                    type="text" 
                    required 
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

            <div class="flex gap-3">
                <a href="{{ route('profile.edit') }}" class="flex-1 py-3 text-center bg-gray-100 text-gray-600 font-semibold rounded-xl hover:bg-gray-200 transition">
                    Cancelar
                </a>
                <button type="submit" class="btn-activate flex-1">
                    Activar 2FA
                </button>
            </div>
        </form>
    </div>

    <script>
        function copySecret() {
            navigator.clipboard.writeText('{{ $secret }}').then(() => {
                document.getElementById('copy-msg').classList.remove('hidden');
                setTimeout(() => {
                    document.getElementById('copy-msg').classList.add('hidden');
                }, 2000);
            });
        }
    </script>
</body>
</html>