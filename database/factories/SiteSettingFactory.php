<?php

use Faker\Generator as Faker;

$factory->define(App\SiteSetting::class, function (Faker $faker) {
    return [
        'about_us' => 'Fight for Kidz is a charity boxing event held in Southland every year to help raise funds for our most vulnerable children. Since 2003 boxers have gone head to head in xx events raising money for various charities rasing a total of $xxx,xxx.'
    ];
});
