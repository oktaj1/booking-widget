<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VerificationMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $user;

    public $verificationUrl;

    public function __construct($user)
    {
        $this->user = $user;
        // $this->verificationUrl = config('app.url').'/verify/'.$user->verification_token.'/'.urlencode($user->email);

        $this->verificationUrl = url("/api/verify/{$user->verification_token}/{$user->email}");
    }

    public function build()
    {
        return $this->view('emails.verify')
            ->subject('Verify Your Email Address')
            ->with([
                'verificationUrl' => $this->verificationUrl,
            ]);
    }
}
