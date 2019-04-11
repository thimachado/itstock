<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $table = 'brands';
    protected $fillable = [
            'brand_name'
        ];
     public function product()
    {
         return $this->hasMany('App\Models\Product');
    }

    public function stock()
    {
         return $this->hasMany('App\Models\Stock');
    }

    public function inventory()
    {
         return $this->hasMany('App\Models\Inventory');
    }

    public function license()
   {
        return $this->hasMany('App\Models\License');
   }


    public $timestamps = false;
}
