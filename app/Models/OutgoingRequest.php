<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OutgoingRequest extends Model
{
    protected $table = 'outgoingrequests';
    protected $fillable = [
        'request_number','category_id','brand_id', 'product_id','costcenter_id','request_movquantity', 'request_observation',
        'request_datemov', 'area_id', 'request_owner', 'request_avgprice', 'request_user'
    ];

    public function reseller()
        {
             return $this->belongsTo('App\Models\Reseller');
        }
    
    public function area()
        {
             return $this->belongsTo('App\Models\Area');
        }
     
    public function costcenter()
    {
         return $this->belongsTo('App\Models\CostCenter');
    }

    public function category()
    {
         return $this->belongsTo('App\Models\Category');
    }

    public function brand()
    {
         return $this->belongsTo('App\Models\Brand');
    }
    
    public function product()
    {
         return $this->belongsTo('App\Models\Product');
    }
    


    public $timestamps = true;
}
