<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vertical extends Model
{
    protected $table = 'verticals';
    protected $fillable = [
        'vertical_name'
        ];
     public function costcenter()
    {
         return $this->hasMany('App\Models\CostCenter');
    }

    public $timestamps = false;
}

