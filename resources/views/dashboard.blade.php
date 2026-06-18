<x-app-layout>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        neon: '#CDFC77',
                        oscuroFondo: '#0d0d0d',
                        oscuroLateral: '#111111',
                        grisClaro: '#f3f3f3'
                    }
                }
            }
        }
    </script>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Oswald:wght@500;700&display=swap');
        .font-impacto {
            font-family: 'Oswald', 'Arial Black', sans-serif !important;
        }
    </style>

    {{-- CONTENEDOR MAESTRO --}}
    <div class="min-h-screen flex flex-col" style="background-color: #0d0d0d !important; color: #ffffff !important;">
        
        {{-- NAVBAR PRINCIPAL (Limpio y unificado) --}}
        

        {{-- CUERPO DE DOS COLUMNAS REALS --}}
        <div class="w-full flex flex-col lg:flex-row flex-1" style="display: flex !important;">
            
            {{-- BARRA LATERAL IZQUIERDA (Estilo Negro Puro e Impactante) --}}
            <aside class="w-full lg:w-[340px] p-8 flex flex-col items-center lg:items-stretch space-y-8 shrink-0" style="background-color: #111111 !important; min-width: 340px !important;">
                
                {{-- Foto de Perfil con el Aro Azul Eléctrico --}}
                <div class="flex justify-center w-full pt-4">
                    <div class="w-48 h-48 rounded-full overflow-hidden p-1.5 flex items-center justify-center shrink-0 shadow-2xl" style="background-color: #0014ff !important;">
                        @if(Auth::user()->foto_perfil)
                            <img src="{{ asset('storage/' . Auth::user()->foto_perfil) }}" class="object-cover w-full h-full rounded-full" alt="Perfil">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-white text-5xl font-bold uppercase rounded-full" style="background-color: #0014ff !important;">
                                {{ substr(Auth::user()->name, 0, 2) }}
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Nombre del Usuario en Bloque Gigante y Condensado --}}
                <div class="text-center lg:text-left space-y-2 w-full px-2">
                    <h2 class="font-impacto text-4xl font-bold text-[#CDFC77] uppercase tracking-tight leading-none break-words">
                        @php
                            $nombreCompleto = Auth::user()->name;
                            $palabras = explode(' ', $nombreCompleto);
                            $mitad = ceil(count($palabras) / 2);
                            $linea1 = implode(' ', array_slice($palabras, 0, $mitad));
                            $linea2 = implode(' ', array_slice($palabras, $mitad));
                        @endphp
                        {{ $linea1 }}<br><span class="text-white">{{ $linea2 }}</span>
                    </h2>
                    <p class="text-xs text-gray-400 font-sans tracking-wide uppercase font-semibold">
                        {{ Auth::user()->carrera ?? 'Ingeniería En Ciencias De La Computación' }}
                    </p>
                </div>

                {{-- Botón Editar Perfil Plano Verde Neón --}}
                <div class="w-full px-2 pt-4">
                    <a href="{{ route('profile.edit') }}" class="font-impacto block w-full text-black font-bold text-center py-3.5 uppercase tracking-widest text-xs transition-all bg-[#CDFC77] hover:bg-white" style="background-color: #CDFC77 !important; color: #000000 !important;">
                        Editar Perfil
                    </a>
                </div>
            </aside>

            {{-- PANEL DERECHO PRINCIPAL (Espaciado Premium y Fondo Gris/Blanco Crudo) --}}
            <main class="flex-1 p-8 lg:p-14 space-y-14" style="background-color: #fcfcfc !important; color: #111111 !important;">
                
                {{-- SECCIÓN: MIS PROYECTOS --}}
                <section>
                    <h3 class="font-impacto text-3xl font-bold text-gray-900 uppercase tracking-tight mb-6 border-b border-gray-200 pb-2">Mis Proyectos</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8" style="display: grid !important;">
                        @forelse(Auth::user()->proyectos ?? [] as $proyecto)
                            <div class="bg-white border border-gray-200 rounded-xl p-6 flex flex-col justify-between shadow-sm hover:shadow-md transition-shadow">
                                <div>
                                    <div class="w-full h-36 bg-gray-100 rounded-lg mb-4 overflow-hidden border border-gray-200 flex items-center justify-center">
                                        @if(isset($proyecto->imagen))
                                            <img src="{{ asset('storage/' . $proyecto->imagen) }}" class="object-cover w-full h-full">
                                        @else
                                            <span class="text-3xl text-gray-300">💻</span>
                                        @endif
                                    </div>
                                    <h4 class="font-impacto text-lg font-bold text-gray-900 uppercase tracking-tight">{{ $proyecto->titulo }}</h4>
                                    <p class="text-xs text-gray-600 mt-2 leading-relaxed font-sans">{{ Str::limit($proyecto->descripcion, 140) }}</p>
                                </div>
                                <a href="{{ route('proyectos.show', $proyecto->id) }}" class="font-impacto inline-flex items-center mt-5 text-xs font-bold text-gray-900 uppercase tracking-widest hover:text-gray-600">
                                    Ver Proyecto <span class="ml-1 text-[10px]">→</span>
                                </a>
                            </div>
                        @empty
                            {{-- Bloques idénticos al Mockup --}}
                            <div class="bg-white border border-gray-200 rounded-xl p-6 shadow-sm flex flex-col justify-between">
                                <div>
                                    <div class="w-full h-36 bg-gray-100 rounded-lg mb-4 flex items-center justify-center text-xs font-bold text-gray-400 uppercase tracking-wider">Mockup Imagen 1</div>
                                    <h4 class="font-impacto text-lg font-bold text-gray-900 uppercase tracking-tight">Plataforma de Voluntariado Estudiantil</h4>
                                    <p class="text-xs text-gray-600 mt-2 leading-relaxed font-sans">Conectando estudiantes para colaborar, innovar y realizar proyectos conjuntos que cambian el entorno.</p>
                                </div>
                                <a href="#" class="font-impacto inline-flex items-center mt-5 text-xs font-bold text-gray-900 uppercase tracking-widest">Ver Proyecto →</a>
                            </div>

                            <div class="bg-white border border-gray-200 rounded-xl p-6 shadow-sm flex flex-col justify-between">
                                <div>
                                    <div class="w-full h-36 bg-gray-100 rounded-lg mb-4 flex items-center justify-center text-xs font-bold text-gray-400 uppercase tracking-wider">Mockup Imagen 2</div>
                                    <h4 class="font-impacto text-lg font-bold text-gray-900 uppercase tracking-tight">Rediseño de App U</h4>
                                    <p class="text-xs text-gray-600 mt-2 leading-relaxed font-sans">Rediseño de App U en pro de conectar en áreas que conjuntos de personas asocian al mundo.</p>
                                </div>
                                <a href="#" class="font-impacto inline-flex items-center mt-5 text-xs font-bold text-gray-900 uppercase tracking-widest">Ver Proyecto →</a>
                            </div>
                        @endforelse
                    </div>
                </section>

                {{-- SECCIÓN: HABILIDADES (Planas, rectangulares y neón) --}}
                <section>
                    <h3 class="font-impacto text-3xl font-bold text-gray-900 uppercase tracking-tight mb-6 border-b border-gray-200 pb-2">Habilidades</h3>
                    <div class="flex flex-wrap gap-2" style="display: flex !important;">
                        @php
                            $habilidadesUsuario = Auth::user()->habilidades ?? ['Diseño UI', 'React', 'Figma', 'Colaboración', 'Javascript'];
                        @endphp
                        @foreach($habilidadesUsuario as $habilidad)
                            <span class="font-impacto text-black text-xs font-bold px-4 py-2.5 uppercase tracking-widest shadow-sm" style="background-color: #CDFC77 !important; color: #000000 !important; display: inline-block !important;">
                                {{ $habilidad }}
                            </span>
                        @endforeach
                    </div>
                </section>

                {{-- SECCIÓN: MENSAJES RECIENTES (Líneas limpias y marcas de tiempo perfectas) --}}
                <section>
                    <h3 class="font-impacto text-3xl font-bold text-gray-900 uppercase tracking-tight mb-6 border-b border-gray-200 pb-2">Mensajes Recientes</h3>
                    <div class="space-y-0 font-sans">
                        @forelse($mensajes ?? [] as $msg)
                            <div class="border-b border-gray-200 py-4 flex justify-between items-start gap-4">
                                <div class="text-xs">
                                    <p class="m-0"><span class="font-bold text-gray-900">{{ $msg->remitente }}:</span> <span class="text-gray-700 ml-1">{{ $msg->contenido }}</span></p>
                                </div>
                                <span class="text-[10px] text-gray-400 font-bold whitespace-nowrap">{{ $msg->created_at->format('g:i A') }}</span>
                            </div>
                        @empty
                            <div class="border-b border-gray-200 py-4 flex justify-between items-baseline">
                                <p class="text-xs m-0"><span class="font-bold text-gray-900">Carlos Ruiz:</span><span class="text-gray-700 ml-1">¿Te interesa colaborar en el hackathon?</span></p>
                                <span class="text-[10px] text-gray-400 font-bold">2:32 AM</span>
                            </div>
                            <div class="border-b border-gray-200 py-4 flex justify-between items-baseline">
                                <p class="text-xs m-0"><span class="font-bold text-gray-900">Equipo de Diseño:</span><span class="text-gray-700 ml-1">Actualización del proyecto 'Campus'</span></p>
                                <span class="text-[10px] text-gray-400 font-bold">2:33 AM</span>
                            </div>
                            <div class="border-b border-gray-200 py-4 flex justify-between items-baseline">
                                <p class="text-xs m-0"><span class="font-bold text-gray-900">Carlos Ruiz:</span><span class="text-gray-700 ml-1">Buenas comunidades y compartir el url</span></p>
                                <span class="text-[10px] text-gray-400 font-bold">3:36 PM</span>
                            </div>
                        @endforelse
                    </div>
                </section>
            </main>
        </div>
    </div>
</x-app-layout>