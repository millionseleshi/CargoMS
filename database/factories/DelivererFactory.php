<?php

use Faker\Generator as Faker;
use App\Deliverer;



$factory->define(Deliverer::class, function (Faker $faker) {
    $orgId=\App\Organization::all()->pluck('id');
    return [
        'deliveryPrice'=>$faker->numberBetween(1,100),
        'organization_id'=>$faker->randomElement($orgId)
    ];
});
