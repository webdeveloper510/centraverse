<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class Mail extends Mailable
{
    use Queueable, SerializesModels;

    public $quote;
    public $recipientEmail;
    public $recipientName;

    public function __construct(Quote $quote, $recipientEmail, $recipientName)
    {
        $this->quote = $quote;
        $this->recipientEmail = $recipientEmail;
        $this->recipientName = $recipientName;
    }

    public function build()
    {
        return $this->from('your-email@example.com', 'Your Name')
            ->subject('Subject of your email')
            ->view('mail.mail');
    }
}
