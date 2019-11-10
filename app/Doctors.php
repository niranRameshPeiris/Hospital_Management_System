<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Doctors extends Model
{
    protected $fillable = [
        'name', 'employed_date','registration_date','registration_no', 'nic', 'specialty','age','gender','email','mobile','landline','address','description','status'
    ];
}
