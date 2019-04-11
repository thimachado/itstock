<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reseller extends Model
{
    protected $table = 'resellers';
    protected $fillable = [
        'reseller_name', 'reseller_site','reseller_email',
        ];

    public $timestamps = false;
}
