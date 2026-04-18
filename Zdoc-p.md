# Documentación de Cambios - Login Dividido en Dos

## Objetivo
Dividir la pantalla del login en dos partes:
- **Lado izquierdo**: Formulario de login (sin cambios en el contenido)
- **Lado derecho**: Imagen institucional

## Archivos Modificados

### 1. `resources/views/layouts/guest.blade.php`

**Cambio realizado**: Se modificó la estructura del layout para mostrar dos columnas en pantallas medianas/grandes.

**Antes**:
```php
<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
    <div>
        <a href="/">
            <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
        </a>
    </div>

    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
        {{ $slot }}
    </div>
</div>
```

**Después**:
```php
<div class="min-h-screen flex flex-col sm:flex-row">
    <!-- Lado izquierdo: Formulario -->
    <div class="w-full sm:w-1/2 flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 px-4 sm:px-8">
        <div class="mb-6">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </div>

        <div class="w-full sm:max-w-md mt-2 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            {{ $slot }}
        </div>
    </div>

    <!-- Lado derecho: Imagen -->
    <div class="hidden sm:block w-1/2 h-screen">
        <img src="{{ asset('images/login-image.jpg') }}" alt="Imagen de login" class="w-full h-full object-cover">
    </div>
</div>
```

**Detalles del cambio**:
- Se cambió `flex-col` a `flex-col sm:flex-row` para permitir dos columnas en pantallas grandes
- El formulario ocupa el 50% del ancho (`sm:w-1/2`)
- La imagen ocupa el otro 50% (`w-1/2`) y ocupa toda la altura (`h-screen`)
- La clase `hidden sm:block` oculta la imagen en móviles y solo la muestra en pantallas sm (640px+)
- La imagen se carga desde `public/images/login-image.jpg`

## Imagen Utilizada

Se utiliza la imagen existente: `public/images/logo_ucad.png`

**Nota**: Si se desea usar una imagen diferente, reemplazar el valor del atributo `src` en la etiqueta `img`:
```php
<img src="{{ asset('images/logo_ucad.png') }}" alt="Imagen de login" class="w-full h-full object-cover">
```

## Notas Adicionales

- El formulario de login (`resources/views/auth/login.blade.php`) NO fue modificado
- El diseño es responsive: en móviles se muestra solo el formulario, en pantallas medianas/grandes se muestran ambas partes
- La clase `object-cover` asegura que la imagen cubra todo el espacio disponible sin deformarse