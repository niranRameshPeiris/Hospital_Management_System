<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Logins extends Model
{
    protected $fillable = [
        'user_id', 'login_id','type','status'
    ];
}
