<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    protected $table = 'attachments';
    protected $fillable = [
            'attachment_name','attachment_path','contract_id'
        ];
 
    public function contract()
    {
         return $this->belongsTo('App\Models\Contract');
    }


    public $timestamps = true;
}
