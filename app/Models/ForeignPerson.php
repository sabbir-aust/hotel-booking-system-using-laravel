<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ForeignPerson extends Model
{
    use HasFactory;

    function foreignPersonel(){
        return $this->belongsTo(Company::class,'company_id');
    }

}
