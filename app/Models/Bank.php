<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    protected $fillable = [
        'name', 'open_balance',
       'balance_start_date', 'current_balance', 'currency_id','note',
      
   ];
   public function currency()
   {
       return $this->belongsTo('App\Models\Currency','currency_id');

   }
    
}
