<?php

namespace App\Modules\Feedback\Mail;

use App\Modules\Feedback\DTO\FeedbackDTO;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Attachment;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Storage;

class NewFeedback extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(
        public FeedbackDTO $feedbackData,
    ) {
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Форма обратной связи',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            text: 'mail.feedback-text',
            with: [
                'subject' => $this->feedbackData->subject,
                'messageText' => $this->feedbackData->message,
                'name' => $this->feedbackData->client->name,
                'email' => $this->feedbackData->client->email,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        if (isset ($this->feedbackData->attachment)) {
            return [
                Attachment::fromStorageDisk('attachments', $this->feedbackData->attachment),
            ];
        }

        return [];

    }
}
