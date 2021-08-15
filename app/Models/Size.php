<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Size extends Model
{public $table = 'sizes';
    use HasFactory;
    use SoftDeletes;
    function attribute(){
        return $this->hasMany(Attributes::class,'size_id');
    }
}
