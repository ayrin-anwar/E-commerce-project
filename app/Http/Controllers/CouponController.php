<?php

namespace App\Http\Controllers;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    function coupons()
    {    //$cats=Category::all();
        //$cats=Category::latest()->get();
        //$cats=Category::OrderBy('category_name','asc')->get();
       // $cats=Category::OrderBy('category_name','asc')->simplePaginate(3);
        return view('backend.coupon.coupon_view',[
            'coupons'=>Coupon::OrderBy('coupon_name','asc')->simplePaginate(3)
            ]);
         //return view('backend.Category.category_view',compact('cats'));
    }
    function addcoupon()
    {
        return view('backend.coupon.coupon_form');
    }
    function postcoupon(Request $request)
    {  //return $request->all();
        //return "OK";
        
        $request->validate([
            'coupon_name' => 'required | unique:coupons,coupon_name',
            'coupon_amount' => 'required|numeric|between:1,1000',
            'coupon_validity' => 'required|date',
            'coupon_limit' => 'required|numeric|between:1,99',
        ]);
        $coupon=new Coupon;
        $coupon->coupon_name=$request->coupon_name;
        $coupon->coupon_amount=$request->coupon_amount;
        $coupon->coupon_validity=$request->coupon_validity;
        $coupon->coupon_limit=$request->coupon_limit;
        $coupon->save();
        return back()->with('success',"category inserted successfully");
        //return redirect('/categories');
    }
    function deletecoupon($id)
    {
       
       $cat=Coupon::findorFail($id);
       $cat->delete();
        
        
    }
    function editcoupon($data)
    {
        return view('backend.coupon.coupon_edit',['coupon'=>Coupon::findorFail($data)],);
        // $cat=Category::findorFail($request->cat_id);
        // $cat->category_name=$request->category_name;
        // $cat->slug=str::slug($request->category_name);
        // $cat->save();
        // return back()->with('success','Category updated successfully');
    }
    function updatecoupon(Request $request)
    { 
       
        
        $coupon=Coupon::findorFail($request->id);
        //return $cat->count();
        $coupon->coupon_name=$request->coupon_name;
        $coupon->coupon_amount=$request->coupon_amount;
        $coupon->coupon_validity=$request->coupon_validity;
        $coupon->coupon_limit=$request->coupon_limit;
        
        $coupon->save();
        return back()->with('success',"Coupon updated successfully");
    }
    function trashcoupon()
    {
        $coupons=Coupon::onlyTrashed('deleted','desc')->paginate(2);
        return view("backend.coupon.trashed_coupon",compact('coupons'));
    }
    function restorecoupon($id)
    {
        $coupons=Coupon::onlyTrashed()->findorFail($id)->restore();
        return back()->with('success',"Category restored successfully");
    }
    function permanentdeletecoupon($id)
    {
       $coupons=Coupon::onlyTrashed()->findorFail($id)->forcedelete();
       return back()->with('success',"Category deleted successfully");
    }
}
