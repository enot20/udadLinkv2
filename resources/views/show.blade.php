@extends('layouts.app')

@section('content')
{{-- CONTENEDOR MAESTRO CON ESTADO INICIAL DE LA MODAL APAGADA --}}
<div x-data="{ openDocModal: false, docRuta: '', docId: '' }" class="flex min-h-screen bg-white">
    
    {{-- BARRA LATERAL IZQUIERDA FIJA (El perfil de Elias Enot en Negro) --}}
    <div class="w-1/3 bg-[#0d0d0d] text-white p-10 flex flex-col items-center shrink-0">
        <div class="w-48 h-48 rounded-full overflow-hidden border-4 border-[#0014ff] mb-6">
            <img src="{{ asset('storage/' . Auth::user()->foto_perfil) }}" class="w-full h-full object-cover">
        </div>
        <h1 class="font-impacto text-3xl text-[#CDFC77] uppercase tracking-wider text-center">
            {{ Auth::user()->name }}
        </h1>
        <p class="text-xs text-gray-400 mt-2 text-center">{{ Auth::user()->carrera }}</p>
        
        <button class="mt-6 bg-[#CDFC77] text-black font-bold text-xs px-6 py-3 uppercase tracking-widest hover:bg-white transition-all">
            EDITAR PERFIL
        </button>
    </div>

    {{-- CONTENIDO DERECHO (Tus Proyectos, Habilidades y Mensajes) --}}
    <div class="w-2/3 p-10 bg-[#f7f7f7] overflow-y-auto h-screen relative">
        
        <h2 class="font-impacto text-2xl text-gray-900 uppercase tracking-wider mb-6">Mis Proyectos</h2>

        <div class="space-y-6">
            {{-- LOOP DE PROYECTOS --}}
            @foreach($documentos as $doc)
                <div class="bg-white border border-gray-200 p-6 rounded-none shadow-sm flex justify-between items-center">
                    <div>
                        <h3 class="font-bold text-gray-900 uppercase text-sm">Documento #{{ $doc->id }}</h3>
                        <p class="text-xs text-gray-500 mt-1">{{ $doc->tipo ?? 'Proyecto de Investigación' }}</p>
                    </div>
                    
                    {{-- ⚠️ ESTE BOTÓN HACE LA MAGIA: Al darle clic activa la modal y le pasa la ruta del storage --}}
                    <button @click="openDocModal = true; docRuta = '{{ asset('storage/' . $doc->ruta) }}'; docId = '{{ $doc->id }}'; document.body.style.overflow = 'hidden'"
                            class="font-impacto text-xs text-[#0014ff] hover:text-[#CDFC77] uppercase tracking-widest transition-colors font-bold">
                        Ver Proyecto →
                    </button>
                </div>
            @endforeach
        </div>

        {{-- SECCIÓN HABILIDADES Y MENSAJES ABAJO DE FONDO --}}
        <div class="mt-10">
            <h2 class="font-impacto text-2xl text-gray-900 uppercase tracking-wider mb-4">Habilidades</h2>
            </div>


        {{-- ========================================================================= --}}
        {{-- LA VENTANA MODAL INTERACTIVA (Flota encima del contenido derecho sin salir) --}}
        {{-- ========================================================================= --}}
        <div x-show="openDocModal" 
             class="fixed inset-0 z-50 flex items-center justify-end" 
             style="display: none;">
            
            {{-- FONDO OSCURO COMPLETO DETRÁS DE LA MODAL (Difumina el Dashboard en el fondo) --}}
            <div class="fixed inset-0 bg-black/70 backdrop-blur-sm transition-opacity"
                 @click="openDocModal = false; document.body.style.overflow = 'auto'"></div>

            {{-- PANEL FLOTANTE DERECHO DONDE SE RENDERIZA EL DOCUMENTO --}}
            <div class="bg-[#111111] border-l border-white/10 w-full max-w-4xl h-screen flex flex-col relative z-10 shadow-[-10px_0_50px_rgba(0,0,0,0.5)] animate-in slide-in-from-right duration-200">
                
                {{-- ENCABEZADO DE LA PLATAFORMA PARA EL DOCUMENTO --}}
                <div class="px-6 py-4 bg-[#0d0d0d] border-b border-white/10 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-2.5 h-2.5 rounded-full bg-[#0014ff] animate-pulse"></div>
                        <span class="font-impacto text-white uppercase tracking-wider text-sm">
                            Visor UCADLink / Proyecto #<span x-text="docId"></span>
                        </span>
                    </div>
                    
                    {{-- BOTÓN INTERACTIVO PARA CERRAR Y VOLVER AL DASHBOARD INMEDIATAMENTE --}}
                    <button @click="openDocModal = false; document.body.style.overflow = 'auto'" 
                            class="text-gray-400 hover:text-[#CDFC77] font-mono text-xl transition-colors p-2">
                        ✕
                    </button>
                </div>

                {{-- CUERPO: EL IFRAME CON EL VISOR DEL NAVEGADOR INTEGRADO --}}
                <div class="flex-1 bg-[#161616] relative">
                    <iframe :src="docRuta" class="w-full h-full border-0 absolute inset-0 block"></iframe>
                </div>

                {{-- PIE DE LA MODAL CERRAR --}}
                <div class="px-6 py-3 bg-[#0d0d0d] border-t border-white/10 text-right">
                    <button @click="openDocModal = false; document.body.style.overflow = 'auto'" 
                            class="font-impacto bg-[#CDFC77] text-black text-xs font-bold px-6 py-2 uppercase tracking-widest hover:bg-white transition-all">
                        Cerrar e Ir al Perfil
                    </button>
                </div>
            </div>
        </div>
        {{-- ========================================================================= --}}

    </div>
</div>
@endsection