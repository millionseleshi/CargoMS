<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use App\Deliverer;
use App\Forwarder;

class Organization extends Model
{
    protected $fillable=['companyName','phoneNumber','AlternatePhoneNumber','email','address','about','type'];

    public function deliverer()
    {
        return $this->hasMany(Deliverer::class);
    }

    public function forwarder()
    {
        return $this->hasMany(Forwarder::class);
    }

    public function employee()
    {
        return $this->hasMany(Employee::class);
    }
}
