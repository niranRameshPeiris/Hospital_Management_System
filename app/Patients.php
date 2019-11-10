<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patients extends Model
{
    protected $fillable = [
        'name', 'nic','birthday','gender','email','contact','address','description','guardian_email','guardian','status'
    ];
}
