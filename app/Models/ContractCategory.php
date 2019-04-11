<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContractCategory extends Model
{
    protected $table = 'contractcategories';
    protected $fillable = [
            'category_name'
        ];
     public function contract()
    {
         return $this->hasMany('App\Models\Contract');
    }

    public $timestamps = false;
}
