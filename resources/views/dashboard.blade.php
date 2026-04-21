<x-app-layout>
    <x-slot name="header">
        <div style="background: linear-gradient(135deg, #2731F5 0%, #2731F5 100%); height: 5rem; width: 100%; display: flex; align-items: center; justify-content: center; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
            <h2 style="color: white; font-family: 'Anton', sans-serif; font-style: italic; font-size: 55px; letter-spacing: 2px; text-shadow: 0 3px 6px rgba(0,0,0,0.3);">
                {{ __('EXPLORADOR DE PROYECTOS COLABORATIVOS') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("Estás conectado!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
