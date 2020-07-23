<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Operation extends Model
{
    protected $fillable = [
        'sales_quote_id', 'operation_code', 'operation_date', 'shipper_id', 'consignee_id',
        'notify_id', 'import_export_flag', 'container_counts','pl_no',
        'container_name', 'loading_date','arrival_date', 'vassel_name', 'booking_no', 'commodity_id', 'cut_off_date', 'sales_quote_ocean_id',
        'sales_quote_air_id', 'sales_quote_tracking_id','account_confirm', 'notes',
    ];
  
    
    public function expense()
    {
        return $this->hasMeny('App\Models\Operation_expense','operation_id','id');

    }
    public function shipper()
    {
        return $this->belongsTo('App\Models\Client','shipper_id');

    }
    public function consignee()
    {
        return $this->belongsTo('App\Models\Client','consignee_id');

    }
    public function notify()
    {
        return $this->belongsTo('App\Models\Client','notify_id');

    }

    public function sale()
    {
        return $this->belongsTo('App\Models\Sale_quote','sales_quote_id');

    }
    public function ocean()
    {
        return $this->belongsTo('App\Models\Sale_quote_ocean','sales_quote_ocean_id');

    }
    public function air()
    {
        return $this->belongsTo('App\Models\Sale_quote_air','sales_quote_air_id');

    }
    public function tracking()
    {
        return $this->belongsTo('App\Models\Sale_quote_trucking','sales_quote_tracking_id');

    }
    
    
}
