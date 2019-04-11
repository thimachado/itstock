<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class License extends Model
{
  protected $table = 'licenses';
  protected $fillable = [
          'license_name','brand_id','license_version','area_id','license_keyuser','license_maintainer','license_integration','license_dbaccess',
          'license_qty','license_type','license_server','license_totalvalue','license_supportcontact','license_observation','license_usage'
      ];

  public function attachment()
  {
       return $this->hasMany('App\Models\AttachmentLicense');
  }

  public function brand()
  {
       return $this->belongsTo('App\Models\Brand');
  }

  public function area()
  {
       return $this->belongsTo('App\Models\Area');
  }

  public $timestamps = true;
}
