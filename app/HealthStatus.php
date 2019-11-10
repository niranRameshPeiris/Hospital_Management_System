<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HealthStatus extends Model
{
    protected $fillable = [
        'admit_id','type','date','health_status','recommendations','description','status'
    ];
}
