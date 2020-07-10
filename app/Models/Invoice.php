<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = [
        'invoice_no', 'invoice_date', 'operation_id', 'notes'
       
    ];
    public function operation()
    {
        return $this->belongsTo('App\Models\Operation','operation_id');

    }
}
