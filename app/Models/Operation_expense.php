<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Operation_expense extends Model
{
    protected $fillable = [
        'operation_id', 'expenses_type_id',
         'buy','sell', 'cashbox_expenses_types_id','currency_id','note','automatic','invoice_statement_flag',
         'ocean_carrier_id',
        'air_carrier_id', 'agent_id', 'trucking_id', 'clearance_id',
     
    ];
    public function operation()
    {
        return $this->belongsTo('App\Models\Operation','operation_id');

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
    public function type()
    {
        return $this->belongsTo('App\Models\Expense','expenses_type_id');

    }

    public function provider()
    {
        return $this->belongsTo('App\Models\Cashbox_expenses_type','cashbox_expenses_types_id');

    }

    public function currency()
    {
        return $this->belongsTo('App\Models\Currency','currency_id');

    }
}
