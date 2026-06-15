    <x-app-layout>

    <style>
        /* ── Reset base ── */
        .frame-main  { background:#0d0d0d; min-height:100vh; font-family:inherit; }

        /* ── Hero ── */
        .frame-hero  {
            position:relative; overflow:hidden;
            background: linear-gradient(135deg,#0014ff 0%,#0000aa 100%);
            padding: 4rem 1.5rem;
            text-align:center;
        }
        .frame-blob {
            position:absolute; border-radius:50%;
            filter:blur(80px); opacity:.2;
            animation: blobMove 10s ease-in-out infinite alternate;
        }
        .frame-blob-1 { width:500px;height:500px;background:#CDFC77;top:-150px;left:-100px; }
        .frame-blob-2 { width:400px;height:400px;background:#00aaff;bottom:-120px;right:-80px;animation-delay:3s; }
        @keyframes blobMove {
            from { transform:translate(0,0) scale(1); }
            to   { transform:translate(40px,30px) scale(1.08); }
        }

        .frame-badge {
            display:inline-block;
            border:1px solid rgba(205,252,119,.4);
            color:#CDFC77; border-radius:9999px;
            padding:.25rem 1rem; font-size:.75rem;
            font-weight:700; letter-spacing:.1em; text-transform:uppercase;
            margin-bottom:1rem;
        }
        .frame-hero h1 {
            color:#fff; font-weight:900; font-size:clamp(2.2rem,7vw,4.5rem);
            text-transform:uppercase; line-height:1.05; margin:0;
        }
        .frame-hero h1 span { color:#CDFC77; }
        .frame-hero p  { color:rgba(200,220,255,.8); margin:.75rem auto 0; max-width:480px; font-size:1.05rem; }

        /* Buscador */
        .frame-search-wrap { margin-top:2.5rem; display:flex; justify-content:center; }
        .frame-search-inner { position:relative; width:100%; max-width:680px; }
        .frame-search-inner input {
            width:100%; border-radius:1rem; padding:1.1rem 3.5rem 1.1rem 1.5rem;
            font-size:1rem; border:none; outline:none;
            box-shadow:0 4px 30px rgba(0,0,0,.3);
            transition: box-shadow .2s;
        }
        .frame-search-inner input:focus { box-shadow:0 0 0 3px rgba(205,252,119,.5); }
        .frame-search-inner svg { position:absolute;right:1rem;top:50%;transform:translateY(-50%);width:1.5rem;height:1.5rem;color:#666; }
        .frame-counter { color:rgba(180,200,255,.7); font-size:.85rem; margin-top:.75rem; }
        .frame-counter span { color:#fff; font-weight:700; }

        /* ── Filtros ── */
        .frame-filters {
            position:sticky; top:0; z-index:40;
            background:rgba(13,13,13,.92);
            backdrop-filter:blur(12px);
            border-bottom:1px solid rgba(255,255,255,.08);
            padding:.9rem 1.5rem;
        }
        .frame-filters-inner { display:flex;flex-wrap:wrap;justify-content:center;gap:.6rem;max-width:1200px;margin:0 auto; }
        .frame-cat-btn {
            padding:.4rem 1.1rem; border-radius:9999px;
            border:1px solid rgba(205,252,119,.35);
            color:rgba(205,252,119,.75); background:transparent;
            font-size:.8rem; font-weight:700; cursor:pointer;
            display:flex; align-items:center; gap:.4rem;
            transition: background .2s, color .2s, border-color .2s;
        }
        .frame-cat-btn:hover,
        .frame-cat-btn.activo {
            background:#CDFC77; color:#000; border-color:#CDFC77;
        }

        /* ── Grid ── */
        .frame-grid-wrap { max-width:1200px; margin:0 auto; padding:2.5rem 1.5rem 4rem; }
        .frame-grid {
            display:grid;
            grid-template-columns: repeat(auto-fill, minmax(300px,1fr));
            gap:1.25rem;
        }

        /* ── Card ── */
        .frame-card {
            background:#161616;
            border:1px solid rgba(255,255,255,.1);
            border-radius:1.25rem; padding:1.5rem;
            display:flex; flex-direction:column;
            transition: border-color .25s, box-shadow .25s, transform .25s;
        }
        .frame-card:hover {
            border-color:rgba(205,252,119,.55);
            box-shadow:0 0 35px rgba(205,252,119,.07);
            transform:translateY(-3px);
        }
        .frame-card-header { display:flex;justify-content:space-between;align-items:flex-start;gap:.75rem;margin-bottom:1rem; }
        .frame-card-emoji  { font-size:2.2rem; }

        .estado-Activo      { color:#4ade80; border-color:rgba(74,222,128,.35); background:rgba(74,222,128,.1); }
        .estado-Reclutando  { color:#CDFC77; border-color:rgba(205,252,119,.35); background:rgba(205,252,119,.1); }
        .estado-Casi-lleno  { color:#fb923c; border-color:rgba(251,146,60,.35);  background:rgba(251,146,60,.1); }
        .frame-estado {
            font-size:.7rem; font-weight:700;
            padding:.25rem .75rem; border-radius:9999px; border:1px solid;
            white-space:nowrap;
        }

        .frame-card h3 {
            color:#fff; font-weight:900; font-size:1.1rem; line-height:1.3;
            margin:0 0 .6rem; transition:color .2s;
        }
        .frame-card:hover h3 { color:#CDFC77; }
        .frame-card p  { color:#9ca3af; font-size:.85rem; line-height:1.6; flex:1; margin:0; }

        /* Tags */
        .frame-tags { display:flex;flex-wrap:wrap;gap:.4rem;margin-top:1rem; }
        .frame-tag  {
            font-size:.7rem; border:1px solid rgba(255,255,255,.15);
            color:#d1d5db; border-radius:9999px; padding:.2rem .7rem;
            transition: border-color .2s, color .2s;
        }
        .frame-card:hover .frame-tag { border-color:rgba(205,252,119,.3); color:#CDFC77; }

        /* Barra miembros */
        .frame-members     { margin-top:1.1rem; }
        .frame-members-row { display:flex;justify-content:space-between;font-size:.72rem;color:#6b7280;margin-bottom:.4rem; }
        .frame-bar-bg   { background:rgba(255,255,255,.1);border-radius:9999px;height:5px; }
        .frame-bar-fill { background:#CDFC77;height:5px;border-radius:9999px;transition:width .6s ease; }

        /* Botón */
        .frame-btn {
            margin-top:1.25rem; width:100%;
            background:rgba(255,255,255,.05);
            border:1px solid rgba(255,255,255,.18);
            color:#fff; font-weight:700; font-size:.8rem;
            padding:.8rem; border-radius:.75rem;
            cursor:pointer; text-transform:uppercase; letter-spacing:.05em;
            transition: background .2s, color .2s, border-color .2s;
        }
        .frame-btn:hover { background:#CDFC77; color:#000; border-color:#CDFC77; }

        /* Sin resultados */
        .frame-empty { text-align:center; padding:5rem 0; display:none; }
        .frame-empty p { color:#6b7280; margin-top:.5rem; }

        /* Ocultar card */
        .frame-card.oculto { display:none; }

        /* Footer */
        .frame-footer {
            background:#0a0a0a;
            border-top:1px solid rgba(255,255,255,.08);
            padding:2.5rem 1.5rem;
        }
        .frame-footer-inner {
            max-width:1200px; margin:0 auto;
            display:flex; flex-wrap:wrap;
            justify-content:space-between; align-items:center; gap:1.5rem;
        }
        .frame-footer h3  { color:#CDFC77; font-size:1.5rem; font-weight:900; margin:0; }
        .frame-footer small{ color:#6b7280; display:block; margin-top:.2rem; font-size:.8rem; }
        .frame-footer nav { display:flex;flex-wrap:wrap;gap:1.25rem; }
        .frame-footer nav a { color:#9ca3af;font-size:.85rem;font-weight:600;text-transform:uppercase;letter-spacing:.05em;text-decoration:none;transition:color .2s; }
        .frame-footer nav a:hover { color:#CDFC77; }
    </style>

    <main class="frame-main">

        {{-- HERO --}}
        <section class="frame-hero">
            <div class="frame-blob frame-blob-1"></div>
            <div class="frame-blob frame-blob-2"></div>

            <div style="position:relative;">
                <div class="frame-badge">Comunidad Estudiantil · Frame</div>

                <h1>Explorador de<br><span>Proyectos</span> Colaborativos</h1>

                <p>Encuentra equipos, únete a proyectos y construye algo increíble juntos.</p>

                <div class="frame-search-wrap">
                    <div class="frame-search-inner">
                        <input
                            id="busqueda"
                            type="text"
                            placeholder="Buscar proyectos, tecnologías, áreas..."
                            oninput="aplicarFiltros()"
                        >
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-4.35-4.35m1.85-5.65a7.5 7.5 0 11-15 0 7.5 7.5 0 0115 0z"/>
                        </svg>
                    </div>
                </div>

                <p class="frame-counter">
                    Mostrando <span id="num-resultados">6</span> proyectos
                </p>
            </div>
        </section>

        {{-- FILTROS --}}
        <div class="frame-filters">
            <div class="frame-filters-inner" id="filtros">
                @php
                    $categorias = [
                    'Todos'              => '✦',
                    'Ingeniería'         => '💻',
                    'Comunicaciones'     => '📢',
                    'Ciencias Jurídicas' => '⚖️',
                    'Administración'     => '📈',
                    'Impacto Social'     => '🌱',
                    ];
                @endphp
                @foreach($categorias as $cat => $icon)
                    <button
                        class="frame-cat-btn {{ $cat === 'Todos' ? 'activo' : '' }}"
                        data-categoria="{{ $cat }}"
                        onclick="filtrarCategoria('{{ $cat }}')">
                        <span>{{ $icon }}</span> {{ $cat }}
                    </button>
                @endforeach
            </div>
        </div>

        {{-- PROYECTOS --}}
        <div class="frame-grid-wrap">

            @php
            $proyectos = [
            [
                    'titulo'  => 'Desarrollo de Sitio Web para Emprendimiento Local',
                    'desc'    => 'Diseño y desarrollo de un sitio web para promocionar los productos y servicios de un emprendimiento de la comunidad.',
                    'tags'    => ['Ingeniería','Desarrollo Web','Tecnología'],
                    'miembros'=> 4,
                    'slots'   => 3,
                    'estado'  => 'Activo',
                    'emoji'   => '💻',
                ],
                [
                    'titulo'  => 'Campaña de Comunicación Institucional',
                    'desc'    => 'Creación de contenido para redes sociales, diseño gráfico y estrategia digital para fortalecer la imagen de una organización.',
                    'tags'    => ['Comunicaciones','Marketing','Diseño'],
                    'miembros'=> 3,
                    'slots'   => 4,
                    'estado'  => 'Reclutando',
                    'emoji'   => '📢',
                ],
                [
                    'titulo'  => 'Asesoría Jurídica Comunitaria',
                    'desc'    => 'Proyecto orientado a brindar información legal básica y apoyo en temas de derechos ciudadanos a comunidades vulnerables.',
                    'tags'    => ['Ciencias Jurídicas','Derecho','Impacto Social'],
                    'miembros'=> 5,
                    'slots'   => 2,
                    'estado'  => 'Activo',
                    'emoji'   => '⚖️',
                ],
                [
                    'titulo'  => 'Sistema de Control de Inventario',
                    'desc'    => 'Desarrollo de una aplicación para gestionar inventarios y generar reportes para pequeñas empresas.',
                    'tags'    => ['Ingeniería','Base de Datos','Software'],
                    'miembros'=> 4,
                    'slots'   => 3,
                    'estado'  => 'Activo',
                    'emoji'   => '📦',
                ],
                [
                    'titulo'  => 'Revista Digital Universitaria',
                    'desc'    => 'Producción de artículos, entrevistas, fotografías y contenido multimedia para una revista estudiantil en línea.',
                    'tags'    => ['Comunicaciones','Periodismo','Multimedia'],
                    'miembros'=> 6,
                    'slots'   => 2,
                    'estado'  => 'Casi lleno',
                    'emoji'   => '📰',
                ],
                [
                    'titulo'  => 'Plan de Negocios para Emprendedores',
                    'desc'    => 'Elaboración de estudios de mercado, análisis financiero y estrategias comerciales para nuevos emprendimientos.',
                    'tags'    => ['Administración','Negocios','Emprendimiento'],
                    'miembros'=> 5,
                    'slots'   => 4,
                    'estado'  => 'Reclutando',
                    'emoji'   => '📈',
                ],
            ];
            @endphp

            <div class="frame-grid" id="grid-proyectos">
                @foreach($proyectos as $proyecto)
                @php
                    $total = $proyecto['miembros'] + $proyecto['slots'];
                    $pct   = round(($proyecto['miembros'] / $total) * 100);
                    $estadoClass = 'estado-' . str_replace(' ', '-', $proyecto['estado']);
                    $tagsJson = json_encode($proyecto['tags']);
                    $busquedaData = strtolower($proyecto['titulo'] . ' ' . $proyecto['desc']);
                @endphp

                <article
                    class="frame-card"
                    data-tags="{{ $tagsJson }}"
                    data-titulo="{{ $busquedaData }}">

                    <div class="frame-card-header">
                        <div class="frame-card-emoji">{{ $proyecto['emoji'] }}</div>
                        <span class="frame-estado {{ $estadoClass }}">{{ $proyecto['estado'] }}</span>
                    </div>

                    <h3>{{ $proyecto['titulo'] }}</h3>
                    <p>{{ $proyecto['desc'] }}</p>

                    <div class="frame-tags">
                        @foreach($proyecto['tags'] as $tag)
                            <span class="frame-tag">{{ $tag }}</span>
                        @endforeach
                    </div>

                    <div class="frame-members">
                        <div class="frame-members-row">
                            <span>👥 {{ $proyecto['miembros'] }} miembros</span>
                            <span>{{ $proyecto['slots'] }} slots libres</span>
                        </div>
                        <div class="frame-bar-bg">
                            <div class="frame-bar-fill" style="width:{{ $pct }}%"></div>
                        </div>
                    </div>

                    <button class="frame-btn">Unirse al proyecto →</button>
                </article>
                @endforeach
            </div>

            <div class="frame-empty" id="sin-resultados">
                <div style="font-size:3.5rem">🔍</div>
                <h3 style="color:#fff;font-weight:900;margin:.5rem 0 0">Sin resultados</h3>
                <p>Intenta con otra búsqueda o categoría.</p>
            </div>

        </div>

    </main>

    {{-- FOOTER --}}
    <footer class="frame-footer">
        <div class="frame-footer-inner">
            <div>
                <h3>FRAME</h3>
                <small>Plataforma de colaboración estudiantil</small>
            </div>
            <nav>
                <a href="{{ route('dashboard') }}">Inicio</a>
                <a href="{{ route('proyectos') }}">Proyectos</a>
                <a href="{{ route('conectar') }}">Conectar</a>
                <a href="{{ route('nosotros') }}">Nosotros</a>
                <a href="{{ route('profile.edit') }}">Perfil</a>
                
            </nav>
        </div>
    </footer>

    <script>
        let categoriaActiva = 'Todos';

        function filtrarCategoria(cat) {
            categoriaActiva = cat;
            document.querySelectorAll('.frame-cat-btn').forEach(btn => {
                btn.classList.toggle('activo', btn.dataset.categoria === cat);
            });
            aplicarFiltros();
        }

        function aplicarFiltros() {
            const busqueda = document.getElementById('busqueda').value.toLowerCase().trim();
            const cards    = document.querySelectorAll('.frame-card');
            let visibles   = 0;

            cards.forEach(card => {
                const tags   = JSON.parse(card.dataset.tags || '[]');
                const titulo = card.dataset.titulo || '';

                const okCat = categoriaActiva === 'Todos' ||
                    tags.some(t => t.toLowerCase() === categoriaActiva.toLowerCase());
                const okBus = busqueda === '' || titulo.includes(busqueda);

                if (okCat && okBus) {
                    card.classList.remove('oculto');
                    visibles++;
                } else {
                    card.classList.add('oculto');
                }
            });

            document.getElementById('num-resultados').textContent = visibles;
            document.getElementById('sin-resultados').style.display = visibles > 0 ? 'none' : 'block';
        }
    </script>

    </x-app-layout>