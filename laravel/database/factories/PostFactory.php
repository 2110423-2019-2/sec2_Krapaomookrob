<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use app\Payment;
use Faker\Generator as Faker;

$factory->define(app\Payment::class, function (Faker $faker) {
    return [
        'updated_at' => now(),
            'charge_id' => $faker->sentence,
            'user_id' => $faker->numberBetween(1, 9),
            'status' => $faker->enum('init','successful','fail')
    ];
});
