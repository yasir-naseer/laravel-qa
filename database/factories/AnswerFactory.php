<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Answer;
use App\User;
use Faker\Generator as Faker;

$factory->define(Answer::class, function (Faker $faker) {
    return [
        'body' => $faker->paragraph(rand(3,5),true),
        'user_id' => User::pluck('id')->random(),
        'votes_count' => rand(0,5)
    ];
});
