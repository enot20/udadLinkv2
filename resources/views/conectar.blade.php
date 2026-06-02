<x-app-layout>
    <div class="min-h-screen bg-[#f5f5f0]">
        <style>
            .verde-neon{ color:#D8FF1E; }
            .bg-neon{ background:#D8FF1E; }
            .bg-hero{ background: linear-gradient(135deg,#001BFF,#000066); }
        </style>

        <!-- HERO -->
        <section class="bg-hero text-white min-h-[70vh] flex items-center">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14">
                <div class="grid md:grid-cols-2 gap-10 items-center">
                    <div>
                        <h1 class="text-4xl sm:text-5xl md:text-6xl font-extrabold uppercase mb-5 leading-tight">
                            Conecta con estudiantes de todo el país
                        </h1>
                        <p class="text-lg sm:text-xl mb-8 text-white/90">
                            Encuentra compañeros para proyectos, investigaciones, emprendimientos y actividades académicas.
                        </p>
                        <a href="#comunidad" class="bg-neon text-black px-7 py-4 font-bold rounded-lg hover:scale-[1.02] transition-transform inline-block">
                            Explorar Comunidad
                        </a>
                    </div>

                    <div class="flex justify-center">
                        <img
                            src="images/chica-banner.png"
                            alt="Estudiantes"
                            class="rounded-xl shadow-2xl w-full max-w-md"
                            loading="lazy"
                        >
                    </div>
                </div>
            </div>
        </section>

        <!-- ÁREAS DE INTERÉS -->
        <section class="bg-neon text-black py-4 font-bold text-center text-base sm:text-xl">
            Ingeniería +
            Diseño +
            Negocios +
            Ciencia +
            Tecnología +
            Innovación +
            Startups
        </section>

       <!-- COMUNIDAD -->
<section id="comunidad" class="max-w-7xl mx-auto py-14 px-4 sm:px-6 lg:px-8">

    <h2 class="text-3xl sm:text-4xl font-bold mb-10 text-gray-900">
        Miembros Destacados
    </h2>

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-8">

        <!-- CARD 1 -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-all duration-300">

            <img
                src="https://images.unsplash.com/photo-1494790108377-be9c29b29330"
                class="w-full h-56 object-cover"
                alt="Ana Martínez">

            <div class="p-6">

                <h3 class="text-xl font-bold text-gray-900 mb-3">
                    Ana Martínez
                </h3>

                <p class="text-gray-600 mb-6">
                    Estudiante de Ingeniería de Software especializada en desarrollo web y aplicaciones móviles.
                </p>

                <a href="#" class="text-blue-600 hover:underline font-medium">
                    Ver perfil
                </a>

            </div>

        </div>

        <!-- CARD 2 -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-all duration-300">

            <img
                src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e"
                class="w-full h-56 object-cover"
                alt="Carlos López">

            <div class="p-6">

                <h3 class="text-xl font-bold text-gray-900 mb-3">
                    Carlos López
                </h3>

                <p class="text-gray-600 mb-6">
                    Diseñador UX/UI enfocado en experiencias digitales intuitivas y accesibles.
                </p>

                <a href="#" class="text-blue-600 hover:underline font-medium">
                    Ver perfil
                </a>

            </div>

        </div>

        <!-- CARD 3 -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-all duration-300">

            <img
                src="https://images.unsplash.com/photo-1519085360753-af0119f7cbe7"
                class="w-full h-56 object-cover"
                alt="Sofía Ramírez">

            <div class="p-6">

                <h3 class="text-xl font-bold text-gray-900 mb-3">
                    Sofía Ramírez
                </h3>

                <p class="text-gray-600 mb-6">
                    Especialista en marketing digital y creación de estrategias para startups.
                </p>

                <a href="#" class="text-blue-600 hover:underline font-medium">
                    Ver perfil
                </a>

            </div>

        </div>

        <!-- CARD 4 -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-all duration-300">

            <img
                src="https://images.unsplash.com/photo-1506794778202-cad84cf45f1d"
                class="w-full h-56 object-cover"
                alt="José Hernández">

            <div class="p-6">

                <h3 class="text-xl font-bold text-gray-900 mb-3">
                    José Hernández
                </h3>

                <p class="text-gray-600 mb-6">
                    Analista de datos enfocado en inteligencia artificial y ciencia de datos.
                </p>

                <a href="#" class="text-blue-600 hover:underline font-medium">
                    Ver perfil
                </a>

            </div>

        </div>

    </div>

</section>

        <!-- FOOTER (simple, para acoplar con las demás páginas) -->
        <footer class="bg-zinc-950 text-white border-t border-zinc-800 py-10">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h2 class="text-3xl font-bold mb-2">
                    <span class="verde-neon">COMUNIDAD</span> ESTUDIANTIL
                </h2>
                <p class="text-gray-400">Conectando talento, innovación y oportunidades.</p>
                <p class="mt-4 text-gray-500">© {{ date('Y') }} Comunidad Estudiantil</p>
            </div>
        </footer>
    </div>
</x-app-layout>

