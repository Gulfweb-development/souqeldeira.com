<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class VerifiedMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $user;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $message = __('Hello :USERNAME,',["USERNAME"=>$this->user->name]);
        $message .= "\n";
        $message .= __('You have been sent with a desire to activate your account, so we would like to show you the activation code to activate the account');
        return $this->subject('Verified your account')
                    ->markdown('emails.forget')
                    ->with([
                        'message'=>$message,
                        'promotion'=>$this->user->activated_code
                    ]);
    }
}
