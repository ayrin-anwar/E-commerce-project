<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class SubCategory extends Model
{public $table = 'subcategories';
    use HasFactory;
    use SoftDeletes;
    public function category(){
        
        return $this->belongsTo(Category::class,'category_id', 'id');
    }
    public function product(){
        
        return $this->hasMany(Product::class,'subcategory_id');
    }
}
