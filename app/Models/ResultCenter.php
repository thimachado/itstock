<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResultCenter extends Model
{
    protected $table = 'resultcenters';
    protected $fillable = [
        'resultcenter_name'
        ];
     public function costcenter()
    {
         return $this->hasMany('App\Models\CostCenter');
    }
    public $timestamps = false;
}
