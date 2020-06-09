<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale_quote_air extends Model
{
    protected $fillable = [
        'air_rate_id', 'sale_quote_id',
         'currency_id','price', 
     
    ];
    public function air()
    {
        return $this->belongsTo('App\Models\Air_rate','air_rate_id');

    }
}
