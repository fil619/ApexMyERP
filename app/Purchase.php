<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $fillable = [
        'company_id',
        'part_id',
        'distributor_id',
        'quantity',
        'buy_mrp',
        'sell_mrp',
        'gst_percent',
        'buy_gst_value',
        'buy_value',
        'sell_gst_value',
        'sell_value',
        'threshold',
        'bought_on',
        'sold',
        'sold_on',
        'stock',
    ];

    public $timestamps = false;
}
