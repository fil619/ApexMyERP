<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Additional extends Model
{
  protected $fillable = [
    'emp_id',
    'company_id',
    'vehicle',
    'date',
    'amount',
    'work'
];
public $timestamps = false;
}
