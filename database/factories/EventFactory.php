<?php

use Faker\Generator as Faker;

$factory->define(App\Event::class, function (Faker $faker) {
    return [
        'datetime' => $faker->dateTimeBetween($startDate = 'now', $endDate = '+1 year'),
        'desc_1' => $faker->paragraph(2),
        'desc_2' => $faker->words(10, true)
    ];
});
