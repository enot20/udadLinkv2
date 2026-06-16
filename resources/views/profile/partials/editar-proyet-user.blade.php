<section>
    <header>
        <h2 class="text-xl font-semibold text-gray-900 flex items-center gap-2">
            <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
            {{ __('Expediente y Atestados Profesionales') }}
        </h2>
        <p class="mt-1 text-sm text-gray-500">
            {{ __('Sube tus documentos clave para respaldar tu perfil ante las empresas y reclutadores de la red UCAD.') }}
        </p>
    </header>

    <form method="post" action="{{ route('archivos.store') }}" enctype="multipart/form-data" class="mt-6 space-y-6">
        @csrf

        <div>
            <x-input-label for="nombre_archivo" :value="__('Título del Documento Profesional')" class="font-medium text-gray-700" />
            <x-text-input id="nombre_archivo" name="nombre_archivo" type="text" class="mt-1 block w-full bg-gray-50/50 focus:bg-white transition-colors duration-200" :value="old('nombre_archivo')" required autofocus placeholder="Ej: Currículum Vitae 2026, Certificación de Notas, Portafolio..." />
            <x-input-error class="mt-2" :messages="$errors->get('nombre_archivo')" />
        </div>

        <div>
            <x-input-label :value="__('Archivo digital (PDF, Imagen o TXT)')" class="font-medium text-gray-700 mb-1" />
            
            <div id="dropzone" class="relative group mt-1 flex flex-col items-center justify-center w-full h-48 border-2 border-dashed border-gray-300 rounded-xl bg-gray-50/50 hover:bg-indigo-50/30 hover:border-indigo-400 transition-all duration-300 cursor-pointer">
                
                <input id="archivo" name="archivo" type="file" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" accept=".pdf, .txt, image/*" required />

                <div class="text-center p-6 flex flex-col items-center justify-center pointer-events-none" id="dropzone-text">
                    <div class="p-3 bg-white rounded-full shadow-sm text-gray-400 group-hover:text-indigo-500 group-hover:scale-110 transition-all duration-300 mb-3">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                    </div>
                    <p class="text-sm text-gray-600 font-medium">
                        <span class="text-indigo-600 hover:underline">{{ __('Explorar archivos') }}</span> {{ __(' o arrastra tu documento aquí') }}
                    </p>
                    <p class="mt-1 text-xs text-gray-400">Formatos oficiales: PDF, TXT o Imágenes (Máx. 10MB)</p>
                </div>

                <div class="hidden text-center p-6 flex flex-col items-center justify-center pointer-events-none" id="dropzone-preview">
                    <div class="p-3 bg-green-50 rounded-full text-green-500 mb-2">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <p id="file-name" class="text-sm font-semibold text-gray-700 max-w-xs truncate">Nombre_del_archivo.pdf</p>
                    <p class="text-xs text-green-600 mt-1 font-medium">{{ __('¡Documento cargado correctamente!') }}</p>
                </div>
            </div>
            
            <x-input-error class="mt-2" :messages="$errors->get('archivo')" />
        </div>

        <div class="flex items-center justify-end pt-2">
            <button type="submit" class="inline-flex items-center px-5 py-2.5 bg-indigo-600 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-all duration-200 shadow-sm hover:shadow active:scale-95">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                {{ __('Adjuntar a mi Perfil') }}
            </button>
        </div>

        @if (session('status') === 'file-uploaded')
        <script>
            window.addEventListener('load', function() {
                Swal.fire({
                    icon: 'success',
                    title: '¡Atestado Agregado!',
                    text: 'Tu documento profesional ha sido incorporado a tu perfil de UCADLink con éxito.',
                    confirmButtonColor: '#4F46E5',
                    confirmButtonText: 'Entendido'
                });
            });
        </script>
        @endif
    </form>
</section>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const fileInput = document.getElementById('archivo');
        const dropzone = document.getElementById('dropzone');
        const textDefault = document.getElementById('dropzone-text');
        const textPreview = document.getElementById('dropzone-preview');
        const fileNameSpan = document.getElementById('file-name');

        if (fileInput) {
            fileInput.addEventListener('change', (e) => {
                if (e.target.files.length > 0) {
                    const name = e.target.files[0].name;
                    fileNameSpan.textContent = name;
                    
                    textDefault.classList.add('hidden');
                    textPreview.classList.remove('hidden');
                    
                    dropzone.classList.remove('border-gray-300', 'bg-gray-50/50');
                    dropzone.classList.add('border-green-400', 'bg-green-50/10');
                }
            });

            fileInput.addEventListener('dragenter', () => dropzone.classList.add('border-indigo-500', 'bg-indigo-50/50'));
            fileInput.addEventListener('dragleave', () => dropzone.classList.remove('border-indigo-500', 'bg-indigo-50/50'));
            fileInput.addEventListener('drop', () => dropzone.classList.remove('border-indigo-500', 'bg-indigo-50/50'));
        }
    });
</script>