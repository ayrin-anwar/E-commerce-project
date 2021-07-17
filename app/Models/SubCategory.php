<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class SubCategory extends Model
{public $table = 'subcategories';
    use HasFactory;
    use SoftDeletes;
    public function Category(){
        
        return $this->belongsTo(Category::class);
    }
    public function product(){
        
        return $this->hasOne(Category::class);
    }
}
