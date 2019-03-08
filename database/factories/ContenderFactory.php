<?php

use Faker\Generator as Faker;

$factory->define(App\Contender::class, function (Faker $faker) {
    return [
        'event_id' => 1,        
    ];
});
