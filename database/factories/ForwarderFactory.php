<?php

use Faker\Generator as Faker;
use App\Forwarder;
$factory->define(Forwarder::class, function (Faker $faker) {
    $orgId=\App\Organization::all()->pluck('id');
    return [
        'terminalCharge'=>$faker->numberBetween(0,100),
        'organization_id'=>$faker->randomElement($orgId)
    ];
});
