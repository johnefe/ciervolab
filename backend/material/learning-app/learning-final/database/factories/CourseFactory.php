<?php

use Faker\Generator as Faker;

$factory->define(App\Course::class, function (Faker $faker) {
	$name = $faker->sentence;
	$status = $faker->randomElement([\App\Course::PUBLISHED, \App\Course::PENDING, \App\Course::REJECTED]);
    return [
        'teacher_id' => \App\Teacher::all()->random()->id,
	    'category_id' => \App\Category::all()->random()->id,
	    'level_id' => \App\Level::all()->random()->id,
	    'name' => $name,
	    'slug' => str_slug($name, '-'),
	    'description' => $faker->paragraph,
        'picture' => \Faker\Provider\Image::image(storage_path() . '/app/public/courses', 600, 350, 'business', false),
	    'status' => $status,
	    'previous_approved' => $status !== \App\Course::PUBLISHED ? false : true,
	    'previous_rejected' => $status === \App\Course::REJECTED ? true : false,
    ];
});
