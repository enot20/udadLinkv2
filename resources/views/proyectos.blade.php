<x-app-layout>

    

    <main class="bg-[#111111] min-h-screen">

        <!-- HERO -->
        <section class="bg-gradient-to-r from-[#0014ff] to-[#0000cc] py-12">

            <div class="max-w-7xl mx-auto px-6">

                <h2 class="text-center text-white font-black text-4xl md:text-6xl uppercase">
                    EXPLORADOR DE PROYECTOS COLABORATIVOS
                </h2>

                <div class="mt-8 flex justify-center">

                    <div class="relative w-full max-w-4xl">

                        <input
                            type="text"
                            placeholder="Buscar proyectos..."
                            class="w-full rounded-full py-4 pl-6 pr-14 text-gray-700 text-xl focus:outline-none"
                        >

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="absolute right-5 top-4 h-8 w-8 text-gray-500"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor">

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M21 21l-4.35-4.35m1.85-5.65a7.5 7.5 0 11-15 0a7.5 7.5 0 0115 0z" />
                        </svg>

                    </div>

                </div>

            </div>

        </section>

        <!-- CATEGORÍAS -->
        <section class="py-8">

            <div class="flex flex-wrap justify-center gap-4">

                @php
                    $categorias = [
                        'Todos',
                        'Software',
                        'Arte',
                        'Ingeniería',
                        'Negocios',
                        'Ciencia',
                        'Impacto Social'
                    ];
                @endphp

                @foreach($categorias as $cat)

                    <button
                        class="px-5 py-2 rounded-full border border-[#CDFC77] text-[#CDFC77] hover:bg-[#CDFC77] hover:text-black transition">

                        {{ $cat }}

                    </button>

                @endforeach

            </div>

        </section>

        <!-- PROYECTOS -->
        <section class="max-w-7xl mx-auto px-6 pb-16">

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-6 gap-6">

                @php

                $proyectos = [

                    [
                        'titulo'=>'Aplicación de Sostenibilidad Urbana',
                        'desc'=>'Desarrollo de una app móvil para rastrear y reducir la huella de carbono.',
                        'tags'=>['Software','Sostenibilidad','Ingeniería']
                    ],

                    [
                        'titulo'=>'Instalación de Arte Interactivo',
                        'desc'=>'Experiencia inmersiva utilizando sensores y proyecciones.',
                        'tags'=>['Arte','Tecnología','Diseño']
                    ],

                    [
                        'titulo'=>'Emprendimiento Social para Educación',
                        'desc'=>'Plataforma para conectar tutores voluntarios.',
                        'tags'=>['Negocios','Impacto Social','Software']
                    ],

                    [
                        'titulo'=>'Robot Autónomo para Agricultura',
                        'desc'=>'Diseño de un prototipo robótico para tareas automatizadas.',
                        'tags'=>['Ingeniería','Ciencia','Robótica']
                    ],

                    [
                        'titulo'=>'Revista Digital de Cultura Estudiantil',
                        'desc'=>'Creación de contenido multimedia universitario.',
                        'tags'=>['Arte','Comunicación','Diseño']
                    ],

                    [
                        'titulo'=>'Investigación de IA y Ética',
                        'desc'=>'Grupo de estudio sobre inteligencia artificial responsable.',
                        'tags'=>['Ciencia','Tecnología','Filosofía']
                    ]

                ];

                @endphp

                @foreach($proyectos as $proyecto)

                <article
                    class="bg-[#1b1b1b] border-2 border-[#CDFC77] rounded-xl p-4 shadow-lg hover:scale-105 transition duration-300">

                    <h3 class="text-white text-2xl font-black leading-tight">
                        {{ $proyecto['titulo'] }}
                    </h3>

                    <p class="text-gray-300 mt-4 text-sm">
                        {{ $proyecto['desc'] }}
                    </p>

                    <div class="flex flex-wrap gap-2 mt-4">

                        @foreach($proyecto['tags'] as $tag)

                        <span
                            class="text-xs border border-[#CDFC77] text-[#CDFC77] rounded-full px-3 py-1">

                            {{ $tag }}

                        </span>

                        @endforeach

                    </div>

                    <button
                        class="mt-5 w-full bg-[#CDFC77] text-black font-black py-3 rounded-lg hover:bg-[#dfff59] transition">

                        UNIRSE

                    </button>

                </article>

                @endforeach

            </div>

        </section>

    </main>

    <footer class="bg-black border-t border-[#CDFC77] py-8">

        <div class="max-w-7xl mx-auto px-6">

            <div class="flex flex-col md:flex-row justify-between items-center gap-6">

                <div>
                    <h3 class="text-[#CDFC77] text-3xl font-black">
                        FOOTER
                    </h3>

                    <p class="text-gray-400 mt-2">
                        Desarrollado por Frame | Comunidad Estudiantil
                    </p>
                </div>

                <div class="flex gap-6 font-bold text-white uppercase">

                    <a href="{{ route('dashboard') }}">Inicio</a>
                    <a href="{{ route('proyectos') }}">Proyectos</a>
                    <a href="{{ route('conectar') }}">Conectar</a>
                    <a href="{{ route('nosotros') }}">Nosotros</a>
                    <a href="{{ route('profile.edit') }}">Perfil</a>
                    <a href="#">Contacto</a>

                </div>

            </div>

        </div>

    </footer>

</x-app-layout>



