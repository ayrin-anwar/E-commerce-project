<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Product;
use Illuminate\Support\Str;

class SubCategoryController extends Controller
{
    function subcategories()
    {
        $subcats=SubCategory::with('category')->paginate(3);
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
        foreach($request->delete as $delete){
           $p=Product::where('subcategory_id',$delete)->count();
           echo $p;
            if($p<1)
            {  echo "NO";
                //Product::where('subcategory_id',$delete)->firstOrFail()->delete();
                SubCategory::findOrFail($delete)->delete();
                
                return redirect('subcategories');
               
            }
            else
            {
                return redirect('subcategories')->with('error',"Subcategories can't be deleted");
            }
          
           
        }
    }
        // foreach($request->delete as $delete)
        // {
        //     SubCategory::findOrFail($delete)->delete();
            
        // }
        // return back();
        // foreach($request->input('subcategory_id', []) as $key => $subcat_id)
        // {
        //     $p=Product::where('subcategory_id',$subcat_id)->count();
        //     if($p<1)
        //     {
        //         Product::whereIn('subcategory_id',explode(",",$ids))->delete();
               
        //     }
        //     else{
        //         return redirect('subcategories')->with('error',"Subcategories can't be deleted");
        //     }
        //     SubCategory::findOrFail($subcat_id)->delete();
        // }
        // $ids = $request->ids;
        // Product::whereIn('subcategory_id',explode(",",$ids))->delete();
        // return response()->json(['status'=>true,'message'=>"Category deleted successfully."]);
         
    
 


		
    //  foreach($request->input('subcategory_id', []) as $key => $subcat_id)
    //  {

    //     $p=Product::where('subcategory_id',$subcat_id)->count();
    //               if($p<1)
    //               {
                      
    //                   Product::whereIn('subcategory_id', $subcat_id)->delete();
    //               }
    //               else{
    //                 return redirect('subcategories')->with('error',"Subcategories can't be deleted");
    //               }
    //               SubCategory::findOrFail($subcat_id)->delete();
    //  } 
    // //   foreach($request->input('subcategory_id', []) as $key => $subcat_id) {
    // //          $p=Product::where('subcategory_id',$subcat_id)->count();
    // //           if($p<1)
    // //           {
    // //               $p->delete();
    // //           }
    // //           else{
    // //             return redirect('subcategories')->with('error',"Subcategories can't be deleted");
    // //           }
    // //           SubCategory::findOrFail($subcat_id)->delete();





    //   }


    
    function deletesubcategory($id){
        //return "Ok";
        //return $id;
        $subcat=SubCategory::findorFail($id);
        if($subcat->product->count()<1)
        {
            $cat=SubCategory::findorFail($id)->delete();
            return redirect('subcategories')->with('success',"Subcategory deleted successfully");
            
        }
        else{
            return redirect('subcategories')->with('error',"Subcategories can't be deleted");
        }
        
    }
    function trashsubcategory()
    {
        $subcats=SubCategory::onlyTrashed('deleted','desc')->paginate(2);
        return view("backend.subcategory.trashed_subcategory",compact('subcats'));
    }
    function restoresubcategory($id)
    {
        $subcats=SubCategory::onlyTrashed()->findorFail($id)->restore();
        return back()->with('success',"Product restored successfully");
    }
    function permanentdeletesubcategory($id)
    {
       $subcats=SubCategory::onlyTrashed()->findorFail($id)->forcedelete();
       return back()->with('success',"Category permanently deleted successfully");
    }
}
