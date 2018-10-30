<?php

use Faker\Generator as Faker;

$factory->define(App\Event::class, function (Faker $faker) {
    return [
        'datetime' => $faker->dateTimeBetween($startDate = 'now', $endDate = '+1 year'),
        'desc_1' => 'Join us for the Fight for Kidz charity boxing event, and help support the kids of Southland!',
        'desc_2' => $faker->words(10, true),
        'charity'=> $faker->company()
    ];
});
