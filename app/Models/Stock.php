<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $table = 'stocks';
    protected $fillable = [
            'product_id','category_id','brand_id', 'stock_quantity','stock_avgprice'
        ];

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

    public $timestamps = false;
}
