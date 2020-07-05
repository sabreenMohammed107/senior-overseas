<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Open_balance extends Model
{
    protected $fillable = [
        'client_id', 'supplier_id', 'agent_id', 'carrier_id', 'open_balance',
        'balance_start_date', 'current_balance', 'currency_id','note',
       
    ];
    public function currency()
    {
        return $this->belongsTo('App\Models\Currency','currency_id');

    }


   
}
