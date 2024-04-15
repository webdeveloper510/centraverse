<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendPdfEmail extends Mailable
{
    use Queueable, SerializesModels;
    public $lead;
    public $subject;
    public $content;
    public $tempFilePath; 
    /**
     * Create a new message instance.
     */
    public function __construct($lead,$subject,$content,$tempFilePath= NULL)
    {
        $this->lead = $lead;
        $this->subject = $subject;
        $this->content = $content;
        $this->tempFilePath = $tempFilePath; 
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->subject,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'lead.mail.view',
            with: ['content' => $this->content],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        $attachments = [];

        // Check if $tempFilePath is not null and it exists
        if ($this->tempFilePath && file_exists($this->tempFilePath)) {
            // Get the file name from the path
            $fileName = basename($this->tempFilePath);
            
            // Add the attachment
            $attachments[] = new \Illuminate\Mail\Mailables\Attachment(
                $this->tempFilePath,
                ['as' => $fileName]
            );
        }

        return $attachments;
    }
    public function build()
    {
        return $this->subject($this->subject)
                    ->view('lead.mail.view')->with('content',$this->content);// You can create a custom email template if needed
    }
}
