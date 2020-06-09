<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bank_account extends Model
{
    protected $fillable = [
        'beneficiary', 'account_number', 'bank_name','company_name', 'currency_id',
        'address'
     
    ];
    public function currency()
    {
        return $this->belongsTo('App\Models\Currency','currency_id');

    }
   
}
