<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    function company()
    {
        return $this->belongsTo(Company::class);
    }

    function room()
    {
        return $this->belongsTo(Room::class);
    }

    function roomtype()
    {
        return $this->belongsTo(RoomType::class);
    }
}
