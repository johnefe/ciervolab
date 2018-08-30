<?php

use Faker\Generator as Faker;

$factory->define(App\Student::class, function (Faker $faker) {
    return [
	    'user_id' => null,
	    "title" => $faker->jobTitle
    ];
});
