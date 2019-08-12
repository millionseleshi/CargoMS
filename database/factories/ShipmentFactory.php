<?php

use Faker\Generator as Faker;
use App\Shipment;
$factory->define(Shipment::class, function (Faker $faker) {
    return [
        'shipperName'=>$faker->name,
        'shipperAddress'=>$faker->address,
        'shipperPhoneNumber'=>$faker->phoneNumber,
        'shipperEmail'=>$faker->email,

        'consigneeName'=>$faker->name,
        'consigneeAddress'=>$faker->address,
        'consigneePhoneNumber'=>$faker->phoneNumber,
        'consigneeEmail'=>$faker->email,
        'flightNo'=>'ET/'.$faker->randomKey(),

        'totalWeight'=>$faker->numberBetween(10,200),
        'shipmentType'=>$faker->randomElement(['radioactive','perishable','live animal','general Cargo','valuable item','vehicles','dangerous goods']),
        'AWB'=>$faker->randomNumber(),
        'validity'=>$faker->randomElement(['valid','unchecked','invalid']),
        'status'=>$faker->randomElement(['pickup','checkin','processing','checkout','delivered']),
    ];
});
