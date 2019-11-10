<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ambulance_availability extends Model
{
    protected $fillable = [
        'ambulance_id','date','start_time','end_time','description','status'
    ];
}
