<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable=['Name','FatherName',
        'GrandFatherName','paymentType','amountExpected','amountPaid',
        'receiptsId','AWB','paymentDate','status'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
