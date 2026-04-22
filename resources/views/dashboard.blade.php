<x-app-layout>
    {{-- Eliminamos el x-slot header para evitar que quede atrapado dentro del contenedor blanco --}}

    <!-- BANNER AZUL PEGADO AL HEADER (Ancho Completo) -->
    <div style="background: linear-gradient(135deg, #2731F5 0%, #2731F5 100%); width: 100%; display: flex; align-items: center; justify-content: center; padding: 1rem 1rem; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);">
        <h2 style="color: white; font-family: 'Anton', sans-serif; font-style: italic; font-size: clamp(1.5rem, 5vw, 3.5rem); letter-spacing: 2px; text-shadow: 0 3px 6px rgba(0,0,0,0.3); margin: 0; text-align: center; line-height: 1.2; width: 100%;">
            {{ __('EXPLORADOR DE PROYECTOS COLABORATIVOS') }}
        </h2>
    </div>

    <!-- CONTENIDO PRINCIPAL (Con fondo blanco y espaciado normal) -->
    <div class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Tarjeta de Contenido -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
                <div class="p-6 text-gray-900">
                    {{ __("Estás conectado!") }}
                    
                    {{-- Aquí puedes agregar el resto de tu dashboard --}}
                </div>
            </div>

        </div>
    </div>
</x-app-layout>

