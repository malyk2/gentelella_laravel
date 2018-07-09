<?php

use Faker\Generator as Faker;
use App\Group;

$factory->define(App\Group::class, function (Faker $faker) {
    $parent = Group::inRandomOrder()->first();
    return [
        'name' => $faker->word,
        'active' => 1,
        'lifetime' => array_rand(config('smart.users.groups.lifetimes')),
        '_lft' => 0,
        '_rgt' => 0,
        'parent_id' => $parent->id,
    ];
});
