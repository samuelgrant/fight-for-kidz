<?php

use Illuminate\Database\Seeder;

class DefaultGroupsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Group::class)->create([
            'name' => 'Administrators',
            'type' => 'System Group'
        ]);

        factory(App\Group::class)->create([
            'name' => 'Subscribers',
            'type' => 'System Group'
        ]);
    }
}
