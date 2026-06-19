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

    /* HERO CONECTAR */
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

    /* LAYOUT PRINCIPAL */
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

    /* SIDEBAR FILTROS */
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
        width: 14px;
        height: 14px;
        border: 1.5px solid #444;
        border-radius: 3px;
        background: transparent;
        appearance: none;
        -webkit-appearance: none;
        cursor: pointer;
        flex-shrink: 0;
        transition: background .15s, border-color .15s;
        position: relative;
    }
    .ce-checkbox:checked {
        background: var(--neon);
        border-color: var(--neon);
    }
    .ce-checkbox:checked::after {
        content: '';
        position: absolute;
        left: 3px; top: 1px;
        width: 5px; height: 8px;
        border: 2px solid #000;
        border-top: none;
        border-left: none;
        transform: rotate(45deg);
    }

    /* CONTADOR */
    .ce-count {
        font-size: .72rem;
        color: var(--muted);
        margin-bottom: 1.25rem;
        font-weight: 500;
    }
    .ce-count span { color: var(--neon); font-weight: 700; }

    /* GRID TARJETAS */
    .ce-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(190px, 1fr));
        gap: 1.25rem;
    }

    /* TARJETA */
    .ce-card-student {
        background: var(--card);
        border: 1px solid var(--border);
        border-radius: 10px;
        overflow: hidden;
        transition: border-color .25s, transform .25s, opacity .3s;
    }
    .ce-card-student:hover {
        border-color: var(--neon);
        transform: translateY(-4px);
    }
    .ce-card-student.hidden {
        display: none;
    }
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
    .ce-card-body { padding: 1rem 1rem .9rem; }
    .ce-card-name {
        font-size: .95rem;
        font-weight: 800;
        color: #fff;
        margin-bottom: .2rem;
        text-transform: uppercase;
        letter-spacing: .01em;
    }
    .ce-card-carrera {
        font-size: .6rem;
        font-weight: 700;
        letter-spacing: .1em;
        text-transform: uppercase;
        color: var(--muted);
        margin-bottom: .2rem;
    }
    .ce-card-skill {
        font-size: .62rem;
        font-weight: 700;
        letter-spacing: .12em;
        text-transform: uppercase;
        color: var(--neon);
        margin-bottom: .85rem;
    }
    .ce-btn-mensaje {
        display: block;
        width: 100%;
        background: var(--neon);
        color: #000;
        font-size: .7rem;
        font-weight: 800;
        letter-spacing: .1em;
        text-transform: uppercase;
        text-align: center;
        padding: .55rem 1rem;
        border-radius: 5px;
        text-decoration: none;
        border: none;
        cursor: pointer;
        transition: opacity .2s, transform .15s;
        box-sizing: border-box;
    }
    .ce-btn-mensaje:hover { opacity: .85; transform: scale(1.02); }

    /* SIN RESULTADOS */
    .ce-empty {
        grid-column: 1/-1;
        text-align: center;
        padding: 4rem 2rem;
        color: var(--muted);
        font-size: .9rem;
        display: none;
    }
    .ce-empty.visible { display: block; }
    .ce-empty-icon { font-size: 2.5rem; margin-bottom: 1rem; }

    /* SECCIÓN EDITOR */
    .ce-editor {
        max-width: 1280px;
        margin: 0 auto;
        padding: 0 2rem 4rem;
    }
    .ce-editor-inner {
        background: var(--card);
        border: 1px solid var(--border);
        border-radius: 14px;
        overflow: hidden;
        display: grid;
        grid-template-columns: 1fr 1.4fr;
        min-height: 200px;
    }
    @media(max-width:640px){ .ce-editor-inner { grid-template-columns: 1fr; } }
    .ce-editor-text {
        padding: 2.5rem 2rem;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }
    .ce-editor-label {
        font-size: .62rem;
        font-weight: 800;
        letter-spacing: .15em;
        text-transform: uppercase;
        color: var(--neon);
        margin-bottom: .5rem;
    }
    .ce-editor-title {
        font-size: 1.6rem;
        font-weight: 900;
        text-transform: uppercase;
        color: #fff;
        line-height: 1.1;
        margin-bottom: .75rem;
    }
    .ce-editor-desc { font-size: .88rem; color: var(--muted); line-height: 1.6; }
    .ce-editor-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        min-height: 200px;
        filter: grayscale(30%);
    }

    /* FOOTER */
    .ce-footer {
        background: var(--bg);
        border-top: 1px solid var(--border);
        padding: 2.5rem 2rem;
    }
    .ce-footer-inner {
        max-width: 1280px;
        margin: 0 auto;
        display: flex;
        flex-wrap: wrap;
        gap: 1.5rem;
        align-items: center;
        justify-content: space-between;
    }
    .ce-footer-logo { font-size: 1rem; font-weight: 900; text-transform: uppercase; color: #fff; }
    .ce-footer-logo span { color: var(--neon); }
    .ce-footer-nav { display: flex; gap: 1.5rem; flex-wrap: wrap; }
    .ce-footer-nav a {
        font-size: .72rem; font-weight: 700; letter-spacing: .1em;
        text-transform: uppercase; color: var(--muted); text-decoration: none; transition: color .2s;
    }
    .ce-footer-nav a:hover { color: var(--neon); }
    .ce-footer-social { display: flex; gap: .75rem; }
    .ce-footer-social a {
        width: 34px; height: 34px; border: 1px solid var(--border); border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        color: var(--muted); text-decoration: none; font-size: .8rem;
        transition: border-color .2s, color .2s;
    }
    .ce-footer-social a:hover { border-color: var(--neon); color: var(--neon); }
    .ce-footer-copy {
        width: 100%; font-size: .72rem; color: #444;
        border-top: 1px solid var(--border); padding-top: 1.25rem; margin-top: .25rem;
    }
</style>

<!-- HERO -->
<section class="ce-hero">
    <h1>
        <span class="highlight">Conectar</span> con<br>Estudiantes
    </h1>
</section>

<!-- MAIN: SIDEBAR + GRID -->
<div class="ce-main">

    <!-- SIDEBAR FILTROS -->
    <aside class="ce-sidebar">

        <div class="ce-filter-group">
            <div class="ce-filter-title">Carrera</div>
            <div class="ce-filter-item">
                <input type="checkbox" class="ce-checkbox filter-carrera" id="c-sistemas" value="Sistemas">
                <label for="c-sistemas">Sistemas</label>
            </div>
            <div class="ce-filter-item">
                <input type="checkbox" class="ce-checkbox filter-carrera" id="c-comunicacion" value="Comunicación">
                <label for="c-comunicacion">Comunicación</label>
            </div>
            <div class="ce-filter-item">
                <input type="checkbox" class="ce-checkbox filter-carrera" id="c-juridicas" value="Ciencias Jurídicas">
                <label for="c-juridicas">Ciencias Jurídicas</label>
            </div>
            <div class="ce-filter-item">
                <input type="checkbox" class="ce-checkbox filter-carrera" id="c-ingenieria" value="Ingeniería">
                <label for="c-ingenieria">Ingeniería</label>
            </div>
            <div class="ce-filter-item">
                <input type="checkbox" class="ce-checkbox filter-carrera" id="c-diseno" value="Diseño">
                <label for="c-diseno">Diseño</label>
            </div>
        </div>

        <div class="ce-filter-group">
            <div class="ce-filter-title">Habilidades</div>
            <div class="ce-filter-item">
                <input type="checkbox" class="ce-checkbox filter-skill" id="s-python" value="Python">
                <label for="s-python">Python</label>
            </div>
            <div class="ce-filter-item">
                <input type="checkbox" class="ce-checkbox filter-skill" id="s-javascript" value="JavaScript">
                <label for="s-javascript">JavaScript</label>
            </div>
            <div class="ce-filter-item">
                <input type="checkbox" class="ce-checkbox filter-skill" id="s-uiux" value="UI/UX">
                <label for="s-uiux">UI/UX</label>
            </div>
            <div class="ce-filter-item">
                <input type="checkbox" class="ce-checkbox filter-skill" id="s-diseno" value="Diseño Gráfico">
                <label for="s-diseno">Diseño Gráfico</label>
            </div>
            <div class="ce-filter-item">
                <input type="checkbox" class="ce-checkbox filter-skill" id="s-marketing" value="Marketing Digital">
                <label for="s-marketing">Marketing Digital</label>
            </div>
            <div class="ce-filter-item">
                <input type="checkbox" class="ce-checkbox filter-skill" id="s-legal" value="Derecho">
                <label for="s-legal">Derecho</label>
            </div>
        </div>

    </aside>

    <!-- GRID TARJETAS -->
    <div>
        <div class="ce-count" id="ce-count">Mostrando <span id="visible-count">8</span> estudiantes</div>
        <div class="ce-grid" id="ce-grid">

            <!-- Las tarjetas llevan data-carrera y data-skill para el filtro JS -->
            <div class="ce-card-student" data-carrera="Sistemas" data-skill="Python">
                <img src="https://images.unsplash.com/photo-1531746020798-e6953c6e8e04?w=400&q=80" alt="Sofía López" class="ce-card-img" loading="lazy">
                <div class="ce-card-body">
                    <div class="ce-card-name">Sofía López</div>
                    <div class="ce-card-carrera">Sistemas</div>
                    <div class="ce-card-skill">Python</div>
                    <a href="#" class="ce-btn-mensaje">Enviar Mensaje</a>
                </div>
            </div>

            <div class="ce-card-student" data-carrera="Diseño" data-skill="UI/UX">
                <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=400&q=80" alt="Javier García" class="ce-card-img" loading="lazy">
                <div class="ce-card-body">
                    <div class="ce-card-name">Javier García</div>
                    <div class="ce-card-carrera">Diseño</div>
                    <div class="ce-card-skill">UI/UX</div>
                    <a href="#" class="ce-btn-mensaje">Enviar Mensaje</a>
                </div>
            </div>

            <div class="ce-card-student" data-carrera="Comunicación" data-skill="Marketing Digital">
                <img src="https://images.unsplash.com/photo-1531384441138-2736e62e0919?w=400&q=80" alt="Jona Grordez" class="ce-card-img" loading="lazy">
                <div class="ce-card-body">
                    <div class="ce-card-name">Jona Grordez</div>
                    <div class="ce-card-carrera">Comunicación</div>
                    <div class="ce-card-skill">Marketing Digital</div>
                    <a href="#" class="ce-btn-mensaje">Enviar Mensaje</a>
                </div>
            </div>

            <div class="ce-card-student" data-carrera="Diseño" data-skill="UI/UX">
                <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=400&q=80" alt="Nania García" class="ce-card-img" loading="lazy">
                <div class="ce-card-body">
                    <div class="ce-card-name">Nania García</div>
                    <div class="ce-card-carrera">Diseño</div>
                    <div class="ce-card-skill">UI/UX</div>
                    <a href="#" class="ce-btn-mensaje">Enviar Mensaje</a>
                </div>
            </div>

            <div class="ce-card-student" data-carrera="Comunicación" data-skill="Marketing Digital">
                <img src="https://images.unsplash.com/photo-1519085360753-af0119f7cbe7?w=400&q=80" alt="Ghany Clao" class="ce-card-img" loading="lazy">
                <div class="ce-card-body">
                    <div class="ce-card-name">Ghany Clao</div>
                    <div class="ce-card-carrera">Comunicación</div>
                    <div class="ce-card-skill">Marketing Digital</div>
                    <a href="#" class="ce-btn-mensaje">Enviar Mensaje</a>
                </div>
            </div>

            <div class="ce-card-student" data-carrera="Sistemas" data-skill="JavaScript">
                <img src="https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?w=400&q=80" alt="Javier López" class="ce-card-img" loading="lazy">
                <div class="ce-card-body">
                    <div class="ce-card-name">Javier López</div>
                    <div class="ce-card-carrera">Sistemas</div>
                    <div class="ce-card-skill">JavaScript</div>
                    <a href="#" class="ce-btn-mensaje">Enviar Mensaje</a>
                </div>
            </div>

            <div class="ce-card-student" data-carrera="Ciencias Jurídicas" data-skill="Derecho">
                <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=400&q=80" alt="Luis Morales" class="ce-card-img" loading="lazy">
                <div class="ce-card-body">
                    <div class="ce-card-name">Luis Morales</div>
                    <div class="ce-card-carrera">Ciencias Jurídicas</div>
                    <div class="ce-card-skill">Derecho</div>
                    <a href="#" class="ce-btn-mensaje">Enviar Mensaje</a>
                </div>
            </div>

            <div class="ce-card-student" data-carrera="Ingeniería" data-skill="Python">
                <img src="https://images.unsplash.com/photo-1573497019940-1c28c88b4f3e?w=400&q=80" alt="Andrea Pérez" class="ce-card-img" loading="lazy">
                <div class="ce-card-body">
                    <div class="ce-card-name">Andrea Pérez</div>
                    <div class="ce-card-carrera">Ingeniería</div>
                    <div class="ce-card-skill">Python</div>
                    <a href="#" class="ce-btn-mensaje">Enviar Mensaje</a>
                </div>
            </div>

            <!-- Mensaje sin resultados -->
            <div class="ce-empty" id="ce-empty">
                <div class="ce-empty-icon">🔍</div>
                No se encontraron estudiantes con esos filtros.
            </div>

        </div>
    </div>
</div>

<!-- PROYECTO DESTACADO -->
<section class="ce-editor">
    <div class="ce-editor-inner">
        <div class="ce-editor-text">
            <div class="ce-editor-title">
                Jóvenes que Inspiran:<br>
                Liderazgo y Comunidad
            </div>
            <p class="ce-editor-desc">
                Estudiantes de diversas facultades colaboran en iniciativas que fortalecen el liderazgo,
                el trabajo en equipo y el compromiso social, generando un impacto positivo dentro y fuera
                de la comunidad universitaria.
            </p>
        </div>

        <img
            src="images/alumnos1.jpeg"
            alt="Estudiantes participando en proyecto comunitario"
            class="ce-editor-img"
            loading="lazy">
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
            <a href="#" aria-label="Facebook">f</a>
            <a href="#" aria-label="X">𝕏</a>
            <a href="#" aria-label="LinkedIn">in</a>
            <a href="#" aria-label="YouTube">▶</a>
        </div>
        <div class="ce-footer-copy">
            Desarrollado por Spom | Comunidad Estudiantil &nbsp;·&nbsp; © {{ date('Y') }}
        </div>
    </div>
</footer>

<!-- FILTRO INTERACTIVO JS -->
<script>
(function () {
    const cards    = document.querySelectorAll('.ce-card-student');
    const chkCarrera = document.querySelectorAll('.filter-carrera');
    const chkSkill   = document.querySelectorAll('.filter-skill');
    const countEl    = document.getElementById('visible-count');
    const emptyEl    = document.getElementById('ce-empty');

    function getChecked(checkboxes) {
        return Array.from(checkboxes)
            .filter(c => c.checked)
            .map(c => c.value);
    }

    function applyFilters() {
        const carreras = getChecked(chkCarrera);
        const skills   = getChecked(chkSkill);
        let visible = 0;

        cards.forEach(card => {
            const cardCarrera = card.dataset.carrera || '';
            const cardSkill   = card.dataset.skill   || '';

            const carreraOk = carreras.length === 0 || carreras.includes(cardCarrera);
            const skillOk   = skills.length   === 0 || skills.includes(cardSkill);

            if (carreraOk && skillOk) {
                card.classList.remove('hidden');
                visible++;
            } else {
                card.classList.add('hidden');
            }
        });

        countEl.textContent = visible;
        emptyEl.classList.toggle('visible', visible === 0);
    }

    chkCarrera.forEach(c => c.addEventListener('change', applyFilters));
    chkSkill.forEach(c   => c.addEventListener('change', applyFilters));
})();
</script>

</div>
</x-app-layout>