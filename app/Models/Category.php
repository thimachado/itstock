<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $fillable = [
            'category_name'
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
    public $timestamps = false;
}
