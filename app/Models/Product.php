<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $table = 'products';
    protected $fillable = [
            'product_model','category_id','brand_id'
        ];

    public function category()
    {
         return $this->belongsTo('App\Models\Category');
    }

    public function brand()
    {
         return $this->belongsTo('App\Models\Brand');
    }
    
    public function stock()
    {
         return $this->hasMany('App\Models\Stock');
    }

    public function inventory()
    {
         return $this->hasMany('App\Models\Inventory');
    }
    public $timestamps = true;
}
