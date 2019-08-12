<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Shipment;
use Illuminate\Support\Facades\App;

class ShipmentDetail extends Model
{
    protected $table="shipmentdetails";

    protected $fillable=['type','brand','color','amount','shipment_id'];

    public function shipment()
    {
        return $this->belongsTo('App\Shipment');
    }
}
