<?php

use App\Subscriber;
use Illuminate\Database\Seeder;

class SubscribersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Use the factory to add 500 subscribers
        factory(App\Subscriber::class, 50)->create();
    }
}
