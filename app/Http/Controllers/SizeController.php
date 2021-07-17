<?php

namespace App\Http\Controllers;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class SizeController extends Controller
{
    function sizes()
    {    //$cats=Category::all();
        //$cats=Category::latest()->get();
        //$cats=Category::OrderBy('category_name','asc')->get();
       // $cats=Category::OrderBy('category_name','asc')->simplePaginate(3);
        return view('backend.size.size_view',[
            'sizes'=>Size::OrderBy('size_name','asc')->simplePaginate(3)
            ]);
         //return view('backend.Category.category_view',compact('cats'));
    }
    function addsize()
    {
        return view('backend.size.size_form');
    }
    function postsize(Request $request)
    {  //return $request->all();
        //return "OK";
        
        $request->validate(['size_name'=>'required|min:3|unique:sizes','slug'=>'required|unique:sizes',]);
        $sizes=new Size;
        $sizes->size_name=$request->size_name;
        $sizes->slug=str::slug($request->size_name);
        $sizes->save();
        return back()->with('success',"size inserted successfully");
        //return redirect('/categories');
    }
}
