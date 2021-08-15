<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Category extends Model
{public $table = 'categories';
    use HasFactory;
    use SoftDeletes;
    // protected $fillable=['category_name','slug'];
    function subcategory()
    {
        return $this->hasMany(SubCategory::class,'category_id');
    }
}
