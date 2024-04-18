<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class SendPdfEmail extends Mailable
{
    use Queueable, SerializesModels;
    public $lead;
    public $subject;
    public $content;
    public $proposalinfo; 
    /**
     * Create a new message instance.
     */
    public function __construct($lead,$subject,$content,$proposalinfo)
    {
        $this->lead = $lead;
        $this->subject = $subject;
        $this->content = $content;
        $this->proposalinfo = $proposalinfo; 
     
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
        return $attachments;
    }
    public function build()
    {
        $filePath = storage_path('app/public/Proposal_attachments/' .$this->proposalinfo->attachments);
        return $this->subject($this->subject)
                    ->view('lead.mail.view')
                    ->with('content',$this->content)
                    ->attach(
                        $filePath,
                        [
                            'as' =>  $this->proposalinfo->attachments
                        ]
                    );
    }
}
