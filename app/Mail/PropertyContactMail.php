<?php

namespace App\Mail;

use App\Models\Property;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PropertyContactMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(public Property $property, public array $data)
    {
        //
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            to: 'agent@agence-immo.test',
            replyTo: $this->data['email'],
            subject: 'Property Contact Mail'
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return (new Content(
            markdown: 'emails.property.contact',
        ))->with(['url' => route('properties.show',['slug' => $this->property->getSlug(), 'property' => $this->property])]);
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
