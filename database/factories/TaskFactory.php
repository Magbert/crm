<?php

use Faker\Generator as Faker;
use App\Task;

$factory->define(Task::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence(),
        'description' => $faker->text(1000),
        'completed' => $faker->boolean(20),
        'due_at' => $faker->dateTimeBetween('+0 days', '+23 days')
    ];
});
