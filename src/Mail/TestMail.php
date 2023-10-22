<?php

namespace Niclastimm\LaraTestMailer\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TestMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Test Email via LaraTestMailer',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        $template = config('laratestmailer.template') ?: 'vendor.laratestmailer.test-email';

        return new Content(
            markdown: $template,
        );
    }
}