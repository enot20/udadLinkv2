<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Mailer predeterminado
    |--------------------------------------------------------------------------
    | Define el mecanismo principal para el envío de correos electrónicos.
    | Este valor se utiliza de forma global en la aplicación, a menos que
    | se indique explícitamente otro mailer en una operación concreta.
    | La configuración centralizada garantiza consistencia y reduce errores
    | al manejar múltiples canales de comunicación.
    |--------------------------------------------------------------------------
    */
    'default' => env('MAIL_MAILER', 'sendmail'),

    /*
    |--------------------------------------------------------------------------
    | Configuración de Mailers
    |--------------------------------------------------------------------------
    | Sección que describe los distintos "transport drivers" disponibles para
    | el envío de correos. Cada mailer representa una estrategia de entrega
    | (SMTP, Sendmail, servicios externos como SES o Postmark).
    |
    | La arquitectura de Laravel permite definir múltiples mailers y elegir
    | dinámicamente cuál utilizar según el contexto. Esto aporta flexibilidad
    | y resiliencia, ya que se pueden configurar mecanismos de respaldo
    | (failover) o balanceo (roundrobin).
    |--------------------------------------------------------------------------
    */
    'mailers' => [
        // Ejemplo de configuración SMTP: estándar en la mayoría de servidores
        'smtp' => [
            'transport' => 'smtp',
            'scheme' => env('MAIL_SCHEME'),
            'url' => env('MAIL_URL'),
            'host' => env('MAIL_HOST', '127.0.0.1'),
            'port' => env('MAIL_PORT', 2525),
            'username' => env('MAIL_USERNAME'),
            'password' => env('MAIL_PASSWORD'),
            'timeout' => null,
            'local_domain' => env('MAIL_EHLO_DOMAIN', parse_url((string) env('APP_URL', 'http://localhost'), PHP_URL_HOST)),
        ],

        // Integración con Amazon SES
        'ses' => [
            'transport' => 'ses',
        ],

        // Integración con Postmark
        'postmark' => [
            'transport' => 'postmark',
        ],

        // Integración con Resend
        'resend' => [
            'transport' => 'resend',
        ],

        // Configuración clásica de Sendmail
        'sendmail' => [
            'transport' => 'sendmail',
            'path' => env('MAIL_SENDMAIL_PATH', '/usr/sbin/sendmail -bs -t'),
            'return_path' => env('MAIL_FROM_ADDRESS', 'no-reply@ucad.edu.sv'),
            'stream' => [
                'allow_self_signed' => true,
            ],
        ],

        // Mailer para logging: útil en entornos de prueba
        'log' => [
            'transport' => 'log',
            'channel' => env('MAIL_LOG_CHANNEL'),
        ],

        // Mailer en memoria: usado en pruebas unitarias
        'array' => [
            'transport' => 'array',
        ],

        // Estrategia de failover: garantiza continuidad si un mailer falla
        'failover' => [
            'transport' => 'failover',
            'mailers' => ['smtp', 'log'],
            'retry_after' => 60,
        ],

        // Estrategia roundrobin: distribuye carga entre múltiples proveedores
        'roundrobin' => [
            'transport' => 'roundrobin',
            'mailers' => ['ses', 'postmark'],
            'retry_after' => 60,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Dirección global de remitente
    |--------------------------------------------------------------------------
    | Define la identidad corporativa de los correos enviados por la aplicación.
    | Centralizar esta configuración asegura coherencia en la comunicación y
    | evita inconsistencias en el remitente. Se especifica tanto la dirección
    | como el nombre que aparecerán en todos los mensajes.
    |--------------------------------------------------------------------------
    */
    'from' => [
        'address' => env('MAIL_FROM_ADDRESS', 'no-reply@ucad.edu.sv'),
        'name' => env('MAIL_FROM_NAME', 'UCADLink'),
    ],

];
