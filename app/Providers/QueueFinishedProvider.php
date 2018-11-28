<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Queue;
use Illuminate\Queue\Events\JobProcessed;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class QueueFinishedProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

        // This will clear the temp directory when all queued jobs (emails)
        // have been sent. This prevents email attachments from building up
        // and using all of the disk space on the server.
        Queue::after(function(JobProcessed $event){

            if(DB::table('jobs')->count() == 0){
                Log::debug('Job queue finished. Clearing temp directory.');
                $files = Storage::files('private/temp');
                Log::debug($files);
                    foreach($files as $file){
                        Storage::delete($file);
                    }
                Log::debug('Temporary files deleted');
                }
        });
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
