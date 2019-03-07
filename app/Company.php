<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'name', 'description', 'address', 'telephone', 'mobile', 'gst_no', 'logo', 'start_date', 'expiry_date',
    ];

    public $timestamps = false;

    public function users(){
        return $this->hasMany('App\User');
    }
}
