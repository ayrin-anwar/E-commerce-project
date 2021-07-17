<?php

namespace App\Http\Controllers;
use App\Models\Color;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class ColorController extends Controller
{
    function colors()
    {    //$cats=Category::all();
        //$cats=Category::latest()->get();
        //$cats=Category::OrderBy('category_name','asc')->get();
       // $cats=Category::OrderBy('category_name','asc')->simplePaginate(3);
        return view('backend.Color.color_view',[
            'colors'=>Color::OrderBy('color_name','asc')->simplePaginate(3)
            ]);
         //return view('backend.Category.category_view',compact('cats'));
    }
    function addcolor()
    {
        return view('backend.Color.color_form');
    }
    function postcolor(Request $request)
    {  //return $request->all();
        //return "OK";
        
        $request->validate(['color_name'=>'required|min:3|unique:colors','slug'=>'required|unique:colors',]);
        $colors=new Color;
        $colors->color_name=$request->color_name;
        $colors->slug=str::slug($request->color_name);
        $colors->save();
        return back()->with('success',"color inserted successfully");
        //return redirect('/categories');
    }
}
