<?php

use Faker\Generator as Faker;

$factory->define(App\Sponsor::class, function (Faker $faker) {
    return [
        // 'company_name' => $faker->unique()->company(),
        // 'contact_name' => $faker->name(),
        // 'contact_phone' => $faker->phoneNumber(),
        // 'email' => $faker->unique()->safeEmail(),
        // 'url' => 'www.'.$faker->domainName()

        'contact_phone' => 'No phone on record',
        'email' => 'noemail@example.com'
    ];
});
