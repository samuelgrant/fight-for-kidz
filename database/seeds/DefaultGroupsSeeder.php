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

        Log::debug('Administrators group created');

        factory(App\Group::class)->create([
            'name' => 'Subscribers',
            'type' => 'System Group'
        ]);

        factory(App\Group::class)->create([
            'name' => 'Test Group 1',
            'type' => 'Test Group'
        ]);

        factory(App\Group::class)->create([
            'name' => 'Test Group 2',
            'type' => 'Test Group'
        ]);

        Log::debug('Subscribers group created');
    }
}
