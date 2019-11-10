<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = [
        'patient','title','date','reason','health_status_type','health_status','normal_health_status','description','reference_id','path','report_status','emp_id','status'
    ];
}
