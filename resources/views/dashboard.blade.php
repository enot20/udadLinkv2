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

        /* Corrección mágica para asegurar que el iframe ocupe todo el espacio real en pantallas táctiles */
        .visor-fijo {
            height: calc(100vh - 70px) !important;
            min-height: -webkit-fill-available;
        }
    </style>

    {{-- INICIALIZAMOS ALPINE: Controlamos el estado del visor --}}
    <div x-data="{ verDoc: false, docRuta: '', docId: '' }" class="min-h-screen flex flex-col" style="background-color: #0d0d0d !important; color: #ffffff !important;">
        
        {{-- CUERPO DE DOS COLUMNAS RESPONSIVAS --}}
        <div class="w-full flex flex-col lg:flex-row flex-1" style="display: flex !important;">
            
            {{-- BARRA LATERAL IZQUIERDA (Se oculta en móvil SOLO cuando el visor de PDF está activo para que no estorbe abajo) --}}
            <aside x-show="!verDoc" class="w-full lg:w-[340px] p-8 flex flex-col items-center lg:items-stretch space-y-8 shrink-0" style="background-color: #111111 !important; min-width: 340px !important;">

    </style>

        
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

                {{-- Nombre del Usuario --}}

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


                {{-- Botón Editar Perfil --}}
                <div class="w-full px-2 pt-4">
                    <a href="{{ route('profile.edit') }}" class="font-impacto block w-full text-black font-bold text-center py-3.5 uppercase tracking-widest text-xs transition-all bg-[#CDFC77] hover:bg-white" style="background-color: #CDFC77 !important; color: #000000 !important;">
                        Editar Perfil
                    </a>
                </div>
            </aside>

            {{-- PANEL DERECHO DINÁMICO --}}
            <div class="flex-1 flex flex-col relative min-h-screen lg:h-screen overflow-hidden">
                
                {{-- 1. VISTA GENERAL DEL DASHBOARD (Se muestra si verDoc es falso) --}}
                <main x-show="!verDoc" class="w-full h-full p-6 lg:p-14 space-y-14 overflow-y-auto" style="background-color: #fcfcfc !important; color: #111111 !important;">
                    
                    {{-- SECCIÓN: MIS DOCUMENTOS --}}
                    <section>
                        <h3 class="font-impacto text-3xl font-bold text-gray-900 uppercase tracking-tight mb-6 border-b border-gray-200 pb-2">
                            Mis Documentos
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            @forelse($documentos as $doc)
                                <div class="bg-white border border-gray-200 rounded-xl p-6 flex flex-col justify-between shadow-sm hover:shadow-md transition-shadow">
                                    <div>
                                        <div class="w-full h-36 bg-gray-100 rounded-lg mb-4 overflow-hidden border border-gray-200 flex items-center justify-center">
                                            @if($doc->imagen)
                                                <img src="{{ asset('storage/' . $doc->imagen) }}" class="object-cover w-full h-full">
                                            @else
                                                <span class="text-3xl text-gray-300">📄</span>
                                            @endif
                                        </div>
                                        <h4 class="font-impacto text-lg font-bold text-gray-900 uppercase tracking-tight">{{ $doc->titulo }}</h4>
                                        <p class="text-xs text-gray-600 mt-2 leading-relaxed font-sans">{{ Str::limit($doc->descripcion, 140) }}</p>
                                    </div>
                                    
                                    {{-- AL DAR CLIC: Activa el visor --}}
                                    <button type="button" 
                                            @click="docRuta = '{{ asset('storage/' . $doc->ruta) }}'; docId = '{{ $doc->id }}'; verDoc = true; window.scrollTo(0,0);"
                                            class="font-impacto text-left text-xs text-[#0014ff] hover:text-[#CDFC77] uppercase tracking-widest transition-colors font-bold mt-4 cursor-pointer">
                                        Ver Proyecto →
                                    </button>
                                </div>
                            @empty
                                <p class="text-gray-500 text-sm">No tienes documentos registrados.</p>
                            @endforelse
                        </div>
                    </section>

                    {{-- SECCIÓN: HABILIDADES --}}
                    <section>
                        <h3 class="font-impacto text-3xl font-bold text-gray-900 uppercase tracking-tight mb-6 border-b border-gray-200 pb-2">Habilidades</h3>
                        <div class="flex flex-wrap gap-2">
                            @php
                                $habilidadesUsuario = Auth::user()->habilidades ?? ['Diseño UI', 'React', 'Figma', 'Colaboración', 'Javascript'];
                            @endphp
                            @foreach($habilidadesUsuario as $habilidad)
                                <span class="font-impacto text-black text-xs font-bold px-4 py-2.5 uppercase tracking-widest shadow-sm" style="background-color: #CDFC77 !important; color: #000000 !important;">
                                    {{ $habilidad }}
                                </span>
                            @endforeach
                        </div>
                    </section>

                    {{-- SECCIÓN: MENSAJES RECIENTES --}}
                    <section>
                        <h3 class="font-impacto text-3xl font-bold text-gray-900 uppercase tracking-tight mb-6 border-b border-gray-200 pb-2">Mensajes Recientes</h3>
                        <div class="space-y-0 font-sans">
                            <div class="border-b border-gray-200 py-4 flex justify-between items-baseline">
                                <p class="text-xs m-0"><span class="font-bold text-gray-900">Carlos Ruiz:</span><span class="text-gray-700 ml-1">¿Te interesa colaborar en el hackathon?</span></p>
                                <span class="text-[10px] text-gray-400 font-bold">2:32 AM</span>
                            </div>
                        </div>
                    </section>
                </main>

                {{-- 2. VISOR COMPLETAMENTE INTEGRADO Y ULTRA-COMPATIBLE CON MÓVILES (Sin Google Docs) --}}
                <div x-show="verDoc" class="w-full flex-1 flex flex-col bg-[#111111]" style="display: none;">
                    
                    {{-- Encabezado --}}
                    <div class="px-4 lg:px-8 py-4 bg-[#0d0d0d] border-b border-white/10 flex items-center justify-between shrink-0">
                        <div class="flex items-center gap-2">
                            <div class="w-2.5 h-2.5 rounded-full bg-[#0014ff] animate-pulse"></div>
                            <span class="font-impacto text-white text-xs lg:text-lg uppercase tracking-wider">
                                Doc ID: <span x-text="docId" class="text-[#CDFC77]"></span>
                            </span>
                        </div>
                        
                        {{-- Botón para VOLVER --}}
                        <button type="button" 
                                @click="verDoc = false; docRuta = '';" 
                                class="font-impacto text-[11px] lg:text-xs bg-[#CDFC77] text-black font-bold px-3 py-2 uppercase tracking-widest hover:bg-white transition-all cursor-pointer">
                            ← Volver
                        </button>
                    </div>

                    {{-- Cuerpo del PDF: Usamos <object> con fallback de descarga si el móvil es muy viejo --}}
                    <div class="flex-1 bg-[#161616] relative w-full visor-fijo">
                        <template x-if="verDoc">
                            <object :data="docRuta" type="application/pdf" class="w-full h-full absolute inset-0 block" style="width: 100%; height: 100%;">
                                {{-- Si el navegador móvil es super estricto y no renderiza el objeto, le da un botón de emergencia limpio --}}
                                <div class="absolute inset-0 flex flex-col items-center justify-center p-6 text-center bg-[#161616]">
                                    <span class="text-4xl mb-4">📄</span>
                                    <p class="text-white text-sm font-sans mb-4">Tu dispositivo requiere abrir el PDF en una pestaña dedicada.</p>
                                    <a :href="docRuta" target="_blank" class="font-impacto bg-[#0014ff] text-white px-6 py-3 uppercase text-xs tracking-widest hover:bg-[#CDFC77] hover:text-black transition-colors">
                                        Abrir Documento Directo
                                    </a>
                                </div>
                            </object>
                        </template>


                    </div>
                </section>

            </div>

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

    {{-- Script de Alpine --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</x-app-layout>