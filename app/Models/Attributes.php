<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Attributes extends Model
{public $table = 'attributes';
    use HasFactory;
    use SoftDeletes;
    function product()
    {
        return $this->belongsTo(Product::class,'product_id');
    }
    function color()
    {
        return $this->belongsTo(Color::class,'color_id');
    }
   function size(){
       return $this->belongsTo(Size::class,'size_id');
   }


}
