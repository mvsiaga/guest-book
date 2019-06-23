<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Models\Guest;
use Faker\Generator as Faker;

$factory->define(Guest::class, function (Faker $faker) {
    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'email' => $faker->email,
        'phone_number' => $faker->phoneNumber,
        'gender' => $faker->randomElement([1, 2]),
        'address' => $faker->address
    ];
});
