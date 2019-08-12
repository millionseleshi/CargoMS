<?php

use Faker\Generator as Faker;

$factory->define(\App\Payment::class, function (Faker $faker) {
    $userID=\App\User::all()->pluck('id');
    return [
        'paymentType'=>$faker->randomElement(['bank','mobile']),
        'amount'=>$faker->numberBetween(1,1000),
        'receiptsId'=>$faker->randomNumber(),
        'paymentDate'=>$faker->dateTime,
        'user_id'=>$faker->randomElement($userID)
    ];
});
