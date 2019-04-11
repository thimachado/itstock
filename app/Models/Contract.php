<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
   
    protected $table = 'contracts';
    protected $fillable = [
            'contract_number','contract_internal','reseller_id','contract_title','contractcategory_id',
            'contract_type','contract_startdate','contract_expirationdate','contract_warningdate','contract_paytype',
            'contract_totalvalue','contract_qtdparcelas','contract_ultimaparcela','contract_objectdescription',
            'contract_releasedescription','contract_area','index_id','contract_indexpercentage','contract_anualreadjust','expirated_at', 'contract_status'
        ];

    public function contractcategory()
    {
         return $this->belongsTo('App\Models\ContractCategory');
    }
    public function attachment()
    {
         return $this->hasMany('App\Models\Attachment');
    }
    public function indexreadjustment()
    {
         return $this->belongsTo('App\Models\IndexReadjust');
    }

    public $timestamps = true;  
}
