<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Support\Str;

class SubCategoryController extends Controller
{
    function subcategories()
    {
        $subcats=SubCategory::paginate(3);
        return view('backend.subcategory.subcategory_view',compact('subcats'));
    }
    function addcategory()
    {  
        $cats=Category::orderBy('category_name','asc')->get();
        return view('backend.subcategory.subcategory_form',compact('cats'));
    }
    function postsubcategory(Request $request)
    {  //return $request->all();
        //return "OK";
        
        $request->validate(['subcategory_name'=>'required|min:3|unique:subcategories','slug'=>'required|unique:subcategories', 'category_id' => 'required',]);
        $cat=new SubCategory;
        $cat->subcategory_name=$request->subcategory_name;
        $cat->slug=str::slug($request->subcategory_name);
        $cat->category_id=$request->category_id;
        $cat->save();
        return redirect('/subcategories');
    }
    function allsubcategorydelete(Request $request)
    {
        foreach($request->delete as $delete)
        {
            SubCategory::findOrFail($delete)->delete();
            
        }
        return back();
    }
}
