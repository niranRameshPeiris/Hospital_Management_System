<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Beds extends Model
{
    protected $fillable = [
        'no', 'name', 'ward','description','status'
    ];
}
