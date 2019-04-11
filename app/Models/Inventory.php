<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    protected $table = 'inventories';
    protected $fillable = [
         'category_id','brand_id','product_id','costcenter_id','invoice_number','inventory_itemvalue','inventory_itemquantity',
         'inventory_typemov','inventory_movquantity','inventory_movvalue','inventory_observation','inventory_datemov','deposit_id'
        ];

        public function category()
        {
             return $this->hasMany('App\Models\Category');
        }
    
        public function brand()
        {
             return $this->hasMany('App\Models\Brand');
        }
        
        public function product()
        {
             return $this->hasMany('App\Models\Product');
        }
        public function costcenter()
        {
             return $this->hasMany('App\Models\CostCenter');
        }
        public $timestamps = true;
}
