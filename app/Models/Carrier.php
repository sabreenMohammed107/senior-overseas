<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Carrier extends Model
{
    protected $fillable = [
        'carrier_name', 'carrier_type_id',
         'phone','address', 
     
    ];
    
    public function type()
    {
        return $this->belongsTo('App\Models\Carrier_type','carrier_type_id');

    }
}
