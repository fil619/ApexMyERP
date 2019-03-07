<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CounterSale extends Model
{
    protected $fillable = [
        'company_id',
        'purchase_id',
        'part_id',
        'part_name',
        'quantity',
        'sell_mrp',
        'gst_percent',
        'gst_value',
        'amount',
        'transaction_type',
        'discount',
        'paid',
        'returnable',
        'sold_on',
    ];

    public $timestamps = false;
}
