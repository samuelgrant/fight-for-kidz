<?php

use Faker\Generator as Faker;

$factory->define(App\Applicant::class, function (Faker $faker) {

    // Setting the gender first so that we can generate a gender appropriate first name.
    $isMale = $faker->numberBetween(0, 1);
    $firstName = $isMale ? $faker->firstName('male') : $faker->firstName('female');

    return [
        'event_id' => 1,
        'first_name' => $firstName,
        'last_name' => $faker->lastName(),
        'is_male' => $isMale,
        'address_1' => $faker->streetAddress(),
        'address_2' => null,
        'suburb' => $faker->city(),
        'city' => $faker->city(),
        'phone' => $faker->phoneNumber(),
        'mobile' => $faker->phoneNumber(),
        'email' => $faker->email(),
        'dob' => $faker->dateTimeBetween($startDate = '-30 years', $endDate = '-18 years'),
        'current_weight' => $faker->numberBetween(50, 160),
        'expected_weight' => $faker->numberBetween(60, 140),
        'height' => $faker->numberBetween(130, 220),
        'right_handed' => $faker->numberBetween(0, 1),
        'photo' => '/storage/images/applicants/default.png',
        'sporting_exp' => $faker->paragraph(3, true),
        'boxing_exp' => $faker->paragraph(2, true),
        'occupation' => $faker->jobTitle(),
        'employer' => $faker->company(),
        'can_secure_sponsor' => $faker->numberBetween(0, 1),
        'conviction_details' => null,
        'consent_to_test' => $faker->numberBetween(0, 1)
    ];
});
