<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;
use App\Mail\SponsorEnquiry;

class SendSponsorEnquiry implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $name, $companyName, $email, $phone, $type, $message;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($name,$companyName, $email, $phone, $type, $message)
    {
        $this->name = $name;
        $this->email = $email;
        $this->phone = $phone;
        $this->type = $type;
        $this->message = $message;
        $this->companyName = $companyName;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to(env('ADMIN_EMAIL'))->send(new SponsorEnquiry($this->name, $this->companyName, $this->email, $this->phone, $this->type, $this->message));
    }
}