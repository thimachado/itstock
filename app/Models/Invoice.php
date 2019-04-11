<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $table = 'invoices';
    protected $fillable = [
            'invoice_number','invoice_type','reseller_id','area_id','project_id','costcenter_id','invoice_owner',
            'invoice_ctafin','invoice_ctacon','invoice_billingdate','invoice_duedate','category_id','brand_id',
            'product_id','invoice_itemvalue','invoice_itemquantity', 'deposit_id','invoice_typemov', 'vertical_id',
            'invoice_loanstatus',
        ];
    public function inventory()
        {
             return $this->hasMany('App\Models\Inventory');
        }

    public function reseller()
        {
             return $this->belongsTo('App\Models\Reseller');
        }

    public function area()
        {
             return $this->belongsTo('App\Models\Area');
        }

    public function project()
    {
         return $this->belongsTo('App\Models\Projects');
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
