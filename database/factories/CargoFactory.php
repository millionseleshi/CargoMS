<?php

use App\Cargo;
use Faker\Generator as Faker;

$factory->define(Cargo::class, function (Faker $faker) {
    $shipmentId=\App\Shipment::all()->pluck('id');
    return [
        'carrier'=>\Illuminate\Support\Str::random(4),
        'flightNumber'=>'ET/'.$faker->randomNumber(),
        'maxWidth'=>$faker->numberBetween(1,500),
        'maxLength'=>$faker->numberBetween(1,500),
        'maxHeight'=>$faker->numberBetween(1,500),
        'maxWeight'=>$faker->numberBetween(1,500),
        'from'=>$faker->country,
        'to'=>$faker->country,
        'departureDate'=>$faker->dateTimeThisYear,
        'arrivalDate'=>$faker->dateTimeThisYear,
        'shipments_id'=>$faker->randomElement($shipmentId),
        'status'=>$faker->randomElement(['takeoff','landed'])
    ];
});
