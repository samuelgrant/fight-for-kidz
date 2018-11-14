<?php

use Faker\Generator as Faker;

$factory->define(App\AuctionItem::class, function (Faker $faker) {
    return [
        'event_id' => 1,
        'name' => $faker->words(3, true),
        'desc' => $faker->paragraph(1),
        'donor' => $faker->name(),
        'donor_url' => $faker->url(),
        'picture' => $faker->imageURL()
    ];
});
