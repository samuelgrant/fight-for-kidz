<?php

use Illuminate\Database\Seeder;

class AuctionItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\AuctionItem::class, 12)->create();
    }
}
