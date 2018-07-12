<?php

use Faker\Generator as Faker;
use App\Group;

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

$factory->define(App\User::class, function (Faker $faker) {
    $faker = \Faker\Factory::create('uk_UA');
    $group = Group::inRandomOrder()->first();
    return [
        'name' => $faker->name,
        'group_id' => $group->id,
        'active' => 1,
        'logout' => 0,
        'name' => $faker->userName(),
        'email' => $faker->unique()->safeEmail,
        'password' => 'secret',
        'pib' => $faker->name(),
        'remember_token' => str_random(10),
    ];
});
