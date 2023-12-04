<?php

namespace App\Jobs;

use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class WelcomeEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $email, $name;

    /**
     * Create a new job instance.
     */
    public function __construct($email, $name)
    {
        $this->email = $email;
        $this->name = $name;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Mail to
        Mail::to($this->email)->send(new WelcomeMail($this->name));
    }
}
