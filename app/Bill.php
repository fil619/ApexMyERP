<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    protected $fillable = [
        'company_id', 'type', 'customer_id', 'start_date', 'ended_on', 'sub_total', 'gst_total', 'discount', 'grand_total', 'advance', 'balance', 'paid', 'returnable', 'transaction_type',
    ];

    public $timestamps = false;
}
