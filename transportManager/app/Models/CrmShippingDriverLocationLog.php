<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CrmShippingDriverLocationLog extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function shipping()
    {
        return $this->belongsTo(CrmShipping::class, 'crm_shipping_id');
    }

    
}
