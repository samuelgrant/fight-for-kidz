<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Mail\AccountDeactivated;
use Illuminate\Support\Facades\Mail;
use App\User;

class SendDeactivatedAccountEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $user;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $msg = Mail::to($this->user->email)->send(new AccountDeactivated($this->user));
        Log::debug('Sending account deactivated mail to ' . $this->user->email);
        if($msg){
            Log::debug('Mail job message: ' . $msg);
        }
    }
}
