<?php

use Faker\Generator as Faker;

$factory->define(App\AuctionItem::class, function (Faker $faker) {
    return [
        'event_id' => 1,
        'name' => $faker->words(3, true),
        'desc' => $faker->paragraph(1),
        'donor' => $faker->name(),
        'picture' => $faker->imageURL(),
        'bout' => $faker->numberBetween($min = 1, $max = 12),
        'approximate_time' => $faker->time($format = 'H:i')
    ];
});
