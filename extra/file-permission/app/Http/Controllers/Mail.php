<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\Mail;

class Mail extends Controller
{
    public function sendMail()
    {   
        // echo "Successfully sent the email";
        $data = [
            'name' => 'testing',
            'number' => '65656',
            'fsdf' => 'testindsadg',
            ]
        $recipientEmail = 'harjot@codenomad.net';
        $mailable = new Mail('test', 'sonali@codenomad.net', 'Setting krade plz');
        $send= 'harjot@codenomad.net';
        try {
            Mail::to($recipientEmail)->send($mailable);
            echo "Successfully sent the email";
        } catch (\Exception $e) {
            echo "Failed to send the email: " . $e->getMessage();
        }
    }
}
