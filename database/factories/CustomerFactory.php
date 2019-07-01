<?php

use Illuminate\Support\Str;
use Faker\Generator as Faker;
use App\Customer;

$factory->define(Customer::class, function (Faker $faker) {
    return [
        'name' => $faker->company(),
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' =>  'secret',
        'remember_token' => Str::random(10),
    ];
});
