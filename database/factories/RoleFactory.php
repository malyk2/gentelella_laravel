<?php

use Faker\Generator as Faker;

$factory->define(App\Role::class, function (Faker $faker) {
    $group = Group::inRandomOrder()->first();
    return [
        'group_id' => $group->id,
        'name' => $faker->word,
    ];
});
