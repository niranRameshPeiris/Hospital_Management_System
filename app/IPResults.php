<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IPResults extends Model
{
    protected $fillable = [
        'patient', 'image','date','accuracy','result','status'
    ];
}
