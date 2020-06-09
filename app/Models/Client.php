<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'client_name', 'contact_person', 'phone','mobile', 'email',
        'address', 'country_id', 'client_document'
     
    ];
    public function country()
    {
        return $this->belongsTo('App\Models\Country','country_id');

    }
}
