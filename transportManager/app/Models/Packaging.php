<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Packaging extends Model
{
    use HasFactory;
    protected $guarded=[],$hidden=['deleted_at','created_at','updated_at'];

    public function transportationCode(): MorphOne
    {
        return $this->morphOne(TransportationCode::class, 'recordable');
    }

}
