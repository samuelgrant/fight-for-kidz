<?php

use Illuminate\Database\Seeder;

class GroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Group::class)->create([
            'name' => 'Test Group 1',
            'type' => 'Test Group'
        ]);

        factory(App\Group::class)->create([
            'name' => 'Test Group 2',
            'type' => 'Test Group'
        ]);
    }
}
