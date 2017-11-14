<?php

use Faker\Generator as Faker;

$factory->define(App\Comment::class, function (Faker $faker) {
    return [
		'user_id' => \App\User::inRandomOrder()->select('id')->first(),
		'post_id' => \App\Post::inRandomOrder()->select('id')->first(),
		'body' => $faker->paragraph
	];
});
