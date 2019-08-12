<?php

use Faker\Generator as Faker;


$factory->define(App\deliveries::class, function (Faker $faker) {
    $deliverers_id=\App\deliveries::all()->pluck('id');
    $users_id=\App\User::all()->pluck('id');
    return [
        'deliverers_id'=>$faker->randomElement($deliverers_id),
        'users_id'=>$faker->randomElement($users_id),
        'user_name'=>$faker->userName,
        'user_email'=>$faker->safeEmail,
        'user_phone'=>$faker->phoneNumber,
        'from'=>$faker->country,
        'to'=>$faker->country,
        'action'=>$faker->randomElement(['pickUp','dropOf']),
        'totalWeight'=>$faker->numberBetween(1,100),
        'totalPayment'=>$faker->numberBetween(1,1000)
    ];
});
