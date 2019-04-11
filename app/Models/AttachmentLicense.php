<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttachmentLicense extends Model
{
      protected $table = 'attachment_licenses';
      protected $fillable = [
              'attachment_name','attachment_path','license_id'
          ];

      public function license()
      {
           return $this->belongsTo('App\Models\License');
      }
      public $timestamps = true;
}
