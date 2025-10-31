<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $email;
    protected $token;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email, $token)
    {
        $this->email = $email;
        $this->token = $token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $emailContent = "Hello,\n\n";
        $emailContent .= "Please reset your password using the following link:\n";
        $emailContent .= route('password.reset', ['token' => $this->token, 'email' => $this->email])."\n\n";
        $emailContent .= "Thank you,\nRabmot Licensing Agency";

        return $this->from('info@rabmotlicensing.com', 'Rabmot Licensing Agency')
            ->subject('Password Reset')
            ->withSwiftMessage(function ($message) use ($emailContent) {
                $message->setBody($emailContent, 'text/plain');
            });
    }
}
