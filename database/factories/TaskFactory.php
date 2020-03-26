<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(\App\Models\Task::class, function (Faker $faker) {
    return [
        'title' => $faker->title,
        'description' => $faker->text,
        'status_id' => \App\Models\Status::all()->random(1)->first(),
        'user' => \App\Models\User::all()->random(1)->first()->user_id,
    ];
});
