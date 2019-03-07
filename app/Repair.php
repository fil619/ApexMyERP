<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Repair extends Model
{
    protected $fillable = [
        'company_id',
        'bill_id',
        'employee_id',
        'service_detail',
        'service_charge',
        'other_detail',
        'other_charge',
        'repaired_on',
    ];

    public $timestamps = false;
}
