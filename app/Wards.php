<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wards extends Model
{
    protected $fillable = [
        'no', 'name','doctor', 'extension','description','status'
    ];
}
