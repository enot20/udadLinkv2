<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

       <!-- Email Field -->
        <div>
            <x-input-label for="email" :value="__('Correo Electrónico')" />
            <x-text-input 
                id="email" 
                class="block mt-1 w-full" 
                type="email" 
                name="email" 
                :value="old('email')" 
                required 
                autofocus 
                autocomplete="username" 
                onblur="checkEmailExistence()" 
            />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
            <!-- Contenedor para mensaje dinámico -->
            <p id="email-status-msg" class="text-sm mt-1 hidden"></p>
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
        <div class="mt-4 text-center">
            <span class="text-sm text-gray-600">¿No tienes cuenta?</span>
            <a href="{{ route('register') }}" class="text-sm font-semibold text-indigo-600 hover:text-indigo-500">
                Regístrate aquí
            </a>
        </div>
    </form>
</x-guest-layout>

<script>
async function checkEmailExistence() {
    const emailInput = document.getElementById('email');
    const email = emailInput.value.trim();

    if (!email || !email.includes('@')) {
        return;
    }

    try {
        const response = await fetch("{{ route('check.email') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ email: email })
        });

        const data = await response.json();

        if (data.exists) {
            // Usuario existe: Toast pequeño arriba a la derecha
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'success',
                title: 'Usuario encontrado',
                showConfirmButton: false,
                timer: 1500
            });
                } else {
            // Usuario NO existe
            Swal.fire({
                icon: 'warning',
                title: 'Usuario no encontrado',
                html: 'El correo <b>' + email + '</b> no está registrado.<br>¿Deseas crear una cuenta?',
                showCancelButton: true,
                confirmButtonText: 'Sí, registrarme',
                cancelButtonText: 'Cancelar',
                confirmButtonColor: '#4F46E5', // Azul visible
                cancelButtonColor: '#d33',     // Rojo visible
                
                // ESTO ES LO QUE FALTABA: FORZAR ESTILOS PARA QUE SEAN VISIBLES SIEMPRE
                customClass: {
                    confirmButton: 'swal2-confirm-visible',
                    cancelButton: 'swal2-cancel-visible'
                },
                
                didOpen: () => {
                    // Forzamos opacidad 1 y display block mediante JS directo al abrir
                    const confirmBtn = document.querySelector('.swal2-confirm');
                    const cancelBtn = document.querySelector('.swal2-cancel');
                    if(confirmBtn) {
                        confirmBtn.style.opacity = '1';
                        confirmBtn.style.display = 'inline-block';
                        confirmBtn.style.visibility = 'visible';
                    }
                    if(cancelBtn) {
                        cancelBtn.style.opacity = '1';
                        cancelBtn.style.display = 'inline-block';
                        cancelBtn.style.visibility = 'visible';
                    }
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "{{ route('register') }}?email=" + encodeURIComponent(email);
                }
            });
        }
    } catch (error) {
        console.error('Error:', error);
    }
}
</script>