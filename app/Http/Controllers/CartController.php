<?php

namespace App\Http\Controllers;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Coupon;
use App\Models\Attributes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;
class CartController extends Controller
{
    function Cart($coupon_name=""){

    //    if($coupon_name!="")
    //    {
    //        return "abc";
    //    }

         if($coupon_name==""){
               $discount=0;
          }
          else{
              if(Coupon::where('coupon_name',$coupon_name)->exists())
              {
                $discount=Coupon::where('coupon_name',$coupon_name)->first()->coupon_limit;  
              }
              else{
                  return back()->with('coupon_error',"This coupon doesn't exist");
              }
            
          }
        //echo $coupon_name;
        $carts=Cart::where('cookie_id',Cookie::get('cookie_id'))->get();
        return view('frontend.cart',compact('carts','discount'));
    }
   
    function CartPost(Request $request){
        // return $request->all();
        // cookie('cookie_id',Str::random(8),$minutes);
        // return "Ok";
       
        if($request->hasCookie('cookie_id'))
        {
            $random_generated_cookie_id =$request->cookie('cookie_id');
        }
        else
        { $random_generated_cookie_id = time().Str::random(10);
            Cookie::queue('cookie_id',$random_generated_cookie_id,4320);
          
        }
        if(Cart::where('cookie_id',$random_generated_cookie_id)->where('product_id',$request->product_id)->where('color_id',$request->color_id)->where('size_id',$request->size_id)->exists())
        {
            Cart::where('cookie_id',$random_generated_cookie_id)->where('product_id',$request->product_id)->where('color_id',$request->color_id)->where('size_id',$request->size_id)->increment('quantity',$request->quantity);
        }
        else{
            $cart=new Cart;
            $cart->cookie_id=$random_generated_cookie_id;
            $cart->product_id=$request->product_id;
            $cart->color_id=$request->color_id;
            $cart->size_id=$request->size_id;
            $cart->quantity=$request->quantity;
            $cart->save();
        }
      
        return back()->with('success',"cart inserted successfully");
       
    }
}
