<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\ShipmentDetail;
class Shipment extends Model
{
    protected $fillable=[
        'shipperName','shipperAddress','shipperPhoneNumber','shipperEmail','consigneeName','consigneeAddress',
        'consigneePhoneNumber','consigneeEmail','flightNo','shipmentType', 'totalWeight',
       'AWB','validity','status'
        ];

    protected $guarded=[];

    public function shipmentDetail()
    {
        return $this->hasOne(ShipmentDetail::class);
    }
    public function cargo()
    {
        return $this->hasOne(Cargo::class);
    }
}
