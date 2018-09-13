<?php

namespace App\Console\Commands\images;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;;

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
        echo "Do you want to delete:\n1. All group images\n2. Custom group images only.\n\n";
        $userRequest = substr(readline(), 0, 1);
        echo "\n\n";
        
        if($userRequest == 1){
            $this->deleteAllImages();
        } elseif($userRequest == 2){
            $this->deleteCustomImages();
        } else {
            echo "Invalid Request";
        }
    }

    /**
     * Deletes all images from
     * /storage/app/public/images/groups
     * 
     * @param null
     * @return null
     */
    protected function deleteAllImages(){
        $counter = 0;

        $files = Storage::files('public/images/groups');
        foreach($files as $file){
            Storage::delete($file);
            $counter++;
        }

        echo $counter." group images deleted.\nRun php artisan image:default to get standard group images back.";
    }

    /**
     * Deletes custom images from
     * /storage/app/public/images/groups
     * 
     * @param null
     * @return null
     */
    protected function deleteCustomImages(){
        $ignoreArray = [0, 1, 2];//Default, SystemAdmins & Subscribers
        $counter = 0;

        $files = Storage::files('public/images/groups');
        for($i = 0; $i < count($files); $i++){
            if(!in_array($i, $ignoreArray)){
                Storage::delete($file);
                $counter++;
            }
        }
    }    
}
