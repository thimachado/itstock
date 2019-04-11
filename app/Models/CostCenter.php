<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CostCenter extends Model
{
    protected $table = 'costcenters';
    protected $fillable = [
            'costcenter_cod','costcenter_description','costcenter_businessowner','costcenter_ccowner',
            'business_id', 'clientgroup_id','resultcenter_id','project_id','area_id','vertical_id'
        ];

    public function business()
    {
         return $this->belongsTo('App\Models\Business');
    }
    public function clientgroup()
    {
         return $this->belongsTo('App\Models\ClientGroup');
    }
    public function resultcenter()
    {
         return $this->belongsTo('App\Models\ResultCenter');
    }
    public function project()
    {
         return $this->belongsTo('App\Models\Project');
    }
    public function area()
    {
         return $this->belongsTo('App\Models\Area');
    }
    public function vertical()
    {
         return $this->belongsTo('App\Models\Vertical');
    }
    public $timestamps = false;
}
