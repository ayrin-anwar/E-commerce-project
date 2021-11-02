<?php
use App\Models\Atrribute;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Cookie;
   function cart_total_product()
   {
    return App\Models\Cart::where('cookie_id',Cookie::get('cookie_id'))->count();
   }
   function cart_products(){
    return App\Models\Cart::where('cookie_id',Cookie::get('cookie_id'))->get(); 
   }
   function discount_amount($totalPrice, $discount)
   {
      return ($totalPrice * $discount)/100;
    
   }
   function discount_amount1($totalPrice, $discount)
   {
      return $totalPrice-($totalPrice * $discount)/100;
    
   }
?>