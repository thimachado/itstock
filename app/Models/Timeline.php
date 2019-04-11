<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Timeline extends Model
{
    protected $table = 'timelines';
    protected $fillable = [
        'timeline_user','timeline_body','timeline_date','timeline_hour'
        ];

    public $timestamps = true;
}
