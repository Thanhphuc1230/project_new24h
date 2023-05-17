<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class VerifyEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */

    public $user;
    public $newEmail;
    public function __construct($user, $newEmail)
    {
        $this->user = $user;
        $this->newEmail = $newEmail;//lay new email
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(subject: 'Verify Email');
    }

    /**
     * Get the message content definition.
     */
    public function build()
    {
        $token = $this->user->email_verification_token;
    
        return $this->subject('Verify Your Email')
                    ->view('emails.update-email')
                    ->with([
                        'newEmail' => $this->newEmail,
                        'token' => $token,
                    ]);
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
