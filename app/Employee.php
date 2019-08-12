<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Organization;

class Employee extends Model
{
    protected $fillable=['position','type','users_id','organizations_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }
}
