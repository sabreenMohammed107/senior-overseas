<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agent extends Model
{
   
    protected $fillable = [
        'agent_name', 'contact_person', 'phone','mobile', 'email',
         'country_id', 
     
    ];
    public function country()
    {
        return $this->belongsTo('App\Models\Country','country_id');

    }
}
