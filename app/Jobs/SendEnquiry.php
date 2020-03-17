<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;
use App\Mail\Enquiry;
use Illuminate\Support\Facades\Log;

class SendEnquiry implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $name, $email, $phone, $message, $company, $sponsorshipTypes, $enquiryType; 

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($requestData)
    {
        $this->name = $requestData['name'];
        $this->email = $requestData['email'];
        $this->phone = $requestData['phone'];
        $this->message = $requestData['message'];
        $this->company = $requestData['company'];
        $this->sponsorshipTypes = implode(', ', $requestData['sponsorshipTypes']);
        $this->enquiryType = $requestData['type'];
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $msg = Mail::to(env('ADMIN_EMAIL'))->send(new Enquiry($this->name, $this->email,
         $this->phone, $this->message, $this->company, $this->sponsorshipTypes, $this->enquiryType));
        Log::debug('Sending new general received email to the admin email.');
        if($msg){
            Log::debug('Mail job message: ' . $msg);
        }
    }
}
