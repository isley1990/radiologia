<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\FilterByUser;

class Plantilla extends Model
{
    protected $fillable = ['id','nombre','detalle'];

/*     public function getFullNameAttribute()
{
    return $this->nombre . ' ' . $this->detalle;
} */
}
