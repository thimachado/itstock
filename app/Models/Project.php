<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table = 'projects';
    protected $fillable = [
        'project_cod', 'project_name'
        ];
     public function costcenter()
    {
         return $this->hasMany('App\Models\CostCenter');
    }
    public $timestamps = false;
}
