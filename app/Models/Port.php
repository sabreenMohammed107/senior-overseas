<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Port extends Model
{
    protected $fillable = [
        'port_name', 'door_port',
         'country_id','port_type_id', 
     
    ];
    public function country()
    {
        return $this->belongsTo('App\Models\Country','country_id');

    }

    public function type()
    {
        return $this->belongsTo('App\Models\Port_type','port_type_id');

    }
}
