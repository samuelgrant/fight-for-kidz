<?php

use Illuminate\Database\Seeder;

class MerchandiseItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\MerchandiseItem::class, 6)->create();
    }
}
