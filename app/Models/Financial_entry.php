<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Financial_entry extends Model
{
    protected $fillable = [
        'trans_type_id', 'entry_date', 'depit', 'credit', 'cash_box_id',
        'bank_account_id', 'currency_id', 'client_id','ocean_carrier_id',
        'air_carrier_id', 'agent_id', 'trucking_id', 'clearance_id', 'operation_id','notes'
       
    ];
    public function client()
    {
        return $this->belongsTo('App\Models\Client','client_id');

    }

    public function currency()
    {
        return $this->belongsTo('App\Models\Currency','currency_id');

    }
    public function carrierocean()
    {
        return $this->belongsTo('App\Models\Carrier','ocean_carrier_id');

    }
    public function carrierair()
    {
        return $this->belongsTo('App\Models\Carrier','air_carrier_id');

    }
    public function supplierclearance()
    {
        return $this->belongsTo('App\Models\Supplier','clearance_id');

    }
    public function suppliertracking()
    {
        return $this->belongsTo('App\Models\Supplier','trucking_id');

    }
    public function agent()
    {
        return $this->belongsTo('App\Models\Agent','agent_id');

    }
    public function operation()
    {
        return $this->belongsTo('App\Models\Operation','operation_id');

    }

    public function type()
    {
        return $this->belongsTo('App\Models\Finan_trans_type','trans_type_id');

    }

    public function bank()
    {
        return $this->belongsTo('App\Models\Bank','bank_account_id');

    }

}
