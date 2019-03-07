<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable = [
        'company_id',
        'purchase_id',
        'part_id',
        'bill_id',
        'part_name',
        'quantity',
        'sell_mrp',
        'gst_percent',
        'gst_value',
        'sale_total',
        'sold_on',
    ];

    public $timestamps = false;
}
