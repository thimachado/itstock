<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClientGroup extends Model
{
    protected $table = 'clientgroups';
    protected $fillable = [
        'clientgroup_name'
        ];
     public function costcenter()
    {
         return $this->hasMany('App\Models\CostCenter');
    }
    public $timestamps = false;
}
