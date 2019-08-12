<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Organization;
class Deliverer extends Model
{
    protected $fillable=['deliveryPrice'];
   public function organization()
   {
       return $this->belongsTo(Organization::class);
   }
}
