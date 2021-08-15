<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Product extends Model
{public $table = 'products';
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
       
        'title',
        'thumbnail',
        'summary',
        'description',
       
    ];
    function subcategory()
    {
        return $this->belongsTo(SubCategory::class,'subcategory_id');
    }
    function category(){
        return $this->belongsTo(Category::class,'category_id');
    }
    function color()
    {
        return $this->belongsTo(Color::class,'color_id'); 
    }
    function attribute()
    {
        return $this->hasMany(Attributes::class,'product_id');
    }
}
