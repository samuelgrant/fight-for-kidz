<?php

namespace App\Console\Commands\images;

use Illuminate\Console\Command;

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
        //
    }
}
