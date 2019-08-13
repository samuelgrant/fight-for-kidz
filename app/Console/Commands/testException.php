<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class testException extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:testexception';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Throws an exception to test the email developer\'s exception system. For more information visit the wiki: https://github.com/samuelgrant/fight-for-kidz/wiki/Exceptions,-Stack-Trace-Emails';

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
        abort(500);
    }
}
