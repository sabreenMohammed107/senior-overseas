<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale_quote_ocean extends Model
{
    protected $fillable = [
        'ocean_rate_id', 'sale_quote_id',
         'currency_id','price', 
     
    ];

    public function ocean()
    {
        return $this->belongsTo('App\Models\Ocean_freight_rate','ocean_rate_id');

    }
   
}
