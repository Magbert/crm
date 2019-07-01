<?php

use Illuminate\Support\Str;
use Faker\Generator as Faker;
use App\User;

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->firstName . " " . $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' =>  bcrypt('secret'),
        'secret' => 'secret',
        'phone' => '+7(111)111-11-11',
        'of_phone' => '+7(111)111-11-11',
        'remember_token' => Str::random(10),
    ];
});
