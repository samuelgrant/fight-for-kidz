<?php

use Faker\Generator as Faker;

$factory->define(App\Applicant::class, function (Faker $faker) {

    // Setting the gender first so that we can generate a gender appropriate first name.
    

    return [
        'event_id' => 1,
        //Section 1 - Contact Information
        'first_name' => '',
        'last_name' => '',
        'address_1' => 'N/A',
        'address_2' => 'N/A',
        'suburb' => 'N/A',
        'city' => 'N/A',
        'postcode' => 0000,
        'phone_1' => 'N/A',
        'phone_2' => 'N/A',
        'email' => 'no-email@example.co.nz',

        //Section 2 - Personal Details
        'dob' => $faker->dateTimeBetween($startDate = '-30 years', $endDate = '-18 years'),
        'height' => 0,
        'current_weight' => 0,
        'expected_weight' => 0,
        'occupation' => 'N/A',
        'employer' => 'N/A',
        'is_male' => 0,
        'right_handed' => $faker->numberBetween(0, 1),      
        'preferred_fight_name' => 'N/A',
        'can_secure_sponsor' => $faker->numberBetween(0, 1),

        //Section 3 - Emergency Contact
        'emergency_first_name' => 'N/A',
        'emergency_last_name' => 'N/A',
        'emergency_relationship' => 'N/A',
        'emergency_phone_1' => 0,
        'emergency_phone_2' => 0,
        'emergency_email' => 'N/A',

        //Section 4 - Sporting Experience
        'fitness_rating' => $faker->numberBetween(1, 5),
        'sporting_exp' => 'N/A',
        'boxing_exp' => 'N/A',

        //Section 5 - Medical Questions
        'heart_disease' => 0,  
        'breathlessness' => 0,
        'epilepsy' => 0,
        'heart_attack' => 0,
        'stroke' => 0,
        'heart_surgery' => 0,
        'respiratory_problems' => 0,
        'cancer' => 0,
        'irregular_heartbeat' => 0,
        'smoking' => 0,
        'joint_pain_problems' => 0,
        'chest_pain_discomfort' => 0,
        'hypertension' => 0,
        'surgery' => 0,
        'dizziness_fainting' => 0,
        'high_cholesterol' => 0,

        'other' => null,
        'hand_injuries' => 'N/A',
        'previous_current_injuries' => 'N/A',
        'current_medication' => 'N/A',

        'heart_condition' => 0,
        'chest_pain_activity' => 0,
        'chest_pain_recent' => 0,
        'lost_consciousness' => 0,
        'bone_joint_problems' => 0,
        'recommended_medication' => 0,
        'concussed_knocked_out' => null,
        'other_reasons' => null,    

        //Section 6 - Additional Information
        'hobbies' => 'N/A',
        'conviction_details' => null,
        'consent_to_test' => 0
    ];
});
