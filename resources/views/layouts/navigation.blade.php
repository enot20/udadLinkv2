<nav x-data="{ open: false }" style="background-color: #1a1a1a;">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">
            <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex sm:items-center">
                <a href="{{ route('dashboard') }}" class="responsive-logo" style="font-family: 'Anton', sans-serif; font-style: italic; font-size: 35px; text-decoration: none;">
                    <span style="color: #CDFC77;">COMUNIDAD</span> <span style="color: white;">ESTUDIANTIL</span>
                </a>
            </div>
            <!-- Navigation Links -->
            <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex sm:items-center">
                <a href="{{ route('dashboard') }}" class="responsive-link" style="font-family: 'Anton', sans-serif; font-style: italic; font-size: 25px; color: white; text-decoration: none;">
                    INICIO
                </a>
                <a href="#" class="responsive-link" style="font-family: 'Anton', sans-serif; font-style: italic; font-size: 25px; color: white; text-decoration: none; margin-left: 2rem;">
                    CONECTAR
                </a>
                <a href="#" class="responsive-link" style="font-family: 'Anton', sans-serif; font-style: italic; font-size: 25px; color: white; text-decoration: none; margin-left: 2rem;">
                    PROYECTOS
                </a>
                <a href="#" class="responsive-link" style="font-family: 'Anton', sans-serif; font-style: italic; font-size: 25px; color: white; text-decoration: none; margin-left: 2rem;">
                    NOSOTROS
                </a>
            </div>

            <!-- Profile Link -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-300 bg-transparent hover:text-white focus:outline-none transition ease-in-out duration-150">
                            <div class="responsive-profile" style="font-family: 'Anton', sans-serif; font-style: italic; font-size: 25px;">
                                PERFIL
                            </div>
                            <div class="ms-1">
                                <svg class="fill-current h-5 w-5" viewBox="0 0 20 20" fill="white">
                                    <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Actualizar Perfil') }}
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Cerrar Sesión') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-white hover:bg-gray-700 focus:outline-none transition duration-150 ease-in-out">
                    <svg class="h-8 w-8" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden fixed inset-0 w-full h-full" style="background-color: #1a1a1a; z-index: 50; overflow-y: auto;">
        <div class="w-full px-4 py-4">
            <div class="flex justify-between items-center mb-6">
                <div class="text-xl font-bold text-white">MENÚ</div>
                <button @click="open = false" class="text-white text-2xl">&times;</button>
            </div>
            
            <div class="space-y-4 w-full">
                <a href="{{ route('dashboard') }}" class="block w-full text-center py-4 responsive-mobile-logo" style="font-family: 'Anton', sans-serif; font-style: italic; font-size: 28px; text-decoration: none;">
                    <span style="color: #CDFC77;">COMUNIDAD</span> <span style="color: white;">ESTUDIANTIL</span>
                </a>
                <a href="#" class="block w-full text-center py-4 responsive-mobile-link" style="font-family: 'Anton', sans-serif; font-style: italic; font-size: 25px; color: white; text-decoration: none;">
                    INICIO
                </a>
                <a href="#" class="block w-full text-center py-4 responsive-mobile-link" style="font-family: 'Anton', sans-serif; font-style: italic; font-size: 25px; color: white; text-decoration: none;">
                    CONECTAR
                </a>
                <a href="#" class="block w-full text-center py-4 responsive-mobile-link" style="font-family: 'Anton', sans-serif; font-style: italic; font-size: 25px; color: white; text-decoration: none;">
                    PROYECTOS
                </a>
                <a href="#" class="block w-full text-center py-4 responsive-mobile-link" style="font-family: 'Anton', sans-serif; font-style: italic; font-size: 25px; color: white; text-decoration: none;">
                    NOSOTROS
                </a>
            </div>

            <div class="mt-8 pt-4 border-t border-gray-600 w-full">
                <div class="text-center mb-4">
                    <div class="font-medium text-base text-white">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-400">{{ Auth::user()->email }}</div>
                </div>

                <div class="space-y-2 w-full">
                    <a href="{{ route('profile.edit') }}" class="block w-full text-center py-3 bg-gray-700 rounded-lg text-white">
                        {{ __('Actualizar Perfil') }}
                    </a>
                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <button type="submit" class="block w-full text-center py-3 bg-red-600 rounded-lg text-white">
                            {{ __('Cerrar Sesión') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</nav>

<style>
@media (max-width: 640px) {
    .responsive-logo { font-size: 24px !important; }
    .responsive-link { font-size: 18px !important; }
    .responsive-profile { font-size: 18px !important; }
    .responsive-mobile-logo { font-size: 24px !important; }
    .responsive-mobile-link { font-size: 20px !important; }
}
</style>