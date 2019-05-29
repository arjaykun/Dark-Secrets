<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'title' => $faker->company,
        'body' => 'This is a sample post ' . Str::random(100),
        'user_id' => 1
    ];
});
