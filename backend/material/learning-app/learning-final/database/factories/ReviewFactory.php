<?php

use Faker\Generator as Faker;

$factory->define(App\Review::class, function (Faker $faker) {
    return [
	    'course_id' => \App\Course::all()->random()->id,
	    'rating' => $faker->randomFloat(2, 1, 5)
    ];
});
