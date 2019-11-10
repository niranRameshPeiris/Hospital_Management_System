<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admit extends Model
{
    protected $fillable = [
        'patient','doctor','start_date','end_date','disease','ward_id','bed_id','status'
    ];
}
