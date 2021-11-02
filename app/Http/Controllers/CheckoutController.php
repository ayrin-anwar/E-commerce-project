<?php

namespace App\Http\Controllers;
use App\Http\Requests\CheckoutForm;
use Illuminate\Http\Request;
use Khsing\World\World;
use Khsing\World\Models\Country;
use Carbon\Carbon;
use App\Models\Order_detail;
use App\Models\Attributes;
use App\Models\Billing_Detail;
use App\Models\Order_summary;
use App\Models\Cart;

class CheckoutController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
        $this->middleware('iscustomer');
    }
    function checkout()
    {
        return view('frontend.checkout',['countries'=>World::Countries()]);
    }
    function getcitylist($country_code)
    {
        // $options="<option value=''>--select--</option>";
        $citylist=Country::getByCode($country_code);
        


       

        
       
        
         $cities = $citylist->children();
         $options="";
        foreach($cities as $city)
        {
            $options=$options."<option value='". $city->id."'>".$city->name."</option>";
            
        }
        // echo $options;
        return response()->json($options);
        
    }
    function checkoutpost(CheckoutForm $request)
    { //return $request;
        $billing_detail=Billing_Detail::create($request->except('_token','country')+['user_id'=>Auth::id(),
           'country'=> World::getByCode($request->country)->name
        ]);
        return $billing_datail->id;
        $order_summary_id=Order_summary::insert([
            'billing_detail_id'=>$billing_datail->id(),
            'coupon_name'=>session('s_coupon_name'),
            'total'=>session('s_total'),
            'discount'=>session('s_discount'),
            'subtotal'=>session('s_stotal'),
            'shipping'=>session('s_shipping'),
            'created_at'=>Carbon::now()
        ]);
        //return $order_summary_id;
        foreach(Cart::where('cookie_id',Cookie::get('cookie_id'))->get() as $cart)
        {
           Order_detail::insert([
             'order_summary_id'=>$order_summary_id,
             'product_id'=>$cart->product_id,
             'color_id'=>$cart->color_id,
             'size_id'=>$cart->size_id,
             'quantity'=>$cart->quantity,
             'created_at'=>Carbon::now()
           ]);
           Attribute::where([
            'product_id'=>$cart->product_id,
            'color_id'=>$cart->color_id,
            'size_id'=>$cart->size_id
           ])->decrement('quantity',$cart->quantity);
            $cart->delete();
        }
        // return done;
        if(session('s_coupon_name'))
        {
            Coupon::where('coupon_name',session('s_coupon_name'))->decrement('coupon-limit',1);
           //echo "coupon ase";
        }
        else
        {
            echo"coupon nai";
        }
        print_r(session('s_total'));
        print_r(session('s_discount'));
        print_r(session('s_stotal'));
        print_r(session('s_shipping'));
        print_r(session('s_coupon_name'));
        
        return redirect();






    } 
}
