<?php

namespace App\Console\Commands\images;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class Defaults extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'image:default';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Makes a working copy of the default site images.';

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

        $files = Storage::files("private/images/group-defaults");
        foreach ($files as $file) {
            $filename = pathinfo($file, PATHINFO_FILENAME) . '.' . pathinfo($file, PATHINFO_EXTENSION);
            
            // Delete the public image if it exists
            if (Storage::exists("public/images/groups/" . $filename)) {
                Storage::delete("public/images/groups/" . $filename);
                $this->info('public/images/groups/'.$filename.' already exists, replacing.');
                
            }
            Storage::copy($file, "public/images/groups/" . $filename);
        }

        // copy contender default
        $files = Storage::files("private/images/contender-default");
        foreach ($files as $file) {
            $filename = pathinfo($file, PATHINFO_FILENAME) . '.' . pathinfo($file, PATHINFO_EXTENSION);
            
            // Delete the public image if it exists
            if (Storage::exists("public/images/contenders/" . $filename)) {
                Storage::delete("public/images/contenders/" . $filename);
                $this->info('public/images/contenders/'.$filename.' already exists, replacing.');
            }
            Storage::copy($file, "public/images/contenders/" . $filename);
        }

        // copy sponsor default
        $files = Storage::files("private/images/sponsor-defaults");
        foreach ($files as $file) {
            $filename = pathinfo($file, PATHINFO_FILENAME) . '.' . pathinfo($file, PATHINFO_EXTENSION);
            
            // Delete the public image if it exists
            if (Storage::exists("public/images/sponsors/" . $filename)) {
                Storage::delete("public/images/sponsors/" . $filename);
                $this->info('public/images/sponsors/'.$filename.' already exists, replacing.');
            }
            Storage::copy($file, "public/images/sponsors/" . $filename);
        }

        // ensure that a logo file exists in public dir
        if(Storage::exists("public/images/f4k_logo.png")){
            $this->warn('Logo file already in public folder.');
        } else{
            $this->info('Copying blank logo file to public folder. This will be updated when an events public visibility is toggled.');
            Storage::copy("private/images/f4k_logo_noyear.png", "public/images/f4k_logo.png");
        }

        // ensure that a noyear logo file exists in the public dir
        if(Storage::exists("public/images/f4k_logo_noyear.png")){
            $this->warn('No year logo file already in public folder.');
        } else{
            $this->info('Copying a no year logo file to public folder. This version will not be changed.');
            Storage::copy("private/images/f4k_logo_noyear.png", "public/images/f4k_logo_noyear.png");
        }

        // copy generic images
        if(Storage::exists("public/images/mainPagePhoto.jpg")){
            $this->warn('Main page photo file already in public folder.');
        } else{
            $this->info('Copying a generic main page photo to public folder.');
            Storage::copy("private/images/mainPagePhoto.jpg", "public/images/mainPagePhoto.jpg");
        }        
        
    }
}
