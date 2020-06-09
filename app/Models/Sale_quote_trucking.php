<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale_quote_trucking extends Model
{
    protected $fillable = [
        'trucking_rate_id', 'sale_quote_id',
         'currency_id','car_price', 
     
    ];
    public function truck()
    {
        return $this->belongsTo('App\Models\Trucking_rate','trucking_rate_id');

    }
}
