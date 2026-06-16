<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="carnet" :value="__('Carnet Universitario')" />
            <x-text-input id="carnet" name="carnet" type="text" class="mt-1 block w-full" :value="$user->carnet" required autofocus autocomplete="carnet" />
            <x-input-error class="mt-2" :messages="$errors->get('carnet')" />
        </div>

        <div>
            <x-input-label for="carrera" :value="__('Carrera')" />
            <x-text-input id="carrera" name="carrera" type="text" class="mt-1 block w-full" :value="$user->carrera" required autofocus autocomplete="carrera" />
            <x-input-error class="mt-2" :messages="$errors->get('carrera')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="p-4 bg-gray-50 rounded-xl border border-gray-200 flex flex-col sm:flex-row items-center space-y-4 sm:space-y-0 sm:space-x-4 max-w-full overflow-hidden">
    <div class="shrink-0 w-20 h-20">
        @if($user->foto_perfil)
            <img class="w-20 h-20 rounded-full object-cover aspect-square border-2 border-blue-600 shadow-sm" 
                 src="{{ asset('storage/' . $user->foto_perfil) }}" 
                 alt="Avatar">
        @else
            <div class="w-20 h-20 rounded-full bg-gradient-to-br from-blue-600 to-indigo-700 flex items-center justify-center font-bold text-white text-xl uppercase shadow">
                {{ substr($user->name, 0, 2) }}
            </div>
        @endif
    </div>
    
    <div class="flex-1 w-full min-w-0">
        <x-input-label for="avatar" :value="__('Fotografía de Perfil')" class="font-semibold text-gray-700 text-center sm:text-left" />
        <input id="avatar" name="avatar" type="file" accept="image/*"
               class="mt-1 block w-full text-sm text-gray-500 
                      file:mr-4 file:py-2 file:px-4 
                      file:rounded-md file:border-0 
                      file:text-xs file:font-semibold 
                      file:bg-blue-50 file:text-blue-700 
                      hover:file:bg-blue-100
                      border border-gray-300 rounded-lg p-1 bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 visual-fallback" />
        <x-input-error class="mt-2" :messages="$errors->get('avatar')" />
    </div>
</div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>
        </div>

        @if (session('status') === 'profile-updated')
        <script>
            window.addEventListener('load', function() {
                Swal.fire({
                    icon: 'success',
                    title: '¡Datos actualizados!',
                    text: 'Tu información de perfil ha sido guardada correctamente.',
                    confirmButtonColor: '#4F46E5',
                    confirmButtonText: 'Aceptar'
                });
            });
        </script>
        @endif
    </form>
</section>