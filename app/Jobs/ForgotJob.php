<?php

namespace App\Jobs;

use App\Mail\ForgotMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class ForgotJob implements ShouldQueue {
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $email;
    protected $forgot_data;

    /**
     * Create a new job instance.
     *
     * @param $email
     * @param $forgot_data
     */
    public function __construct($email, $forgot_data) {
        $this->email = $email;
        $this->forgot_data = $forgot_data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle() {
        Mail::to($this->email)->send(new ForgotMail($this->forgot_data));
    }
}
