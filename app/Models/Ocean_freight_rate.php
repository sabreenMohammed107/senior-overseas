<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ocean_freight_rate extends Model
{
    protected $fillable = [
        'code', 'ocean_freight', 'price', 'carrier_id','pol_id', 'pod_id','container_id','currency_id','transit_time','validity_date','notes'
      
     
    ];
    public function carrier()
    {
        return $this->belongsTo('App\Models\Carrier','carrier_id');

    }
    public function pol()
    {
        return $this->belongsTo('App\Models\Port','pol_id');

    }
    public function pod()
    {
        return $this->belongsTo('App\Models\Port','pod_id');

    }
    public function container()
    {
        return $this->belongsTo('App\Models\Container','container_id');

    }
    public function currency()
    {
        return $this->belongsTo('App\Models\Currency','currency_id');

    }
}
