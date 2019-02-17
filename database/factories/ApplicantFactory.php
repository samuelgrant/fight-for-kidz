<?php

use Faker\Generator as Faker;

$factory->define(App\Applicant::class, function (Faker $faker) {

    // Setting the gender first so that we can generate a gender appropriate first name.
    $isMale = $faker->numberBetween(0, 1);
    $firstName = $isMale ? $faker->firstName('male') : $faker->firstName('female');
    $lastName = $faker->lastname();

    $gender = $faker->numberBetween(0,1);
    $relationship = $gender ? "Father" : "Mother";
    $e_firstName = $gender ? $faker->firstName('male') : $faker->firstName('female');
    return [
        'event_id' => $faker->numberBetween(1,3),
        //Section 1 - Contact Information
        'first_name' => $firstName,
        'last_name' => $lastName,
        'address_1' => $faker->streetAddress(),
        'address_2' => null,
        'suburb' => $faker->city(),
        'city' => $faker->city(),
        'postcode' => $faker->randomNumber(4, true),
        'phone_1' => $faker->phoneNumber(),
        'phone_2' => $faker->phoneNumber(),
        'email' => $faker->unique()->safeEmail(),

        //Section 2 - Personal Details
        'dob' => $faker->dateTimeBetween($startDate = '-30 years', $endDate = '-18 years'),
        'height' => $faker->numberBetween(130, 220),
        'current_weight' => $faker->numberBetween(50, 160),
        'expected_weight' => $faker->numberBetween(60, 140),
        'occupation' => $faker->jobTitle(),
        'employer' => $faker->company(),
        'is_male' => $isMale,
        'right_handed' => $faker->numberBetween(0, 1),      
        'preferred_fight_name' => $faker->words(2, true),
        'can_secure_sponsor' => $faker->numberBetween(0, 1),

        //Section 3 - Emergency Contact
        'emergency_first_name' => $e_firstName,
        'emergency_last_name' => $lastName,
        'emergency_relationship' => $relationship,
        'emergency_phone_1' => $faker->phoneNumber(),
        'emergency_phone_2' => $faker->phoneNumber(),
        'emergency_email' => $faker->unique()->email(),

        //Section 4 - Sporting Experience
        'fitness_rating' => $faker->numberBetween(1, 5),
        'sporting_exp' => $faker->paragraph(3, true),
        'boxing_exp' => $faker->paragraph(2, true),

        //Section 5 - Medical Questions
        'heart_disease' => $faker->numberBetween(0, 1),  
        'breathlessness' => $faker->numberBetween(0, 1),
        'epilepsy' => $faker->numberBetween(0, 1),
        'heart_attack' => $faker->numberBetween(0, 1),
        'stroke' => $faker->numberBetween(0, 1),
        'heart_surgery' => $faker->numberBetween(0, 1),
        'respiratory_problems' => $faker->numberBetween(0, 1),
        'cancer' => $faker->numberBetween(0, 1),
        'irregular_heartbeat' => $faker->numberBetween(0, 1),
        'smoking' => $faker->numberBetween(0, 1),
        'joint_pain_problems' => $faker->numberBetween(0, 1),
        'chest_pain_discomfort' => $faker->numberBetween(0, 1),
        'hypertension' => $faker->numberBetween(0, 1),
        'surgery' => $faker->numberBetween(0, 1),
        'dizziness_fainting' => $faker->numberBetween(0, 1),
        'high_cholesterol' => $faker->numberBetween(0, 1),

        'other' => null,
        'hand_injuries' => $faker->paragraph(1, true),
        'previous_current_injuries' => $faker->paragraph(1, true),
        'current_medication' => $faker->paragraph(1, true),

        'heart_condition' => $faker->numberBetween(0, 1),
        'chest_pain_activity' => $faker->numberBetween(0, 1),
        'chest_pain_recent' => $faker->numberBetween(0, 1),
        'lost_consciousness' => $faker->numberBetween(0, 1),
        'bone_joint_problems' => $faker->numberBetween(0, 1),
        'recommended_medication' => $faker->numberBetween(0, 1),
        'concussed_knocked_out' => null,
        'other_reasons' => null,    

        //Section 6 - Additional Information
        'hobbies' => $faker->paragraph(1, true),
        'conviction_details' => null,
        'consent_to_test' => $faker->numberBetween(0, 1)
    ];
});
