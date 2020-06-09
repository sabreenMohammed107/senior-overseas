<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $fillable = [
        'supplier_name', 'contact_person', 'phone','mobile', 'email',
        'address', 'country_id','supplier_type_id', 'supplier_document'
     
    ];
    public function country()
    {
        return $this->belongsTo('App\Models\Country','country_id');

    }

    public function type()
    {
        return $this->belongsTo('App\Models\Supplier_type','supplier_type_id');

    }
}
