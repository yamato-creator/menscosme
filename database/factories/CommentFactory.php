<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\User;
use App\Models\Tweet;
use App\Models\Comment;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        'user_id' => function(){
            return factory(User::class)->create()->id;
        },
        'tweet_id' => function(){
            return factory(Tweet::class)->create()->id;
        },
        'text' => $faker->text,
    ];
});
