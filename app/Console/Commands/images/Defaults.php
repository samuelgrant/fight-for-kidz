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
    protected $description = 'Makes a working copy of the default group images.';

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
                echo 'public/images/groups/'.$filename.' already exists, replacing.';
            }
            Storage::copy($file, "public/images/groups/" . $filename);
        }
    }
}
