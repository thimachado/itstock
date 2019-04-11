<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    protected $table = 'certificates';
    protected $fillable = [
        'certificate_emitter','certificate_owner', 'certificate_type','certificate_value', 'certificate_expirationdate',
        'certificate_status','certificate_use','certificate_expiraem'
        ];

    public $timestamps = true;
}
