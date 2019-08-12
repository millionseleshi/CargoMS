<?php

use Faker\Generator as Faker;
use App\Countries;
$factory->define(Countries::class, function (Faker $faker) {
    return [
          'countryName'=>$faker->country
    ];
});
