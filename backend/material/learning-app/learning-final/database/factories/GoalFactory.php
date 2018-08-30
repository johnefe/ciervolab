<?php

use Faker\Generator as Faker;

$factory->define(App\Goal::class, function (Faker $faker) {
    return [
	    'course_id' => \App\Course::all()->random()->id,
	    'goal' => $faker->sentence
    ];
});
