<?php

use Faker\Generator as Faker;

$factory->define(App\Sponsor::class, function (Faker $faker) {
    return [
        'company_name' => $faker->company(),
        'contact_name' => $faker->name(),
        'contact_phone' => $faker->phoneNumber(),
        'email' => $faker->companyEmail(),
        'logo' => '/storage/images/logos/default.png',
        'url' => 'www.'.$faker->domainName()
    ];
});
