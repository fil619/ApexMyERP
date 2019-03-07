<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Distributor extends Model
{
    protected $fillable = [
        'company_id', 'name', 'address', 'telephone', 'mobile', 'email', 'gst_no',
    ];

    public $timestamps = false;
}
