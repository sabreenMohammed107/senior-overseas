<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale_quote extends Model
{
    protected $fillable = [
        'quote_date', 'quote_code', 'client_id','ocean_air_type','supplier_id','sale_quotes_type_id',
       
        'clearance_price', 'clearance_currency_id','clearance_notes','sale_person_id',
         'door_door_price','door_door_currency_id','door_door_notes','agent_id'
     
    ];
    public function client()
    {
        return $this->belongsTo('App\Models\Client','client_id');

    }
    public function employee()
    {
        return $this->belongsTo('App\Models\Employee','sale_person_id');

    }
    public function supplier()
    {
        return $this->belongsTo('App\Models\Supplier','supplier_id');

    }
    public function agent()
    {
        return $this->belongsTo('App\Models\Agent','agent_id');

    }
    public function clearance()
    {
        return $this->belongsTo('App\Models\Currency','clearance_currency_id');

    }
    public function door()
    {
        return $this->belongsTo('App\Models\Currency','door_door_currency_id');

    }

}
