<?php

namespace App\Notifications;

use App\Mail\CustomVerifyEmailMailable; // Import the custom mailable
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class CustomVerifyEmail extends Notification implements ShouldQueue
{
    use Queueable;

    protected $token;

    public function __construct($token)
    {
        $this->token = $token;
    }

    public function via($notifiable)
    {
        return ['mail']; // Use mail channel
    }

    public function toMail($notifiable)
    {
        // Create the verification URL
        $url = config('app.url') . '/verify/' . $this->token . '/' . urlencode($notifiable->email);
        
        // Return the custom mailable with the URL
        return (new CustomVerifyEmail($url)); // Send URL to mailable
    }
}
