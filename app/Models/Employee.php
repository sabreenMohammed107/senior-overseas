<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'employee_name', 'national_id', 'phone','mobile', 'mobile2',
        'position', 'salary', 'employee_document','address','notes'
     
    ];
}
