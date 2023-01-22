<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    function foreign(){
        return $this->hasMany(ForeignPerson::class);
    }

    function billPay(){
        return $this->hasMany(BillPayDetails::class,'company_id');
    }

    function company_client(){
        return $this->hasMany(Client::class);
    }

    function bookings(){
        return $this->hasMany(Booking::class);
    }
}
