<?php

use Faker\Generator as Faker;
use App\ShipmentDetail;
$factory->define(ShipmentDetail::class, function (Faker $faker) {
    $shipmentID=\App\Shipment::all()->pluck('id');
    return [
        'type'=>$faker->name,
        'brand'=>$faker->company,
        'color'=>$faker->colorName,
        'amount'=>$faker->numberBetween(1,50),
        'shipment_id'=>$faker->randomElement($shipmentID)
    ];
});
