<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $table = 'areas';
    protected $fillable = [
        'area_name'
        ];
     public function costcenter()
    {
         return $this->hasMany('App\Models\CostCenter');
    }
    
    public function license()
   {
        return $this->hasMany('App\Models\License');
   }

    public $timestamps = false;
}
