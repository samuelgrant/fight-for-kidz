<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use App\Mail\ExceptionOccured;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendExceptionEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $email, $content;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($email, $content)
    {
        $this->content = $content;
        $this->email = $email;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            $msg = Mail::to($this->email)->send(new ExceptionOccured($this->content));
            Log::debug('Sending exception email to ' . $this->email);
            if ($msg){
                Log::debug('Mail job message: ' . $msg);
            }
        }
        catch (Exception $ex){
            Log::error('Failed to send exception email:');
            Log::error($ex);
        }
    }
}
