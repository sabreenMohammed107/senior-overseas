<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trucking_rate extends Model
{
    protected $fillable = [
        'code','supplier_id','pol_id', 'pod_id','car_price','car_currency_id','car_type_id'
        ,'transit_time','validity_date','notes'
      
     
    ];
    public function supplier()
    {
        return $this->belongsTo('App\Models\Supplier','supplier_id');

    }
   
    public function pol()
    {
        return $this->belongsTo('App\Models\Port','pol_id');

    }
    public function pod()
    {
        return $this->belongsTo('App\Models\Port','pod_id');

    }
    public function car()
    {
        return $this->belongsTo('App\Models\Car_type','car_type_id');

    }
    public function currency()
    {
        return $this->belongsTo('App\Models\Currency','car_currency_id');

    }

   
}
