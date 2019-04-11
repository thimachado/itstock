<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    protected $table = 'business';
    protected $fillable = [
        'business_name'
        ];
     public function costcenter()
    {
         return $this->hasMany('App\Models\CostCenter');
    }
    public $timestamps = false;
}
