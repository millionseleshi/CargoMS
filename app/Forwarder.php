<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Forwarder extends Model
{
    protected $fillable =['terminalCharge'];
    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }
}
