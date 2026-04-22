<x-app-layout>
    <div class="min-h-screen bg-[#f5f5f0] py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- SECCIÓN 1: NUESTRA MISIÓN -->
            <section class="mb-20 text-center">
                <h2 class="font-['Anton'] italic text-5xl md:text-7xl tracking-widest text-gray-900 mb-8">
                    NUESTRA MISIÓN
                </h2>
                <div class="w-full overflow-hidden rounded-xl shadow-lg">
                    <img src="{{ asset('images/login-2.jpg') }}" alt="Misión" class="w-full h-auto object-cover max-h-[500px]">
                </div>
            </section>

            <!-- SECCIÓN 2: QUIÉNES SOMOS -->
            <section class="mb-20 max-w-4xl mx-auto text-center">
                <h3 class="font-['Anton'] italic text-4xl text-gray-900 uppercase mb-6">QUIÉNES SOMOS</h3>
                <p class="text-xl text-gray-700 leading-relaxed">
                    Conectando estudiantes para colaborar, innovar y desarrollar proyectos académicos conjuntos que cambian el mundo.
                </p>
            </section>

            <!-- SECCIÓN 3: IMPACTO (Imagen Izq - Texto Der) -->
            <section class="mb-20 bg-white p-8 rounded-2xl shadow-md border border-gray-100">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-stretch">
                    
                    <!-- Imagen -->
                    <div class="flex items-center justify-center">
                        <img src="{{ asset('images/logo.jpeg') }}" 
                             alt="Impacto" 
                             class="w-full h-80 object-cover rounded-lg shadow-sm">
                    </div>

                    <!-- Texto -->
                    <div class="flex flex-col justify-center items-start pl-0 md:pl-8">
                        <h3 class="font-['Anton'] italic text-4xl text-gray-900 uppercase mb-4">NUESTRO IMPACTO</h3>
                        <p class="text-gray-600 mb-6 text-lg">
                            Construyendo una comunidad donde los estudiantes colaboran en proyectos innovadores. Transformamos ideas en soluciones reales.
                        </p>
                        <a href="#" class="inline-block px-8 py-3 bg-[#b8f443] text-gray-900 font-bold uppercase tracking-wider shadow hover:bg-[#a3d63a] transition-colors">
                            Ver Impacto
                        </a>
                    </div>
                </div>
            </section>

            <!-- SECCIÓN 4: VALORES (Texto Izq - Imagen Der) -->
            <section class="mb-20 bg-white p-8 rounded-2xl shadow-md border border-gray-100">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-stretch">
                    
                    <!-- Texto -->
                    <div class="flex flex-col justify-center items-end pr-0 md:pr-8">
                        <h3 class="font-['Anton'] italic text-4xl text-gray-900 uppercase mb-4">VALORES</h3>
                        <p class="text-gray-600 mb-6 text-lg">
                            Fomentamos la colaboración genuina, la innovación constante y el compromiso con la excelencia. Cada estudiante aporta valor único.
                        </p>
                        <a href="#" class="inline-block px-8 py-3 bg-[#b8f443] text-gray-900 font-bold uppercase tracking-wider shadow hover:bg-[#a3d63a] transition-colors">
                            Conocer Valores
                        </a>
                    </div>

                    <!-- Imagen -->
                    <div class="flex items-center justify-center">
                        <img src="{{ asset('images/login-2.jpg') }}" 
                             alt="Valores" 
                             class="w-full h-80 object-cover rounded-lg shadow-sm">
                    </div>
                </div>
            </section>

        </div>
    </div>
</x-app-layout>