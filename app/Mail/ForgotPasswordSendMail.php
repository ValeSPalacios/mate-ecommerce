<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ForgotPasswordSendMail extends Mailable
{
    use Queueable, SerializesModels;
    private $user,$token;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user,$token)
    {
        //
        $this->token=$token;
        $this->user=$user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
       // dd($this->user);
        return $this->from('noreply@test.com')
        ->subject('Password Reset')
        ->view('emails.customForgotPassword')
        ->with([
            'user'=>$this->user,
            'token'=>$this->token
        ]);
    }
}
