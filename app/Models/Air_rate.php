<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Air_rate extends Model
{
    protected $fillable = [
        'code','air_carrier_id', 'currency_id','aol_id', 'aod_id','slide_range','price'
        ,'validity_date','notes'
      
     
    ];
    public function carrier()
    {
        return $this->belongsTo('App\Models\Carrier','air_carrier_id');

    }
    public function aol()
    {
        return $this->belongsTo('App\Models\Port','aol_id');

    }
    public function aod()
    {
        return $this->belongsTo('App\Models\Port','aod_id');

    }
 
   
    public function currency()
    {
        return $this->belongsTo('App\Models\Currency','currency_id');

    }
}
