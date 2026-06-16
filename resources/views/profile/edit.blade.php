<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Perfil') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Sección administrar proyecto usuarios -->


            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.editar-proyet-user')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <!-- Sección 2FA -->
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <h3 class="text-lg font-medium text-gray-900">Autenticación de Doble Factor</h3>
                    <p class="mt-1 text-sm text-gray-600">Añade seguridad extra a tu cuenta usando Google Authenticator o Authy.</p>

                    <div class="mt-4 flex items-center gap-4">
                        @if(Auth::user()->google2fa_enabled)
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                                2FA Activado
                            </span>
                            <button type="button" onclick="document.getElementById('disable-2fa-modal').classList.remove('hidden')" class="text-red-600 hover:text-red-800 text-sm font-medium">
                                Desactivar
                            </button>
                        @else
                            <a href="{{ route('2fa.enable') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 text-sm font-medium">
                                Activar 2FA
                            </a>
                        @endif
                    </div>
                    
                    @if(session('status'))
                        <p class="mt-3 text-green-600 text-sm">{{ session('status') }}</p>
                    @endif
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Desactivar 2FA -->
    @if(Auth::user()->google2fa_enabled)
    <div id="disable-2fa-modal" class="fixed inset-0 bg-black/50 flex items-center justify-center z-50 hidden" onclick="if(event.target === this) document.getElementById('disable-2fa-modal').classList.add('hidden')">
        <div class="bg-white rounded-2xl p-6 max-w-md w-full mx-4" onclick="event.stopPropagation()">
            <h3 class="text-lg font-bold text-gray-900 mb-2">Desactivar 2FA</h3>
            <p class="text-gray-600 text-sm mb-4">Para desactivar la autenticación de doble factor, ingresa tu contraseña.</p>
            
            <form method="POST" action="{{ route('2fa.disable') }}">
                @csrf
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Contraseña</label>
                    <input type="password" name="password" id="password" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                    @error('password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="flex gap-3">
                    <button type="button" onclick="document.getElementById('disable-2fa-modal').classList.add('hidden')" class="flex-1 px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 font-medium">
                        Cancelar
                    </button>
                    <button type="submit" class="flex-1 px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 font-medium">
                        Desactivar
                    </button>
                </div>
            </form>
        </div>
    </div>
    @endif
</x-app-layout>
