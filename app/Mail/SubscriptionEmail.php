<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Users;
use Illuminate\Support\Collection;

class SubscriptionEmail extends Mailable
{
    use Queueable, SerializesModels;

    private Users $user;
    private Collection $events;

    /**
     * Create a new message instance.
     */
    public function __construct(Users $user, Collection $events)
    {
        $this->user = $user;
        $this->events = $events;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Subscription Email',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.pending-subscriptions',
            with:
            [
                'user' => $this->user,
                'events' => $this->events
            ]

        );
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
