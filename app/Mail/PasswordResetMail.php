<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PasswordResetMail extends Mailable
{
    use Queueable, SerializesModels;

    public $notifiable;

    public $url;

    public $expires;

    /**
     * Create a new message instance.
     */
    public function __construct($notifiable, string $url, int $expires = 60)
    {
        $this->notifiable = $notifiable;
        $this->url = $url;
        $this->expires = $expires;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Recuperar tu contraseña - UCADLink',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        $name = method_exists($this->notifiable, 'getAuthPassword')
            ? ($this->notifiable->name ?? 'Usuario')
            : 'Usuario';

        return new Content(
            view: 'emails.password-reset',
            with: [
                'name' => $name,
                'url' => $this->url,
                'expires' => $this->expires,
            ],
        );
    }
}
