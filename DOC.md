#dadLink - Documentación del Proyecto

## Información General
- **Framework**: Laravel 12
- **Autenticación**: Laravel Breeze
- **2FA**: Google2FA (pragmarx/google2fa-laravel)
- **PHP**: 8.2+

## Estructura de la Base de Datos

### Tabla: users
| Campo | Tipo | Descripción |
|-------|------|-------------|
| id | bigint | ID único |
| name | string | Nombre del usuario |
| carnet | string | Carnet universitario (único) |
| email | string | Email institucional (@ucad.edu.sv) |
| password | string | Contraseña encriptada |
| google2fa_secret | string | Clave secreta 2FA |
| google2fa_enabled | boolean | Estado 2FA |
| email_verified_at | timestamp | Verificación de email |
| remember_token | string | Token de sesión |
| created_at | timestamp | Fecha de creación |
| updated_at | timestamp | Fecha de actualización |

## Rutas del Sistema

### Rutas Públicas
| Ruta | Método | Middleware | Descripción |
|------|--------|------------|-------------|
| / | GET | none | Página de inicio |
| /check-email | POST | none | Verificar email en tiempo real |
| /register | GET/POST | guest | Registro de usuarios |
| /login | GET/POST | guest | Inicio de sesión |
| /forgot-password | GET/POST | guest | Recuperar contraseña |
| /reset-password/{token} | GET/POST | guest | Restablecer contraseña |

### Rutas Protegidas (auth)
| Ruta | Middleware | Descripción |
|------|------------|-------------|
| /2fa/validate | auth | Validación 2FA |
| /2fa/validate (POST) | auth | Verificar código 2FA |

### Rutas Protegidas (auth + 2fa + verified)
| Ruta | Descripción |
|------|-------------|
| /dashboard | Dashboard principal |
| /profile | Editar perfil |
| /profile (PATCH) | Actualizar perfil |
| /profile (DELETE) | Eliminar cuenta |
| /2fa/enable | Activar 2FA |
| /2fa/store | Guardar código 2FA |
| /2fa/disable | Desactivar 2FA |

## Middleware Personalizado

### Require2FA
Ubicación: `app/Http/Middleware/Require2FA.php`

Funcionalidad: Verifica que usuarios con 2FA habilitado hayan validado el código en la sesión actual. Si no han validado, los redirige a la página de validación 2FA.

## Controladores

### TwoFAController
Ubicación: `app/Http/Controllers/TwoFAController.php`

Métodos:
- `enable()` - Muestra formulario para activar 2FA
- `store()` - Guarda la configuración 2FA
- `disable()` - Desactiva 2FA
- `validateForm()` - Muestra formulario de validación
- `validateCode()` - Valida el código 2FA

### RegisteredUserController
Ubicación: `app/Http/Controllers/Auth/RegisteredUserController.php`

Valida que el email termine en `@ucad.edu.sv` y que el carnet sea único.

## Vistas

### Directorio: resources/views/
- `auth/` - Login, register, forgot-password, reset-password, verify-email, two-factor-challenge
- `profile/` - Edit, two-factor-enable, partials (update-password, update-profile, delete-user)
- `layouts/` - app.blade.php, guest.blade.php, navigation.blade.php
- `components/` - Componentes reutilizables (inputs, botones, etc.)
- `dashboard.blade.php` - Dashboard principal
- `welcome.blade.php` - Página de inicio

## Instalación

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
npm install
npm run build
```

## Uso

```bash
php artisan serve
```

Acceder a: http://localhost:8000

## Validaciones

- **Registro**: Name requerido, carnet único, email institucional (@ucad.edu.sv), password confirmada
- **2FA**: Código de 6 dígitos
- **Email**: Verificación en tiempo real (AJAX)

## Cambios Realizados

### 2026-04-01 - Corrección del Controller base

**Archivo**: `app/Http/Controllers/Controller.php`

**Problema**: El Controller base estaba vacío y no extendía `BaseController`, lo que causaba errores al usar `$this->middleware()` en los controladores hijos.

**Solución**: Se modificó para extender `BaseController` de Laravel e incluir los traits `AuthorizesRequests` y `ValidatesRequests`.

```php
// Antes (incorrecto)
abstract class Controller
{
    //
}

// Después (correcto)
abstract class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
}
```

### 2026-04-01 - Rediseño de la página de inicio (welcome)

**Archivo**: `resources/views/welcome.blade.php`

**Cambio**: La página de inicio ahora muestra directamente el formulario de login con un diseño 3D moderno para la Universidad Cristiana de las Asambleas de Dios (UCAD).

**Características implementadas**:
- Fondo con gradiente oscuro (azul/negro/púrpura)
- Efectos de orbes flotantes animados
- Tarjetas con efecto glassmorphism (vidrio translúcido)
- Animación de flotación (floating) en el logo
- Formulario de login integrado en la página principal
- Diseño responsivo
- Mensaje de bienvenida institucional
- Enlace a registro para nuevos usuarios

### 2026-04-01 - Rediseño del login conUI/UX profesional

**Archivo**: `resources/views/welcome.blade.php`

**Cambio**: Se rediseñó completamente la página de inicio con un diseño limpio y profesional usando mejores prácticas de UI/UX.

**Características implementadas**:
- Fondo claro con gradiente azul suave (blanco/celeste)
- Tarjeta de login con sombra suave y bordes redondeados
- Colores institucionales UCAD (azules claros)
- Iconos en los campos de entrada (email y contraseña)
- Campos con bordes sutiles que highlight en focus
- Botón con gradiente y efecto hover
- Diseño responsivo y limpio
- Tipografía Poppins
- Título correcto: UCADLink

### 2026-04-01 - Rediseño completo del login (Hero Section)

**Archivo**: `resources/views/welcome.blade.php`

**Cambio**: Se implementó un diseño de dos columnas con sección hero moderna.

**Características**:
- Fondo azul gradiente (azul UCAD)
- Layout de dos columnas: mensaje institucional + formulario
- Elementos flotantes decorativos animados
- Panel de login con efecto glassmorphism
- Títulos y mensajes吸引entes para el usuario
- Iconos de beneficios (Seguridad 2FA, Acceso Rápido, Datos Seguro)
- Animaciones de entrada (fade-in)
- Diseño completamente responsivo
- Colores institucionales: Azul (#0066CC), Cyan (#00A3E0), Amarillo (#FFD100)

### 2026-04-01 - Login minimalista profesional

**Archivo**: `resources/views/welcome.blade.php`

**Cambio**: Diseño limpio y minimalista centrado en el formulario de login.

**Características**:
- Tarjeta blanca cuadrada perfecta, centrada
- Fondo azul gradiente profesional
- Solo título UCADLink + nombre universidad
- Campos de entrada con diseño limpio
- Botón azul con gradiente y efectos hover
- Diseño responsive: móvil, tablet, desktop
- Sin elementos decorativos adicionales

### 2026-04-01 - Validación de email institucional

**Archivos**: 
- `app/Http/Requests/Auth/LoginRequest.php`
- `resources/views/welcome.blade.php`

**Cambio**: Validación del formato de correo institucional en tiempo real.

**Características**:
- Validación en backend: solo acepta correos terminados en `@ucad.edu.sv`
- Validación en frontend (JS): muestra error en tiempo real mientras el usuario escribe
- Mensaje de error claro: "El correo debe ser institucional (@ucad.edu.sv)"
- Cambio de color del borde cuando el formato es inválido

### 2026-04-01 - Sistema de Autenticación de Doble Factor (2FA)

**Archivos modificados/creados**:
- `app/Http/Controllers/Auth/AuthenticatedSessionController.php`
- `app/Http/Controllers/TwoFAController.php`
- `app/Http/Middleware/Require2FA.php`
- `app/Http/Requests/Auth/LoginRequest.php`

**Flujo de Autenticación 2FA**:

1. **Login del usuario**:
   - El usuario ingresa email y contraseña
   - Si las credenciales son válidas, se verifica si tiene 2FA habilitado
   - Si tiene 2FA habilitado → Se redirige a la página de validación 2FA
   - Si no tiene 2FA habilitado → Se redirige directamente al dashboard

2. **Validación 2FA**:
   - El usuario ingresa el código de 6 dígitos de su app (Google Authenticator/Authy)
   - Si el código es válido → Se marca la sesión como verificada (`2fa_passed`)
   - Si el código es inválido → Se muestra error y debe intentar de nuevo

3. **Activación de 2FA** (desde perfil):
   - El usuario solicita activar 2FA
   - Se genera un código QR para escanear con la app autenticadora
   - El usuario ingresa el código de verificación
   - Si es válido → Se guarda el secreto encriptado y se habilita 2FA

4. **Desactivación de 2FA** (desde perfil):
   - El usuario debe confirmar su contraseña
   - Se elimina el secreto y se deshabilita 2FA
   - Se limpia la sesión de verificación

**Variables de sesión**:
- `2fa_passed`: Indica que el usuario passou a validación 2FA en esta sesión
- `2fa_pending`: Indica que el usuario debe validar 2FA
- `google2fa_secret_temp`: Clave temporal mientras activa 2FA

**Rutas del sistema**:
- `GET /2fa/validate` - Formulario de validación 2FA
- `POST /2fa/validate` - Procesar código 2FA
- `GET /2fa/enable` - Generar QR para activar 2FA
- `POST /2fa/store` - Guardar activación 2FA
- `POST /2fa/disable` - Desactivar 2FA

**Middleware Require2FA**:
- Verifica si el usuario tiene 2FA habilitado
- Si no ha pasado la validación, redirige a `/2fa/validate`
- Excluye rutas necesarias para no crear bucles infinitos

### 2026-04-01 - Mejora de interfaz 2FA

**Archivo**: `resources/views/profile/two-factor-enable.blade.php`

**Mejoras implementadas**:
- Diseño responsive para móvil, tablet y desktop
- Código QR centrado y profesional
- Código manual con botón de copiar
- Pasos claramente numerados
- QR renderizado como SVG (no img)

### 2026-04-01 - Corrección QR Code

**Archivo**: `resources/views/profile/two-factor-enable.blade.php`

**Problema**: El código QR no se mostraba.

**Solución**: El QR se genera como SVG, se renderiza con `{!! $imageUrl !!}` en lugar de usar etiqueta `<img>`.

### 2026-04-01 - Seguridad de credenciales (Argon2ID)

**Archivo**: `config/hashing.php`

**Cambio**: Se configuró Argon2ID como algoritmo de hashing de contraseñas predeterminado.

**Configuración**:
```php
'driver' => 'argon2id',
'argon2id' => [
    'memory' => 65536,
    'threads' => 1,
    'time' => 4,
],
'rehash_on_login' => true,
```

### 2026-04-01 - Protección contra navegación del navegador

**Archivos creados**:
- `app/Http/Middleware/PreventBackNavigation.php`
- `app/Http/Middleware/CheckSessionTimeout.php`

**Características implementadas**:
- `PreventBackNavigation`: Headers de seguridad para evitar caché y button back
- `CheckSessionTimeout`: Verifica timeout de sesión (30 min por defecto)
- Middlewares agregados al grupo 'web' en `bootstrap/app.php`
- Logout ahora incluye headers de no caché

### 2026-04-01 - Sistema de recuperación de contraseña

**Archivos modificados/creados**:
- `app/Mail/PasswordResetMail.php` - Clase para enviar email de recuperación
- `resources/views/emails/password-reset.blade.php` - Template HTML del email
- `resources/views/auth/forgot-password.blade.php` - Vista "Olvidé mi contraseña"
- `resources/views/auth/reset-password.blade.php` - Vista "Nueva contraseña"
- `app/Http/Controllers/Auth/PasswordResetLinkController.php` - Validación de correo institucional
- `.env` - Configuración de correo
- `config/mail.php` - Configuración sendmail

**Configuración de correo** (sendmail/bypass):
```env
MAIL_MAILER=sendmail
MAIL_SENDMAIL_PATH="/usr/sbin/sendmail -t"
MAIL_FROM_ADDRESS=no-reply@ucad.edu.sv
MAIL_FROM_NAME=UCADLink
```

**Flujo de recuperación**:
1. Usuario ingresa correo institucional → Solicita enlace
2. Se envía email con enlace de recuperación (vence en 60 min)
3. Usuario hace clic → Formulario nueva contraseña
4. Contraseña actualizada → Redirige al login

**Validaciones**:
- Solo acepta correos @ucad.edu.sv
- Rate limiting: 3 intentos por minuto
- Contraseña con validación de seguridad