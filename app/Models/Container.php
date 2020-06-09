<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Container extends Model
{
    protected $fillable = [
        'container_name', 'container_type','container_size','container_note'
       
     
    ];
}
