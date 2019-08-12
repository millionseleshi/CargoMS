<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class deliveries extends Model
{
    protected $fillable=['deliverers_id','users_id','action','totalWeight','totalPayment'];

    public function my_user()
    {
        return $this->belongsTo(deliveries::class);
    }
}
