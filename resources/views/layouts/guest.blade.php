<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="{{ asset('fonts/figtree.css') }}">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-row">
            <!-- Lado izquierdo: Formulario -->
            <div class="w-1/2 flex flex-col justify-center items-center bg-gray-100 p-8">
                <div class="mb-6">
                    <a href="/">
                        <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                    </a>
                </div>

                <div class="w-full max-w-md px-6 py-4 bg-white shadow-md overflow-hidden rounded-lg">
                    {{ $slot }}
                </div>
            </div>

            <!-- Lado derecho: Imagen -->
            <div class="w-1/2 h-screen">
                <img src="{{ asset('images/logo.jpeg') }}" alt="Imagen de login" class="w-full h-full object-cover">
            </div>
        </div>
    </body>
</html>
