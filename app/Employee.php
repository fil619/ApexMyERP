<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'company_id', 'first_name', 'last_name', 'dob', 'address', 'telephone', 'mobile',
        'email', 'aadhaar', 'type', 'password', 'joined_on','left_on','status'
    ];

    public $timestamps = false;
}
