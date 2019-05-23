<?php

use Faker\Generator as Faker;
use App\User;
use App\Customer;

$factory->define(App\Project::class, function (Faker $faker) {
    return [
        'name' => 'Проект: ' . $faker->sentence(),
        'description' => $faker->text(1000),
        'user_id' => User::all()->random()->id,
        'customer_id' => Customer::all()->random()->id,
    ];
});
