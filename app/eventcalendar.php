<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class eventcalendar extends Model
{
  protected $fillable = [
    'employee_id',
    'company_id',
    'title',
    'type',
    'start',
    'end',
    'allDay',
    'color'
];
public $timestamps = false;
}
