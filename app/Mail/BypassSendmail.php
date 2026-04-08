<?php

namespace App\Mail; // Espacio de nombres: este servicio pertenece al módulo de envío de correos

use Illuminate\Support\Facades\Log; // Facade para registrar logs de eventos y errores

// ───────────────────────────────────────────────────────────────
// Clase BypassSendmail
// ---------------------------------------------------------------
// Implementa métodos estáticos para enviar correos electrónicos
// directamente usando comandos del sistema operativo (mail/sendmail).
// Se utiliza como alternativa a los mecanismos estándar de Laravel,
// proporcionando control bajo nivel y compatibilidad con entornos
// donde el pipeline de correo no está disponible.
// ───────────────────────────────────────────────────────────────
class BypassSendmail
{
    /**
     * Enviar correo usando el comando 'mail' de Linux.
     * -------------------------------------------------------------
     * Equivale a ejecutar en consola:
     * echo "mensaje" | mail -s "asunto" destino@email.com
     * 
     * Parámetros:
     * - $to: destinatario
     * - $subject: asunto del correo
     * - $body: cuerpo del mensaje (texto plano)
     * - $fromEmail / $fromName: remitente
     */
    public static function send(string $to, string $subject, string $body, string $fromEmail = 'no-reply@ucad.edu.sv', string $fromName = 'UCADLink'): bool
    {
        try {
            // Construcción del comando 'mail' con opciones:
            // -s: asunto
            // -r: remitente
            $command = sprintf(
                '/usr/bin/mail -s "%s" -r "%s <%s>" %s',
                escapeshellcmd($subject),   // Escapa caracteres peligrosos en asunto
                escapeshellcmd($fromName),  // Escapa nombre del remitente
                escapeshellcmd($fromEmail), // Escapa correo del remitente
                escapeshellcmd($to)         // Escapa destinatario
            );

            // Definición de pipes para entrada/salida del proceso
            $descriptorspec = [
                0 => ['pipe', 'r'], // Entrada estándar
                1 => ['pipe', 'w'], // Salida estándar
                2 => ['pipe', 'w'], // Error estándar
            ];

            // Apertura del proceso con proc_open
            $process = proc_open($command, $descriptorspec, $pipes);

            if (is_resource($process)) {
                // Escribir cuerpo del mensaje en la entrada del proceso
                fwrite($pipes[0], strip_tags($body)); // Se eliminan etiquetas HTML
                fclose($pipes[0]);

                // Capturar salida y errores
                $output = stream_get_contents($pipes[1]);
                $error = stream_get_contents($pipes[2]);

                // Cerrar pipes
                fclose($pipes[1]);
                fclose($pipes[2]);

                // Obtener código de retorno del proceso
                $returnCode = proc_close($process);

                // Registrar en logs el resultado
                Log::info('Mail enviado - Return code: '.$returnCode.' - Output: '.$output);

                // Retorna true si el proceso terminó correctamente
                return $returnCode === 0;
            }

            return false; // Si no se pudo abrir el proceso
        } catch (\Exception $e) {
            // Captura de excepciones y registro en logs
            Log::error('Error BypassSendmail (mail): '.$e->getMessage());

            return false;
        }
    }

    /**
     * Enviar correo HTML usando sendmail con formato completo.
     * -------------------------------------------------------------
     * Construye manualmente los encabezados MIME y envía el mensaje
     * con soporte para contenido HTML.
     */
    public static function sendHtml(string $to, string $subject, string $htmlBody, string $fromEmail = 'no-reply@ucad.edu.sv', string $fromName = 'UCADLink'): bool
    {
        try {
            // Generar boundary único para separar contenido MIME
            $boundary = md5(time());

            // Construcción del mensaje completo con encabezados
            $fullMessage = "To: $to".PHP_EOL;
            $fullMessage .= "Subject: $subject".PHP_EOL;
            $fullMessage .= "From: $fromName <$fromEmail>".PHP_EOL;
            $fullMessage .= "Reply-To: $fromEmail".PHP_EOL;
            $fullMessage .= 'MIME-Version: 1.0'.PHP_EOL;
            $fullMessage .= 'Content-Type: text/html; charset=UTF-8'.PHP_EOL.PHP_EOL;
            $fullMessage .= $htmlBody;

            // Definición de pipes para entrada/salida del proceso
            $descriptorspec = [
                0 => ['pipe', 'r'], // Entrada estándar
                1 => ['pipe', 'w'], // Salida estándar
                2 => ['pipe', 'w'], // Error estándar
            ];

            // Apertura del proceso con sendmail
            $process = proc_open("/usr/sbin/sendmail -t -f$fromEmail", $descriptorspec, $pipes);

            if (is_resource($process)) {
                // Escribir mensaje completo en la entrada del proceso
                fwrite($pipes[0], $fullMessage);
                fclose($pipes[0]);

                // Capturar salida y errores
                $output = stream_get_contents($pipes[1]);
                $error = stream_get_contents($pipes[2]);

                // Cerrar pipes
                fclose($pipes[1]);
                fclose($pipes[2]);

                // Obtener código de retorno del proceso
                $returnCode = proc_close($process);

                // Registrar en logs el resultado
                Log::info('Sendmail HTML enviado - Return code: '.$returnCode);

                // Retorna true si el proceso terminó correctamente
                return $returnCode === 0;
            }

            return false; // Si no se pudo abrir el proceso
        } catch (\Exception $e) {
            // Captura de excepciones y registro en logs
            Log::error('Error BypassSendmail (sendmail): '.$e->getMessage());

            return false;
        }
    }
}
