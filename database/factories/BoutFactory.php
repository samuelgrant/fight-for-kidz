<?php

use Faker\Generator as Faker;

$factory->define(App\Bout::class, function (Faker $faker) {
    return [
        'event_id' => 1
    ];
});
