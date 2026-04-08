<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>UCADLink-2</title>

    <!-- Fuente Poppins cargada de forma local -->
    <link rel="stylesheet" href="{{ asset('fonts/poppins.css') }}">

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <!-- Aquí ya no usamos CDN, puedes dejar vacío o poner un fallback local -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <script src="{{ asset('js/app.js') }}"></script>
    @endif
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { 
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
            background: linear-gradient(135deg, #e0f2fe 0%, #f0f9ff 50%, #ffffff 100%);
        }
        
        .login-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1.5rem;
        }
        
        .login-card {
            width: 100%;
            max-width: 400px;
            background: #ffffff;
            border-radius: 16px;
            box-shadow: 0 25px 50px -12px rgba(14, 165, 233, 0.15);
            padding: 2.5rem 2rem;
        }
        
        .tab-btn {
            padding: 0.75rem 1.5rem;
            font-weight: 600;
            font-size: 0.95rem;
            border-bottom: 2px solid transparent;
            transition: all 0.2s ease;
            color: #6b7280;
        }
        
        .tab-btn.active {
            color: #0066CC;
            border-bottom-color: #0066CC;
        }
        
        .tab-btn:hover:not(.active) {
            color: #374151;
        }
        
        .input-field {
            width: 100%;
            padding: 0.875rem 1rem;
            border: 1.5px solid #e5e7eb;
            border-radius: 10px;
            font-size: 0.95rem;
            transition: all 0.2s ease;
            background: #f9fafb;
        }
        
        .input-field:focus {
            border-color: #2563eb;
            background: #ffffff;
            outline: none;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }
        
        .input-field::placeholder {
            color: #9ca3af;
        }
        
        .btn-primary {
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
        
        .btn-primary:hover {
            background: linear-gradient(135deg, #1d4ed8 0%, #1e40af 100%);
            transform: translateY(-1px);
            box-shadow: 0 8px 20px rgba(37, 99, 235, 0.3);
        }
        
        .label-input {
            display: block;
            font-size: 0.875rem;
            font-weight: 500;
            color: #374151;
            margin-bottom: 0.5rem;
        }
        
        .checkbox-custom {
            width: 18px;
            height: 18px;
            accent-color: #2563eb;
            cursor: pointer;
        }
        
        .hidden { display: none; }
        
        @media (max-width: 480px) {
            .login-card {
                padding: 2rem 1.5rem;
                max-width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            <!-- Header -->
            <div class="text-center mb-6">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-br from-blue-600 to-blue-700 rounded-2xl mb-4 shadow-lg shadow-blue-600/30">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/>
                    </svg>
                </div>
                <h1 class="text-2xl font-bold text-gray-900">UCADLink-v2</h1>
                <p class="text-gray-500 text-sm mt-1">Universidad Cristiana de las Asambleas de Dios</p>
            </div>

            <!-- Tabs -->
            <div class="flex border-b border-gray-200 mb-6">
                <button type="button" onclick="showTab('login')" id="tab-login" class="tab-btn active">
                    Iniciar Sesión
                </button>
                <button type="button" onclick="showTab('register')" id="tab-register" class="tab-btn">
                    Regístrate
                </button>
            </div>

            <!-- Login Form -->
            <div id="login-form">
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="space-y-4">
                        <div>
                            <label for="login-email" class="label-input">Correo Institucional</label>
                            <input 
                                id="login-email" 
                                name="email" 
                                type="email" 
                                required 
                                autocomplete="username"
                                class="input-field"
                                placeholder="correo@ucad.edu.sv"
                                oninput="validateEmail(this)"
                            >
                            <p id="email-error" class="text-red-500 text-xs mt-1" style="display: none;"></p>
                            @error('email')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="login-password" class="label-input">Contraseña</label>
                            <input 
                                id="login-password" 
                                name="password" 
                                type="password" 
                                required 
                                autocomplete="current-password"
                                class="input-field"
                                placeholder="••••••••"
                            >
                            @error('password')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="flex items-center justify-between mt-5 mb-6">
                        <label class="flex items-center cursor-pointer">
                            <input type="checkbox" name="remember" class="checkbox-custom">
                            <span class="ml-2 text-gray-600 text-sm">Recordarme</span>
                        </label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-blue-600 text-sm hover:underline">
                                ¿Olvidaste tu contraseña?
                            </a>
                        @endif
                    </div>

                    <button type="submit" class="btn-primary">
                        Iniciar Sesión
                    </button>
                </form>
            </div>

            <!-- Register Form -->
            <div id="register-form" class="hidden">
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="space-y-4">
                        <div>
                            <label for="register-name" class="label-input">Nombre Completo</label>
                            <input 
                                id="register-name" 
                                name="name" 
                                type="text" 
                                required 
                                autocomplete="name"
                                class="input-field"
                                placeholder="Juan Pérez"
                            >
                            @error('name')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="register-carnet" class="label-input">Carnet Universitario</label>
                            <input 
                                id="register-carnet" 
                                name="carnet" 
                                type="text" 
                                required 
                                autocomplete="off"
                                class="input-field"
                                placeholder="00012345"
                            >
                            @error('carnet')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="register-email" class="label-input">Correo Institucional</label>
                            <input 
                                id="register-email" 
                                name="email" 
                                type="email" 
                                required 
                                autocomplete="email"
                                class="input-field"
                                placeholder="correo@ucad.edu.sv"
                            >
                            @error('email')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="register-password" class="label-input">Contraseña</label>
                            <input 
                                id="register-password" 
                                name="password" 
                                type="password" 
                                required 
                                autocomplete="new-password"
                                class="input-field"
                                placeholder="••••••••"
                            >
                            @error('password')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="register-password-confirm" class="label-input">Confirmar Contraseña</label>
                            <input 
                                id="register-password-confirm" 
                                name="password_confirmation" 
                                type="password" 
                                required 
                                autocomplete="new-password"
                                class="input-field"
                                placeholder="••••••••"
                            >
                            @error('password_confirmation')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <button type="submit" class="btn-primary mt-6">
                        Crear Cuenta
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function showTab(tab) {
            const loginForm = document.getElementById('login-form');
            const registerForm = document.getElementById('register-form');
            const tabLogin = document.getElementById('tab-login');
            const tabRegister = document.getElementById('tab-register');
            
            if (tab === 'login') {
                loginForm.classList.remove('hidden');
                registerForm.classList.add('hidden');
                tabLogin.classList.add('active');
                tabRegister.classList.remove('active');
            } else {
                loginForm.classList.add('hidden');
                registerForm.classList.remove('hidden');
                tabLogin.classList.remove('active');
                tabRegister.classList.add('active');
            }
        }

        function validateEmail(input) {
            const email = input.value;
            const errorMsg = document.getElementById('email-error');
            const emailPattern = /^[a-zA-Z0-9._%+-]+@ucad\.edu\.sv$/;
            
            if (email && !emailPattern.test(email)) {
                errorMsg.textContent = 'El correo debe ser institucional (@ucad.edu.sv)';
                errorMsg.style.display = 'block';
                input.style.borderColor = '#ef4444';
            } else {
                errorMsg.style.display = 'none';
                input.style.borderColor = '#e5e7eb';
            }
        }
    </script>
</body>
</html>