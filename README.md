#dadLink

Sistema de gestión de usuarios con autenticación de dos factores (2FA).

## Requisitos

- PHP 8.2+
- Composer
- Node.js y npm
- Laravel 12

## Instalación

```bash
# Instalar dependencias PHP
composer install

# Copiar archivo de configuración
cp .env.example .env

# Generar clave de aplicación
php artisan key:generate

# Ejecutar migraciones
php artisan migrate

# Instalar dependencias npm
npm install

# Compilar recursos
npm run build
```

## Características

- Autenticación de usuarios (Laravel Breeze)
- Validación de 2FA con Google Authenticator
- Campo de carnet para identificación
- Verificación de email en tiempo real

## Uso

```bash
# Iniciar servidor de desarrollo
php artisan serve
```

## Licencia

MIT