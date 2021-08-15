<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Support\Str;
class CategoryController extends Controller
{
    function categories()
    {    //$cats=Category::all();
        //$cats=Category::latest()->get();
        //$cats=Category::OrderBy('category_name','asc')->get();
       // $cats=Category::OrderBy('category_name','asc')->simplePaginate(3);
        return view('backend.Category.category_view',[
            'cats'=>Category::OrderBy('category_name','asc')->simplePaginate(3)
            ]);
         //return view('backend.Category.category_view',compact('cats'));
    }
    function addcategory()
    {
        return view('backend.Category.category_form');
    }
    function postcategory(Request $request)
    {  //return $request->all();
        //return "OK";
        
        $request->validate(['category_name'=>'required|min:3|unique:categories','slug'=>'required|unique:categories',]);
        $cat=new Category;
        $cat->category_name=$request->category_name;
        $cat->slug=str::slug($request->category_name);
        $cat->save();
        return back()->with('success',"category inserted successfully");
        //return redirect('/categories');
    }
    function deletecategory($data)
    {
       
       $cat=Category::findorFail($data);
        if($cat->subcategory->count()<1)
        {
            $cat=Category::findorFail($data)->delete();
            return back()->with('success',"Category deleted successfully");
        }
        else{
            return redirect('categories')->with('error',"Categories can't be deleted");
        }
        
    }
    function editcategory($data)
    {
        return view('backend.Category.category_edit',['cat'=>Category::findorFail($data)],);
        // $cat=Category::findorFail($request->cat_id);
        // $cat->category_name=$request->category_name;
        // $cat->slug=str::slug($request->category_name);
        // $cat->save();
        // return back()->with('success','Category updated successfully');
    }
    function updatecategory(Request $request)
    { $cat=Category::findorFail($request->cat_id);
        //return $cat->count();
        $cat->category_name=$request->category_name;
        $cat->slug=str::slug($request->category_name);
        $cat->save();
        return back()->with('success',"Category updated successfully");
    }
    function trashcategory()
    {
        $cats=Category::onlyTrashed('deleted','desc')->paginate(2);
        return view("backend.Category.trashed",compact('cats'));
    }
    function restorecategory($id)
    {
        $cats=Category::onlyTrashed()->findorFail($id)->restore();
        return back()->with('success',"Category restored successfully");
    }
    function permanentdeletecategory($id)
    {
       $cats=Category::onlyTrashed()->findorFail($id)->forcedelete();
       return back()->with('success',"Category deleted successfully");
    }
    // function permanentdeletecategory(Request $request, $id)
    // {
    //     // $cat=Category::onlyTrashed()->findorFail($request->cat_id);
    //     // return $cat;
    //     if(Auth::check())
    //     {
    //         if(Hash::check(Auth::user()->password,$request->password))
    //         {$cat=Category::onlyTrashed()->findorFail($request->cat_id);
    //             // return $cat;
    //             session('cat_id','Yes');
    //             return back()->with('success',"Category restored successfully");

    //         }
    //         else{
    //             return "Failed";
    //         }
    //     }
    // }
}
