<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Tweet;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Tweet::class, function (Faker $faker) {
    return [
        'text' => $faker->text,
    ];
});
