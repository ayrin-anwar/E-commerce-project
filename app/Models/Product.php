<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Product extends Model
{public $table = 'products';
    use HasFactory;
    use SoftDeletes;
    function subcategory()
    {
        return $this->belongsTo(SubCategory::class,'subcategory_id');
    }
    function attribute()
    {
        return $this->hasMany(Attributes::class,'product_id');
    }
}
