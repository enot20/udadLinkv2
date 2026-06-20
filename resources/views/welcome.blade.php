<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>UCADLink-2</title>

    <link rel="stylesheet" href="{{ asset('fonts/poppins.css') }}">

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <script src="{{ asset('js/app.js') }}"></script>
    @endif
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { 
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
            overflow-x: hidden;
        }
        
        .login-card {
            width: 100%;
            max-width: 380px;
            background: #ffffff;
            border-radius: 20px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.4);
            padding: 2rem;
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
                max-width: 100%;
                border-radius: 16px;
                padding: 1.5rem;
            }

        }
    </style>
</head>
<body style="min-height: 100vh; margin: 0; padding: 0;">
    <!-- Fondo con imagen -->
    <div class="background-container" style="min-height: 100vh; width: 100%; position: relative; background-image: url('{{ asset('images/login-2.jpg') }}'); background-size: cover; background-position: center center; background-repeat: no-repeat; background-attachment: fixed;">
        
        <!-- Overlay oscuro para mejorar legibilidad -->
        <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0, 0, 0, 0.3);"></div>
        
        <!-- Contenido: Login en esquina inferior izquierda -->
        <div class="login-container" style="position: absolute; bottom: 2rem; left: 2rem; max-width: 90vw; z-index: 10;">
            
            <!-- Login Card -->
            <div class="login-card">
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
                        <!-- NUEVO CAMPO: Carrera -->
                            <div>
                                <label for="register-carrera" class="label-input">Carrera</label>
                                <input 
                                    id="register-carrera" 
                                    name="carrera" 
                                    type="text" 
                                    required 
                                    autocomplete="off"
                                    class="input-field"
                                    placeholder="ingresar carrera"
                                >
                                @error('carrera')
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
    </div>

    <style>
        /* Ajustes responsive para tablets y resoluciones medianas */
        @media (max-width: 1280px) and (min-width: 769px) {
            .login-card {
                max-width: 340px !important;
                padding: 1.5rem !important;
            }
            .login-container {
                bottom: 1.5rem !important;
                left: 1.5rem !important;
            }
            .tab-btn {
                padding: 0.6rem 1.2rem !important;
                font-size: 0.85rem !important;
            }
            .input-field {
                padding: 0.75rem 0.875rem !important;
                font-size: 0.9rem !important;
            }
            .label-input {
                font-size: 0.8rem !important;
            }
            .btn-primary {
                padding: 0.8rem !important;
                font-size: 0.9rem !important;
            }
        }
        
        @media (max-width: 768px) and (min-width: 481px) {
            .login-card {
                max-width: 320px !important;
                padding: 1.25rem !important;
            }
            .login-container {
                bottom: 1rem !important;
                left: 1rem !important;
            }
            .background-container {
                background-position: center 25% !important;
            }
        }
        
        @media (max-width: 480px) {
            .login-card {
                max-width: 100% !important;
                border-radius: 16px !important;
                padding: 1.25rem !important;
            }
            .login-container {
                bottom: 0.5rem !important;
                left: 0.75rem !important;
                right: 0.75rem !important;
                max-width: calc(100% - 1.5rem) !important;
            }
            .background-container {
                background-position: center 20% !important;
            }
            .tab-btn {
                padding: 0.5rem 1rem !important;
                font-size: 0.8rem !important;
            }
        }
        
        @media (min-width: 1920px) {
            .background-container {
                background-size: cover !important;
            }
        }
    </style>

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