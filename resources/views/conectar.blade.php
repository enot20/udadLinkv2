<x-app-layout>
<div class="min-h-screen" style="background:#0a0a0a; font-family:'Inter',sans-serif;">

<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap');

    :root {
        --neon: #D8FF1E;
        --bg: #0a0a0a;
        --card: #141414;
        --border: #222;
        --muted: #888;
    }

    .ce-hero {
        background: linear-gradient(135deg, #0000FF 0%, #0000aa 100%);
        padding: 4rem 2rem 3.5rem;
        text-align: center;
    }
    .ce-hero h1 {
        font-size: clamp(2.8rem, 6vw, 5.5rem);
        font-weight: 900;
        text-transform: uppercase;
        line-height: 1.05;
        color: #fff;
        letter-spacing: -.01em;
        margin: 0;
    }
    .ce-hero h1 .highlight { color: var(--neon); }

    .ce-main {
        max-width: 1280px;
        margin: 0 auto;
        padding: 3rem 2rem;
        display: grid;
        grid-template-columns: 210px 1fr;
        gap: 3rem;
        align-items: start;
    }
    @media(max-width:768px){
        .ce-main { grid-template-columns: 1fr; }
        .ce-sidebar { display: none; }
    }

    .ce-sidebar { position: sticky; top: 24px; }
    .ce-filter-group { margin-bottom: 2rem; }
    .ce-filter-title {
        font-size: .68rem;
        font-weight: 800;
        letter-spacing: .15em;
        text-transform: uppercase;
        color: #fff;
        margin-bottom: .9rem;
        padding-bottom: .5rem;
        border-bottom: 1px solid var(--border);
    }
    .ce-filter-item {
        display: flex;
        align-items: center;
        gap: .6rem;
        margin-bottom: .55rem;
        cursor: pointer;
    }
    .ce-filter-item label {
        font-size: .82rem;
        color: var(--muted);
        cursor: pointer;
        transition: color .15s;
        user-select: none;
    }
    .ce-filter-item:hover label { color: var(--neon); }
    .ce-checkbox {
        width: 14px; height: 14px;
        border: 1.5px solid #444;
        border-radius: 3px;
        background: transparent;
        appearance: none; -webkit-appearance: none;
        cursor: pointer; flex-shrink: 0;
        transition: background .15s, border-color .15s;
        position: relative;
    }
    .ce-checkbox:checked { background: var(--neon); border-color: var(--neon); }
    .ce-checkbox:checked::after {
        content: '';
        position: absolute;
        left: 3px; top: 1px;
        width: 5px; height: 8px;
        border: 2px solid #000;
        border-top: none; border-left: none;
        transform: rotate(45deg);
    }

    .ce-count {
        font-size: .72rem;
        color: var(--muted);
        margin-bottom: 1.25rem;
        font-weight: 500;
    }
    .ce-count span { color: var(--neon); font-weight: 700; }

    .ce-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(190px, 1fr));
        gap: 1.25rem;
    }

    .ce-card-student {
        background: var(--card);
        border: 1px solid var(--border);
        border-radius: 10px;
        overflow: hidden;
        transition: border-color .25s, transform .25s;
        cursor: pointer;
    }
    .ce-card-student:hover { border-color: var(--neon); transform: translateY(-4px); }
    .ce-card-student.hidden { display: none; }

    .ce-card-img {
        width: 100%;
        aspect-ratio: 1 / 1.15;
        object-fit: cover;
        object-position: top;
        filter: grayscale(100%) contrast(1.05);
        display: block;
        transition: filter .3s;
    }
    .ce-card-student:hover .ce-card-img { filter: grayscale(60%) contrast(1.1); }

    /* Avatar de iniciales cuando no hay foto */
    .ce-card-avatar {
        width: 100%;
        aspect-ratio: 1 / 1.15;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #1a1a2e;
        font-size: 2.5rem;
        font-weight: 900;
        color: var(--neon);
        text-transform: uppercase;
        letter-spacing: .05em;
    }

    .ce-card-body { padding: 1rem 1rem .9rem; }
    .ce-card-name {
        font-size: .95rem; font-weight: 800;
        color: #fff; margin-bottom: .2rem;
        text-transform: uppercase; letter-spacing: .01em;
    }
    .ce-card-carrera {
        font-size: .6rem; font-weight: 700;
        letter-spacing: .1em; text-transform: uppercase;
        color: var(--muted); margin-bottom: .2rem;
    }
    .ce-card-skill {
        font-size: .62rem; font-weight: 700;
        letter-spacing: .12em; text-transform: uppercase;
        color: var(--neon); margin-bottom: .85rem;
    }
    .ce-btn-ver {
        display: block; width: 100%;
        background: var(--neon); color: #000;
        font-size: .7rem; font-weight: 800;
        letter-spacing: .1em; text-transform: uppercase;
        text-align: center; padding: .55rem 1rem;
        border-radius: 5px; border: none;
        cursor: pointer;
        transition: opacity .2s, transform .15s;
        box-sizing: border-box;
    }
    .ce-btn-ver:hover { opacity: .85; transform: scale(1.02); }

    .ce-empty {
        grid-column: 1/-1; text-align: center;
        padding: 4rem 2rem; color: var(--muted);
        font-size: .9rem; display: none;
    }
    .ce-empty.visible { display: block; }
    .ce-empty-icon { font-size: 2.5rem; margin-bottom: 1rem; }

    /* ── MODAL ── */
    .ce-modal-backdrop {
        position: fixed; inset: 0; z-index: 9999;
        background: rgba(0,0,0,.85);
        display: flex; align-items: center; justify-content: center;
        padding: 1.5rem;
        opacity: 0; pointer-events: none;
        transition: opacity .25s;
    }
    .ce-modal-backdrop.open { opacity: 1; pointer-events: all; }

    .ce-modal {
        background: #141414;
        border: 1px solid #2a2a2a;
        border-radius: 16px;
        width: 100%;
        max-width: 520px;
        max-height: 90vh;
        overflow-y: auto;
        transform: translateY(24px) scale(.97);
        transition: transform .28s cubic-bezier(.22,.68,0,1.2);
        position: relative;
    }
    .ce-modal-backdrop.open .ce-modal { transform: translateY(0) scale(1); }

    .ce-modal-close {
        position: absolute; top: 1rem; right: 1rem;
        width: 32px; height: 32px;
        background: #222; border: none; border-radius: 50%;
        color: #fff; font-size: 1rem; cursor: pointer;
        display: flex; align-items: center; justify-content: center;
        transition: background .2s;
        z-index: 10;
    }
    .ce-modal-close:hover { background: var(--neon); color: #000; }

    .ce-modal-header {
        padding: 2rem 2rem 0;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .ce-modal-avatar-wrap {
        width: 100px; height: 100px;
        border-radius: 50%;
        border: 3px solid var(--neon);
        overflow: hidden;
        flex-shrink: 0;
        margin-bottom: 1rem;
    }
    .ce-modal-img {
        width: 100%; height: 100%;
        object-fit: cover;
        object-position: top;
        filter: grayscale(20%);
        display: block;
    }
    .ce-modal-avatar-initials {
        width: 100%; height: 100%;
        background: #1a1a2e;
        display: flex; align-items: center; justify-content: center;
        font-size: 2rem; font-weight: 900;
        color: var(--neon); text-transform: uppercase;
    }

    .ce-modal-name {
        font-size: 1.5rem; font-weight: 900;
        text-transform: uppercase; color: #fff;
        letter-spacing: -.01em; line-height: 1;
        margin-bottom: .3rem; text-align: center;
    }
    .ce-modal-carrera {
        font-size: .65rem; font-weight: 700;
        letter-spacing: .15em; text-transform: uppercase;
        color: var(--muted); text-align: center;
    }

    .ce-modal-body { padding: 1.5rem 2rem 2rem; }

    .ce-modal-section-title {
        font-size: .6rem; font-weight: 800;
        letter-spacing: .18em; text-transform: uppercase;
        color: var(--neon); margin-bottom: .6rem; margin-top: 1.25rem;
    }

    .ce-modal-skills {
        display: flex; flex-wrap: wrap; gap: .45rem;
    }
    .ce-modal-skill-tag {
        font-size: .62rem; font-weight: 800;
        letter-spacing: .1em; text-transform: uppercase;
        background: #1e1e1e; border: 1px solid #333;
        color: var(--neon); padding: .35rem .75rem;
        border-radius: 4px;
    }

    .ce-modal-info-grid {
        display: grid; grid-template-columns: 1fr 1fr;
        gap: .6rem 1.5rem;
    }
    .ce-modal-info-item { font-size: .8rem; color: #aaa; }
    .ce-modal-info-item strong {
        display: block; color: #fff;
        font-weight: 700; font-size: .82rem;
        word-break: break-all;
    }

    .ce-modal-divider {
        border: none; border-top: 1px solid #222;
        margin: 1.25rem 0;
    }

    /* EDITOR */
    .ce-editor {
        max-width: 1280px; margin: 0 auto; padding: 0 2rem 4rem;
    }
    .ce-editor-inner {
        background: var(--card); border: 1px solid var(--border);
        border-radius: 14px; overflow: hidden;
        display: grid; grid-template-columns: 1fr 1.4fr;
        min-height: 200px;
    }
    @media(max-width:640px){ .ce-editor-inner { grid-template-columns: 1fr; } }
    .ce-editor-text {
        padding: 2.5rem 2rem;
        display: flex; flex-direction: column; justify-content: center;
    }
    .ce-editor-title {
        font-size: 1.6rem; font-weight: 900;
        text-transform: uppercase; color: #fff;
        line-height: 1.1; margin-bottom: .75rem;
    }
    .ce-editor-desc { font-size: .88rem; color: var(--muted); line-height: 1.6; }
    .ce-editor-img {
        width: 100%; height: 100%; object-fit: cover;
        min-height: 200px; filter: grayscale(30%);
    }

    /* FOOTER */
    .ce-footer {
        background: var(--bg); border-top: 1px solid var(--border); padding: 2.5rem 2rem;
    }
    .ce-footer-inner {
        max-width: 1280px; margin: 0 auto;
        display: flex; flex-wrap: wrap; gap: 1.5rem;
        align-items: center; justify-content: space-between;
    }
    .ce-footer-logo { font-size: 1rem; font-weight: 900; text-transform: uppercase; color: #fff; }
    .ce-footer-logo span { color: var(--neon); }
    .ce-footer-nav { display: flex; gap: 1.5rem; flex-wrap: wrap; }
    .ce-footer-nav a {
        font-size: .72rem; font-weight: 700; letter-spacing: .1em;
        text-transform: uppercase; color: var(--muted);
        text-decoration: none; transition: color .2s;
    }
    .ce-footer-nav a:hover { color: var(--neon); }
    .ce-footer-social { display: flex; gap: .75rem; }
    .ce-footer-social a {
        width: 34px; height: 34px; border: 1px solid var(--border);
        border-radius: 50%; display: flex; align-items: center; justify-content: center;
        color: var(--muted); text-decoration: none; font-size: .8rem;
        transition: border-color .2s, color .2s;
    }
    .ce-footer-social a:hover { border-color: var(--neon); color: var(--neon); }
    .ce-footer-copy {
        width: 100%; font-size: .72rem; color: #444;
        border-top: 1px solid var(--border);
        padding-top: 1.25rem; margin-top: .25rem;
    }
</style>

<!-- HERO -->
<section class="ce-hero">
    <h1><span class="highlight">Conectar</span> con<br>Estudiantes</h1>
</section>

<!-- MAIN -->
<div class="ce-main">

    <!-- SIDEBAR -->
    <aside class="ce-sidebar">
        <div class="ce-filter-group">
            <div class="ce-filter-title">Carrera</div>
            @php
                $carreras = $estudiantes->pluck('carrera')->filter()->unique()->sort()->values();
            @endphp
            @foreach($carreras as $c)
                <div class="ce-filter-item">
                    <input type="checkbox" class="ce-checkbox filter-carrera"
                           id="c-{{ Str::slug($c) }}" value="{{ $c }}">
                    <label for="c-{{ Str::slug($c) }}">{{ $c }}</label>
                </div>
            @endforeach
            @if($carreras->isEmpty())
                <p style="font-size:.75rem;color:var(--muted);">Sin carreras registradas</p>
            @endif
        </div>

        <div class="ce-filter-group">
            <div class="ce-filter-title">Habilidades</div>
            @php
                $todasHabilidades = $estudiantes->flatMap(function($e) {
                    if (is_array($e->habilidades)) return $e->habilidades;
                    if (is_string($e->habilidades) && !empty($e->habilidades))
                        return array_map('trim', explode(',', $e->habilidades));
                    return [];
                })->filter()->unique()->sort()->values();
            @endphp
            @foreach($todasHabilidades as $h)
                <div class="ce-filter-item">
                    <input type="checkbox" class="ce-checkbox filter-skill"
                           id="s-{{ Str::slug($h) }}" value="{{ $h }}">
                    <label for="s-{{ Str::slug($h) }}">{{ $h }}</label>
                </div>
            @endforeach
            @if($todasHabilidades->isEmpty())
                <p style="font-size:.75rem;color:var(--muted);">Sin habilidades registradas</p>
            @endif
        </div>
    </aside>

    <!-- GRID -->
    <div>
        <div class="ce-count" id="ce-count">
            Mostrando <span id="visible-count">{{ $estudiantes->count() }}</span> estudiantes
        </div>
        <div class="ce-grid" id="ce-grid">

            @forelse($estudiantes as $est)
                @php
                    // Normalizar habilidades: puede ser array (JSON) o string CSV
                    if (is_array($est->habilidades)) {
                        $habs = $est->habilidades;
                    } elseif (is_string($est->habilidades) && !empty($est->habilidades)) {
                        $habs = array_map('trim', explode(',', $est->habilidades));
                    } else {
                        $habs = [];
                    }
                    $primeraHab   = $habs[0] ?? '';
                    $habsStr      = implode(', ', $habs);
                    $iniciales    = strtoupper(substr($est->name, 0, 2));
                    $fotoUrl      = $est->foto_perfil ? asset('storage/' . $est->foto_perfil) : null;
                @endphp

                <div class="ce-card-student"
                     data-carrera="{{ $est->carrera ?? '' }}"
                     data-skill="{{ $primeraHab }}"
                     data-habilidades-json="{{ json_encode($habs) }}"
                     data-nombre="{{ $est->name }}"
                     data-carrera-label="{{ $est->carrera ?? 'Sin carrera' }}"
                     data-email="{{ $est->email }}"
                     data-foto="{{ $fotoUrl ?? '' }}"
                     data-iniciales="{{ $iniciales }}">

                    {{-- Imagen de tarjeta --}}
                    @if($fotoUrl)
                        <img src="{{ $fotoUrl }}" alt="{{ $est->name }}" class="ce-card-img" loading="lazy">
                    @else
                        <div class="ce-card-avatar">{{ $iniciales }}</div>
                    @endif

                    <div class="ce-card-body">
                        <div class="ce-card-name">{{ $est->name }}</div>
                        <div class="ce-card-carrera">{{ $est->carrera ?? 'Sin carrera' }}</div>
                        <div class="ce-card-skill">{{ $primeraHab ?: '—' }}</div>
                        <button class="ce-btn-ver"
                                onclick="abrirModal(this.closest('.ce-card-student'))">
                            Ver Perfil
                        </button>
                    </div>
                </div>

            @empty
                <div class="ce-empty visible">
                    <div class="ce-empty-icon">👥</div>
                    No hay estudiantes registrados aún.
                </div>
            @endforelse

            <div class="ce-empty" id="ce-empty">
                <div class="ce-empty-icon">🔍</div>
                No se encontraron estudiantes con esos filtros.
            </div>

        </div>
    </div>
</div>

<!-- MODAL PERFIL -->
<div class="ce-modal-backdrop" id="ce-modal-backdrop" onclick="cerrarModalSiFondo(event)">
    <div class="ce-modal" id="ce-modal">
        <button class="ce-modal-close" onclick="cerrarModal()" aria-label="Cerrar">✕</button>

        <div class="ce-modal-header">
            <div class="ce-modal-avatar-wrap">
                <img src="" alt="" class="ce-modal-img" id="modal-img" style="display:none;">
                <div class="ce-modal-avatar-initials" id="modal-initials"></div>
            </div>
            <div class="ce-modal-name" id="modal-nombre"></div>
            <div class="ce-modal-carrera" id="modal-carrera"></div>
        </div>

        <div class="ce-modal-body">
            <hr class="ce-modal-divider">

            <div class="ce-modal-section-title">Habilidades</div>
            <div class="ce-modal-skills" id="modal-skills"></div>

            <div class="ce-modal-section-title">Información de contacto</div>
            <div class="ce-modal-info-grid">
                <div class="ce-modal-info-item">
                    <strong id="modal-email"></strong>
                    Correo institucional
                </div>
                <div class="ce-modal-info-item">
                    <strong id="modal-carrera-info"></strong>
                    Carrera
                </div>
            </div>
        </div>
    </div>
</div>

<!-- PROYECTO DESTACADO -->
<section class="ce-editor">
    <div class="ce-editor-inner">
        <div class="ce-editor-text">
            <div class="ce-editor-title">
                Jóvenes que Inspiran:<br>Liderazgo y Comunidad
            </div>
            <p class="ce-editor-desc">
                Estudiantes de diversas facultades colaboran en iniciativas que fortalecen el liderazgo,
                el trabajo en equipo y el compromiso social, generando un impacto positivo dentro y fuera
                de la comunidad universitaria.
            </p>
        </div>
        <img src="{{ asset('images/alumnos1.jpeg') }}" alt="Estudiantes en proyecto comunitario" class="ce-editor-img" loading="lazy">
    </div>
</section>

<!-- FOOTER -->
<footer class="ce-footer">
    <div class="ce-footer-inner">
        <div class="ce-footer-logo"><span>Comunidad</span> Estudiantil</div>
        <nav class="ce-footer-nav">
            <a href="#">Inicio</a>
            <a href="#">Proyectos</a>
            <a href="#">Conectar</a>
            <a href="#">Nosotros</a>
            <a href="#">Perfil</a>
            <a href="#">Contacto</a>
        </nav>
<div class="ce-footer-social">
    <a href="https://www.facebook.com/profile.php?id=61567607833578" target="_blank" rel="noopener noreferrer" aria-label="Facebook">f</a>
    <a href="https://www.instagram.com/ucadlink/" target="_blank" rel="noopener noreferrer" aria-label="Facebook">Ig</a>

</div>
        <div class="ce-footer-copy">
            Desarrollado por Spom | Comunidad Estudiantil &nbsp;·&nbsp; © {{ date('Y') }}
        </div>
    </div>
</footer>

<script>
(function () {
    /* ── FILTROS ── */
    const cards      = document.querySelectorAll('.ce-card-student');
    const chkCarrera = document.querySelectorAll('.filter-carrera');
    const chkSkill   = document.querySelectorAll('.filter-skill');
    const countEl    = document.getElementById('visible-count');
    const emptyEl    = document.getElementById('ce-empty');

    function getChecked(cbs) {
        return Array.from(cbs).filter(c => c.checked).map(c => c.value);
    }

    function applyFilters() {
        const carreras = getChecked(chkCarrera);
        const skills   = getChecked(chkSkill);
        let visible = 0;

        cards.forEach(card => {
            const cardCarrera = card.dataset.carrera || '';
            // Habilidades como array para comparar cualquiera
            let cardSkills = [];
            try { cardSkills = JSON.parse(card.dataset.habilidadesJson || '[]'); } catch(e){}

            const carreraOk = carreras.length === 0 || carreras.includes(cardCarrera);
            const skillOk   = skills.length === 0   || skills.some(s => cardSkills.includes(s));

            card.classList.toggle('hidden', !(carreraOk && skillOk));
            if (carreraOk && skillOk) visible++;
        });

        countEl.textContent = visible;
        emptyEl.classList.toggle('visible', visible === 0);
    }

    chkCarrera.forEach(c => c.addEventListener('change', applyFilters));
    chkSkill.forEach(c   => c.addEventListener('change', applyFilters));
})();

/* ── MODAL ── */
function abrirModal(card) {
    const d = card.dataset;

    // Foto o iniciales
    const imgEl      = document.getElementById('modal-img');
    const initialsEl = document.getElementById('modal-initials');

    if (d.foto) {
        imgEl.src = d.foto;
        imgEl.alt = d.nombre;
        imgEl.style.display = 'block';
        initialsEl.style.display = 'none';
    } else {
        imgEl.style.display = 'none';
        initialsEl.textContent  = d.iniciales;
        initialsEl.style.display = 'flex';
    }

    document.getElementById('modal-nombre').textContent      = d.nombre;
    document.getElementById('modal-carrera').textContent     = d.carreraLabel;
    document.getElementById('modal-email').textContent       = d.email;
    document.getElementById('modal-carrera-info').textContent = d.carreraLabel;

    // Tags de habilidades
    const skillsEl = document.getElementById('modal-skills');
    skillsEl.innerHTML = '';
    let habs = [];
    try { habs = JSON.parse(d.habilidadesJson || '[]'); } catch(e) {}

    if (habs.length === 0) {
        skillsEl.innerHTML = '<span style="color:var(--muted);font-size:.8rem;">Sin habilidades registradas</span>';
    } else {
        habs.forEach(s => {
            const tag = document.createElement('span');
            tag.className   = 'ce-modal-skill-tag';
            tag.textContent = s.trim();
            skillsEl.appendChild(tag);
        });
    }

    document.getElementById('ce-modal-backdrop').classList.add('open');
    document.body.style.overflow = 'hidden';
}

function cerrarModal() {
    document.getElementById('ce-modal-backdrop').classList.remove('open');
    document.body.style.overflow = '';
}

function cerrarModalSiFondo(e) {
    if (e.target === document.getElementById('ce-modal-backdrop')) cerrarModal();
}

document.addEventListener('keydown', e => { if (e.key === 'Escape') cerrarModal(); });
</script>

</div>
</x-app-layout>