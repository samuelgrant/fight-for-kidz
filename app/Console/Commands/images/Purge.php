<?php

namespace App\Console\Commands\images;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class Purge extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'image:purge';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Purges the group images from the working directory.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {       
        $this->deleteAll();
    }

    /**
     * Deletes all images from
     * /storage/app/public/images/groups
     * 
     * @param null
     * @return null
     */
    protected function deleteAll(){
        $counter = 0;

        $files = Storage::files('public/images/groups');
        foreach($files as $file){
            Storage::delete($file);
            $counter++;
        }

        $this->promptToCopyDefault();
    }
    
    protected function promptToCopyDefault(){
        echo "Do you want to copy the default images back to the public directory? (Y/N)\n\n";
        $userRequest = substr(readline(), 0, 1);

        if(strtolower($userRequest) == "y"){
            $this->call('image:default');  
        }
    }
}