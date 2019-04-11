<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IndexReadjust extends Model
{
    protected $table = 'indexreadjustments';
    protected $fillable = [
            'index_name'
        ];
     public function contract()
    {
         return $this->hasMany('App\Models\Contract');
    }

    public $timestamps = false;
}
