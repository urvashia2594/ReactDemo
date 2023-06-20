<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use  App\Mail\RegisterUser;
use Mail;

class RegisterUserJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public $user; 
    public function __construct($user_data)
    {
        $this->user = $user_data;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $userEmail = new RegisterUser();
        Mail::to($this->user->email)->send($userEmail);
    }
}
