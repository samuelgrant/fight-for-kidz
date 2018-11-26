<?php

use Illuminate\Support\Facades\Hash;
use Faker\Generator as Faker;

$factory->define(App\Subscriber::class, function (Faker $faker) {

    $email = $faker->unique()->freeEmail();
    $token = Hash::make($email . uniqid());

    return [
        'name' => $faker->name(),
        'email' => $email,
        'unsubscribe_token' => $token,
    ];
});
