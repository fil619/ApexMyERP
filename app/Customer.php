<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'company_id', 'name', 'mobile', 'vehicle_no', 'gst_no', 'first_visit', 'last_visit', 'visits',
    ];

    public $timestamps = false;
}
