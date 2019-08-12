<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Employee;
use App\Payment;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable,HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $directory="/UserImage/";

    protected $fillable = [
        'firstName', 'middleName', 'lastName',
        'phoneNumber', 'AlternatePhoneNumber', 'email','email_verified_at',
        'address', 'userName', 'password','role','userImage'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function payment()
    {
        return $this->hasMany(Payment::class);
    }

    public function employee()
    {
        return $this->hasMany(Employee::class);
    }

    public function deliveries()
    {
        return $this->hasMany(deliveries::class);
    }

    public function getUserImageAttribute($value)
    {
          return url('/').$this->directory.$value;
    }
}
