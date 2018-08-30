<?php

use Faker\Generator as Faker;

$factory->define(App\Requirement::class, function (Faker $faker) {
    return [
	    'course_id' => \App\Course::all()->random()->id,
	    'requirement' => $faker->sentence
    ];
});
