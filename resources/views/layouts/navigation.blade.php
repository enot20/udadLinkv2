<nav x-data="{ open: false }" style="background-color: #1a1a1a;">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">
            <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex sm:items-center">
                <a href="{{ route('dashboard') }}" style="font-family: 'Anton', sans-serif; font-style: italic; font-size: 35px; text-decoration: none;">
                    <span style="color: #CDFC77;">COMUNIDAD</span> <span style="color: white;">ESTUDIANTIL</span>
                </a>
            </div>
            <!-- Navigation Links -->
            <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex sm:items-center">
                <a href="{{ route('dashboard') }}" style="font-family: 'Anton', sans-serif; font-style: italic; font-size: 25px; color: white; text-decoration: none;">
                    INICIO
                </a>
                <a href="#" style="font-family: 'Anton', sans-serif; font-style: italic; font-size: 25px; color: white; text-decoration: none; margin-left: 2rem;">
                    CONECTAR
                </a>
                <a href="#" style="font-family: 'Anton', sans-serif; font-style: italic; font-size: 25px; color: white; text-decoration: none; margin-left: 2rem;">
                    PROYECTOS
                </a>
                <a href="#" style="font-family: 'Anton', sans-serif; font-style: italic; font-size: 25px; color: white; text-decoration: none; margin-left: 2rem;">
                    NOSOTROS
                </a>
            </div>

            <!-- Profile Link -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <a href="{{ route('profile.edit') }}" style="font-family: 'Anton', sans-serif; font-style: italic; font-size: 25px; color: white; text-decoration: none;">
                    PERFIL
                </a>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden" style="background-color: #1a1a1a;">
        <div class="pt-2 pb-3 space-y-1">
            <a href="{{ route('dashboard') }}" style="font-family: 'Anton', sans-serif; font-style: italic; font-size: 30px; text-decoration: none; display: block; padding: 0.5rem 1rem;">
                <span style="color: #CDFC77;">COMUNIDAD</span> <span style="color: white;">ESTUDIANTIL</span>
            </a>
            <a href="#" style="font-family: 'Anton', sans-serif; font-style: italic; font-size: 30px; color: white; display: block; padding: 0.5rem 1rem;">
                CONECTAR
            </a>
            <a href="#" style="font-family: 'Anton', sans-serif; font-style: italic; font-size: 30px; color: white; display: block; padding: 0.5rem 1rem;">
                PROYECTOS
            </a>
            <a href="#" style="font-family: 'Anton', sans-serif; font-style: italic; font-size: 30px; color: white; display: block; padding: 0.5rem 1rem;">
                NOSOTROS
            </a>
            <a href="{{ route('profile.edit') }}" style="font-family: 'Anton', sans-serif; font-style: italic; font-size: 30px; color: white; display: block; padding: 0.5rem 1rem;">
                PERFIL
            </a>
        </div>
    </div>
</nav>
