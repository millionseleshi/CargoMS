<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cargo extends Model
{
    protected $fillable=['flightNumber','maxWidth','maxLength','maxHeight',
        'maxWeight','from','to','departureDate','arrivalDate','shipments_id','status'];

    public function shipment()
    {
        return $this->hasMany(Shipment::class);
    }
}
