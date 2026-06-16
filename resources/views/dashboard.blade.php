<x-app-layout>
    <div class="w-full flex items-center justify-center p-4 shadow-md" 
         style="background: linear-gradient(135deg, #2731F5 0%, #2731F5 100%);">
        <h2 class="text-white text-center w-full"
            style="font-family:'Anton',sans-serif;font-style:italic;font-size:clamp(1.5rem,5vw,3.5rem);letter-spacing:2px;text-shadow:0 3px 6px rgba(0,0,0,0.3);line-height:1.2;">
            {{ __('EXPLORADOR DE PROYECTOS COLABORATIVOS') }}
        </h2>
    </div>

    <div class="py-8 bg-gray-100 min-h-screen font-sans antialiased">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-6 items-start">
                
                <div class="lg:col-span-1 bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden sticky top-6">
                    <div class="h-16 bg-gradient-to-r from-blue-600 to-indigo-700"></div>
                        <div class="p-4 text-center -mt-8">
                        
                        @if(Auth::user()->foto_perfil)
                            <img class="inline-block h-16 w-16 rounded-full object-cover border-4 border-white shadow-md" 
                                src="{{ asset('storage/' . Auth::user()->foto_perfil) }}" 
                                alt="Foto de {{ Auth::user()->name }}">
                        @else
                            <div class="inline-flex items-center justify-center h-16 w-16 rounded-full bg-indigo-600 text-white text-xl font-bold border-4 border-white shadow-md uppercase">
                                {{ substr(Auth::user()->name, 0, 2) }}
                            </div>
                        @endif

                        <h2 class="mt-3 font-bold text-gray-800 text-lg leading-tight">{{ Auth::user()->name }}</h2>
                        <p class="text-xs font-semibold text-indigo-600 tracking-wider uppercase mt-1">
                            {{ Auth::user()->carrera ?? 'Estudiante' }}
                        </p>
                        <div class="mt-3 pt-3 border-t border-gray-100 text-left text-xs text-gray-500 space-y-1">
                            <p><span class="font-medium text-gray-700">Carnet:</span> {{ Auth::user()->carnet ?? 'N/A' }}</p>
                            <p><span class="font-medium text-gray-700">Correo:</span> {{ Auth::user()->email }}</p>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-2 space-y-6">
                    
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4">
                        <div class="flex items-center space-x-3">
                            <div class="h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center font-bold text-gray-600 uppercase">
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </div>
                            <button onclick="window.location.href='{{ route('profile.edit') }}'" class="flex-1 text-left bg-gray-100 hover:bg-gray-200 text-gray-500 rounded-full py-2.5 px-5 text-sm transition-colors duration-200 border border-gray-200">
                                ¿Qué proyecto o iniciativa estás desarrollando hoy, {{ explode(' ', Auth::user()->name)[0] }}?
                            </button>
                        </div>
                    </div>

                    @forelse($usuarios as $user)
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden transition-all duration-200 hover:shadow-md">
                            
                            <div class="p-4 flex items-center justify-between border-b border-gray-50">
                                <div class="flex items-center space-x-3">
                                    <div class="h-11 w-11 rounded-full bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center font-bold text-white shadow-sm uppercase">
                                        {{ substr($user->name, 0, 2) }}
                                    </div>
                                    <div>
                                        <h3 class="font-bold text-gray-900 text-sm hover:text-indigo-600 hover:underline cursor-pointer">
                                            {{ $user->name }}
                                        </h3>
                                        <p class="text-xs text-gray-500 flex items-center mt-0.5">
                                            <span class="font-medium text-gray-700">{{ $user->carrera ?? 'Carrera no especificada' }}</span>
                                            <span class="mx-1.5 text-gray-300">•</span>
                                            <span>Carnet: {{ $user->carnet ?? 'N/A' }}</span>
                                        </p>
                                    </div>
                                </div>
                                <span class="bg-indigo-50 text-indigo-700 text-xs px-2.5 py-1 rounded-full font-semibold tracking-wide">
                                    Comunidad
                                </span>
                            </div>

                            <div class="p-5 bg-gray-50/50">
                                @if($user->proyectos && $user->proyectos->count() > 0)
                                    <div class="space-y-4">
                                        @foreach($user->proyectos as $proyecto)
                                            <div class="bg-white p-4 rounded-lg border border-gray-150 shadow-xs">
                                                <div class="flex items-center justify-between">
                                                    <h4 class="font-semibold text-gray-800 text-base">{{ $proyecto->titulo }}</h4>
                                                    @if($proyecto->categoria)
                                                        <span class="text-[10px] bg-green-50 text-green-700 px-2 py-0.5 rounded font-bold uppercase">{{ $proyecto->categoria }}</span>
                                                    @endif
                                                </div>
                                                <p class="text-sm text-gray-600 mt-2 leading-relaxed">{{ $proyecto->descripcion }}</p>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="text-center py-6 px-4">
                                        <svg class="mx-auto h-10 w-10 text-gray-400 stroke-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 14.15v4.25c0 .414-.336.75-.75.75H4.5a.75.75 0 0 1-.75-.75V14.15M20.25 14.15a2.25 2.25 0 0 0-2.25-2.25H6a2.25 2.25 0 0 0-2.25 2.25M20.25 14.15M4.5 14.15" />
                                        </svg>
                                        <h4 class="mt-2 text-sm font-semibold text-gray-700">Sin proyectos publicados</h4>
                                        <p class="text-xs text-gray-400 mt-1 max-w-xs mx-auto">Este estudiante aún no ha registrado iniciativas o proyectos colaborativos en su portafolio.</p>
                                    </div>
                                @endif
                            </div>

                            <div class="px-4 py-2 bg-white border-t border-gray-100 flex items-center justify-between text-xs text-gray-500 font-medium">
                                <button class="flex items-center space-x-1.5 py-1.5 px-3 rounded-lg hover:bg-gray-100 hover:text-indigo-600 transition-colors duration-150">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M14 10h4.757a1 1 0 00.707-1.707l-5.414-5.414a1 1 0 00-1.414 0L7.222 8.293a1 1 0 00.707 1.707H13v6a3 3 0 01-3 3H7M14 10v6a3 3 0 003 3h3" /></svg>
                                    <span>Me interesa</span>
                                </button>
                                <a href="mailto:{{ $user->email }}" class="flex items-center space-x-1.5 py-1.5 px-3 rounded-lg hover:bg-indigo-50 hover:text-indigo-600 text-indigo-500 transition-colors duration-150">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                                    <span>Contactar</span>
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-8 text-center text-gray-500">
                            No hay compañeros registrados en este momento.
                        </div>
                    @endforelse
                </div>

                <div class="lg:col-span-1 bg-white rounded-xl shadow-sm border border-gray-200 p-4 sticky top-6 space-y-4">
                    <h3 class="font-bold text-gray-800 text-sm tracking-wide uppercase">Iniciativas UCAD</h3>
                    <div class="text-xs space-y-3">
                        <div class="p-2.5 bg-indigo-50/50 rounded-lg border border-indigo-100">
                            <p class="font-bold text-indigo-900">Conexión Multidisciplinaria</p>
                            <p class="text-gray-600 mt-0.5">Explorá los perfiles para armar equipos de proyectos científicos o de graduación.</p>
                        </div>
                        <div class="p-2.5 bg-emerald-50/50 rounded-lg border border-emerald-100">
                            <p class="font-bold text-emerald-900">Tip de Visibilidad</p>
                            <p class="text-gray-600 mt-0.5">Ve a tu sección de Perfil para actualizar tus datos y subir tus archivos de validación.</p>
                        </div>
                    </div>
                </div>

            </div>
            
        </div>
    </div>
</x-app-layout>