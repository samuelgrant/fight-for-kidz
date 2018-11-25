<?php

use Faker\Generator as Faker;

$factory->define(App\MerchandiseItem::class, function (Faker $faker) {
    return [
        'name' => $faker->text(15),
        'desc' => $faker->sentence(6, true),
        'price' => 29.99,
        'is_active' => true
    ];
});
