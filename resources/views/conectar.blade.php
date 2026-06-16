<x-app-layout>
    <div class="min-h-screen bg-[#f5f5f0]">
         <style>
        .bg-hero {
            background: linear-gradient(135deg, #001BFF, #000066);
            background-size: cover;
            background-position: center;
        }
        .hero-container {
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: space-between;
            gap: 40px;
            min-height: 80vh; /* más alto para cubrir */
            padding: 4rem 2rem;
        }
        .hero-text h1 {
            font-size: 4rem;
            font-weight: 800;
            text-transform: uppercase;
            margin-bottom: 1.5rem;
            line-height: 1.1;
            color: #fff;
            text-shadow: 0 0 12px rgba(0,0,0,0.5);
        }
        .hero-text p {
            font-size: 1.4rem;
            color: rgba(255,255,255,0.9);
            margin-bottom: 2rem;
        }
        .hero-text a {
            background: #D8FF1E;
            color: #000;
            padding: 1rem 2rem;
            font-weight: 700;
            border-radius: 8px;
            display: inline-block;
            transition: transform 0.2s ease;
            z-index: 50;
            position: relative;
        }
        .hero-text a:hover {
            transform: scale(1.05);
        }

        /* 🔧 Ajustes para móvil */
        @media (max-width: 640px) {
            .hero-container {
                flex-direction: column;
                text-align: center;
                gap: 20px;
                padding: 2rem 1rem;
                min-height: 100vh; /* ocupa toda la pantalla */
            }
            .hero-text h1 {
                font-size: 2.4rem;
                line-height: 1.2;
            }
            .hero-text p {
                font-size: 1rem;
                margin-bottom: 1.5rem;
            }
            .hero-text a {
                width: 100%;
                font-size: 1.1rem;
                padding: 1rem;
            }
            .hero-image img {
                width: 80%;
                margin: 0 auto;
                display: block;
            }
        }
    </style>

        <section class="bg-hero text-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14 w-full hero-container">
                <div class="hero-text">
                    <h1>Conecta con estudiantes de todo el país</h1>
                    <p>Encuentra compañeros para proyectos, investigaciones, emprendimientos y actividades académicas.</p>
                    <a href="#comunidad">Explorar Comunidad</a>
                </div>

                <div class="hero-image">
                    <img src="/images/chica-banner.png" alt="Estudiantes" loading="lazy">
                </div>
            </div>
        </section>

        <section style="background-color:#D8FF1E; color:#000; padding:1rem 0; font-weight:700; text-align:center; font-size:1.1rem; width:100%; display:block; clear:both;">
            Ingeniería + Diseño + Negocios + Ciencia + Tecnología + Innovación + Startups
        </section>


       <section id="comunidad" class="max-w-7xl mx-auto py-14 px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl sm:text-4xl font-bold mb-10 text-gray-900 text-center">
                Miembros Destacados
            </h2>

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2rem;">
                @foreach($miembros as $miembro)
                <div style="background:#fff; border-radius:8px; box-shadow:0 2px 6px rgba(0,0,0,0.15); overflow:hidden;">
                    <img src="{{ $miembro->foto_perfil ? asset('storage/'.$miembro->foto_perfil) : '/images/default-avatar.png' }}"
                        style="width:100%; height:250px; object-fit:cover;"
                        alt="{{ $miembro->name }}">
                    <div style="padding:1rem;">
                        <h3 style="font-size:1.2rem; font-weight:bold; margin-bottom:0.5rem;">{{ $miembro->name }}</h3>
                        <p style="color:#555; margin-bottom:0.5rem;">Carrera: {{ $miembro->carrera ?? 'No especificada' }}</p>
                        <p style="color:#555; margin-bottom:0.5rem;">Carnet: {{ $miembro->carnet }}</p>
                        <p style="color:#555; margin-bottom:1rem;">Email: {{ $miembro->email }}</p>
                        <!-- ⭐ Bloque de estrellas con texto -->
                    <div style="color:#FFD700; font-size:1.4rem; margin-bottom:0.5rem;">
                        ★ ★ ★ ★ ★
                    </div>
                    <p style="font-size:0.9rem; color:#333; margin-bottom:1rem; font-weight:600;">
                        Califícame
                    </p>
                        <a href="{{ route('profile.edit', $miembro->id) }}" style="color:#1E40AF; font-weight:600; text-decoration:none;">
                            Ver perfil
                        </a>
                    </div>
                </div>
                @endforeach
            </div>

        </section>




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
