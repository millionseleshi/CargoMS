<?php

use Faker\Generator as Faker;
use App\Organization;
$factory->define(Organization::class, function (Faker $faker) {
    return [
        'companyName'=>$faker->company,
        'phoneNumber'=>$faker->phoneNumber,
        'AlternatePhoneNumber'=>$faker->phoneNumber,
        'email'=>$faker->email,
        'address'=>$faker->address,
        'about'=>$faker->sentence,
        'type'=>$faker->randomElement(['forwarder','deliverer'])
    ];
});
