<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VerificationEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $token;
    public $email;

    public function __construct($token, $email)
    {
        $this->token = $token;
        $this->email = $email;
    }

    public function build()
    {
        return $this->view('emails.verification') // The view you will create
                    ->with([
                        'url' => config('app.url') . '/verify/' . $this->token . '/' . urlencode($this->email),
                    ]);
    }
}
