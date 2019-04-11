<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Domain extends Model
{
    protected $table = 'domains';
    protected $fillable = [
        'domain_name','domain_holder','domain_owner','domain_userlogin','domain_emaillogin',
        'domain_createdat','domain_expireat','domain_updatedat','domain_status','domain_expiraem', 'domain_observation','domain_password'
        ];

    public $timestamps = true;
}
