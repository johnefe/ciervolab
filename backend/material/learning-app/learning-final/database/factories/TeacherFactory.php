<?php

use Faker\Generator as Faker;

$factory->define(App\Teacher::class, function (Faker $faker) {
    return [
	    'user_id' => null,
	    'title' => $faker->jobTitle,
	    'biography' => $faker->paragraph,
	    'website_url' => $faker->url,
    ];
});
