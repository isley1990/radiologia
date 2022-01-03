<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\FilterByUser;

class Examenes extends Model
{
    protected $fillable = ['id','detalle'];

/*     public function getFullNameAttribute()
{
    return $this->nombre . ' ' . $this->detalle;
} */
}
