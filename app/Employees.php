<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employees extends Model
{
    protected $fillable = [
        'name', 'employed_date', 'nic', 'role','age','gender','email','mobile','landline','address','description','status'
    ];
}
