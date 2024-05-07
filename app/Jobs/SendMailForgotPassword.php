<?php

namespace App\Jobs;

use App\Mail\ForgotPasswordSendMail;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Illuminate\Contracts\Mail\Mailable;

class SendMailForgotPassword implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $user,$token;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $user,$token)
    {
        $this->user=$user;
        $this->token=$token;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $email=new ForgotPasswordSendMail($this->user,$this->token);
       // dd($this->user->email);
        Mail::to($this->user->email)->send($email);
       

    }
}