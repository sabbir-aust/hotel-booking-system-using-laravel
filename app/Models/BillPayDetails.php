<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillPayDetails extends Model
{
    use HasFactory;

    function bill(){
        return $this->belongsTo(Company::class,'company_id');
    }
}
