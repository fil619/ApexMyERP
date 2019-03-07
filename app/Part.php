<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Part extends Model
{
    protected $fillable = [
        'code', 'company_id', 'name', 'manufactured_by', 'vehicle_company', 'vehicle_model', 'hsn', 'sac',
    ];

    public $timestamps = false;
}
