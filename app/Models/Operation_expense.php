<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Operation_expense extends Model
{
    protected $fillable = [
        'operation_id', 'expenses_type_id',
         'buy','sell', 'provider_type_id','currency_id','note'
     
    ];
    public function operation()
    {
        return $this->belongsTo('App\Models\Operation','operation_id');

    }

    public function type()
    {
        return $this->belongsTo('App\Models\Expense','expenses_type_id');

    }

    public function provider()
    {
        return $this->belongsTo('App\Models\Expenses_provider_type','provider_type_id');

    }

    public function currency()
    {
        return $this->belongsTo('App\Models\Currency','currency_id');

    }
}
