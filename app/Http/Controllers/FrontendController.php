<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Attributes;
use App\Models\Gallery;
use App\Models\Color;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    function frontend()
    {$latests=Product::latest()->limit(30)->get();
        return view('frontend.main',compact('latests'));
    }
    function contact()
    {    $var="Contact Page";
        return view('contact',['var'=>$var,]);
    }
    function about()
    {    $var="About Page";
        return view('about',['var'=>$var,]);
    }
    function productDetails($slug){
        //return "Ok";
        $products=Product::where('slug',$slug)->first();
       
        $galleries=Gallery::where('product_id',$products->id)->get();
        $attributes=Attributes::where('product_id',$products->id)->get();
        $collection=collect($attributes);
        $colors=$collection->groupBy('color_id');
       
        return view('frontend.productDetails',compact('products','galleries','colors'));
    }
    function GetColorSize($c_id,$p_id)
    {
        //return $c_id.'='.$p_id;
        $output='';
        $sizes=Attributes::with(['product','color','size'])->where('product_id',$p_id)->where('color_id',$c_id)->get();
         foreach($sizes as $key=>$size)
         {
           $output=$output.'<input type="radio" data-quantity="'.$size->quantity.'" data-price="'.$size->price.'"id="size" class="sizecheck" name="size_id" value="'.$size->size_id.'">
           <label for="size">'.$size->size_id.'</label>';
        }
        echo $output;
        //return response()->json($sizes);
    }
}
