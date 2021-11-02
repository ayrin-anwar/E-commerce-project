<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Product;
use App\Models\Color;
use App\Models\Size;
use App\Models\Attributes;
use App\Models\Gallery;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;


class ProductController extends Controller
{
    function products()
    {
        $products=Product::orderBy('created_at','desc')->paginate(3);
        return view('backend.product.product_view',compact('products'));
    }
    function addproduct()
    { 
        $cats=Category::all();
        $subcats=SubCategory::all();
        $colors=Color::all();
        $sizes=Size::all();
        $attr=Attributes::all();
        $gallery=Gallery::all();
        return view('backend.product.product_form',compact('cats','subcats','colors','sizes','attr','gallery'));
    }
    function postproduct(Request $request)
    { 
        //return $request->all();
        $request->validate([
       'title'=>'required|max:255|unique:products',
       'category_id'=>'required',
       'subcategory_id'=>'required',
       'thumbnail'=>'required|mimes:jpeg,jpg,png',
       
       'summary'=>'required|max:255',
       'description'=>'required|max:255',
      
       //'image_name'=>'required|mimes:jpeg,jpg,png',

    ]);
        $product=new Product;
        $product->title=$request->title;
        
        $slug = str::slug($request->title);
        $product->slug = $slug;
        $product->category_id=$request->category_id;
        $product->subcategory_id=$request->subcategory_id;
        $product->thumbnail='default.png';
        $product->summary=$request->summary;
        $product->description=$request->description;
        $product->save();
        //return $product->created_at;
        $path=public_path('thumb').'/'.$product->created_at->format('Y/m').'/'.$product->id.'/';
       
        File::makeDirectory($path,$mode=0777,true,true);
        if($request->hasFile('thumbnail'))
        {
            $image=$request->file('thumbnail');
            $ext=str::random(3).'-'.$slug.'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(50,50)->save($path. $ext,50);
            $product->thumbnail=$ext;
        }
        $product->save();
       
        foreach($request->color_id as $key=>$color)
        {
            $attr=new Attributes;
            $attr->product_id=$product->id;
            $attr->color_id=$color;
            $attr->size_id=$request->size_id[$key];
            $attr->quantity=$request->quantity[$key];
            $attr->price=$request->price[$key];
            $attr->sale_price=$request->sale_price[$key];
            $attr->save();

        }
        $path1=public_path('gallery').'/'.$product->created_at->format('Y/m/').$product->id.'/';
        File::makeDirectory($path1,$mode=0777,true,true);
        if($request->hasFile('image_name'))
        {
            $image1=$request->file('image_name');
            foreach($image1 as $key=>$value){
                $ext1=str::random(3).'-'.$slug.'.'.$image1[$key]->getClientOriginalExtension();
                Image::make($image1[$key])->resize(150,150)->save($path1.$ext1,50);
                $gallery=new Gallery;
                $gallery->image_name=$ext1;
                $gallery->product_id=$product->id;
                $gallery->save();
            }
           
        }
      
       
        return back()->with('success',"Product inserted successfully");
       
       
        
        
       
      
    }
    public function GetSubCat($id)                  // Here API 
    {
        $subcats = SubCategory::where('category_id', $id)->get();
        return response()->json($subcats);
    }
   
    public function editproduct($slug)
    {    $cats=Category::all();
        $subcats=SubCategory::all();
        $product=Product::where('slug',$slug)->first();
        $attr=Attributes::all();
       $colors=Color::all();
       $sizes=Size::all();
        return view('backend.product.product_edit', compact('product', 'cats', 'subcats','colors','sizes','attr'));
    }
   
    function updateproduct(Request $request)
    {
    $product = Product::findorFail($request->product_id);
    //return Product::where('slug','!=',$product->slug)->get();
    //return $product->slug;
        $product->title=$request->title;
        
        $slug = str::slug($request->title);
        $product->slug = $slug;
        $product->category_id=$request->category_id;
        $product->subcategory_id=$request->subcategory_id;
        $product->thumbnail='default.png';
        $product->summary=$request->summary;
        $product->description=$request->description;
        $product->save();
        $path=public_path('thumb').'/'.$product->created_at->format('Y/m').'/'.$product->id.'/';
       
        File::makeDirectory($path,$mode=0777,true,true);
        if($request->hasFile('thumbnail'))
        {
            $image=$request->file('thumbnail');
            $old_img = \public_path('thumb/') . $product->thumbnail;

            if (file_exists($old_img)) {
                unlink($old_img);
            }
            $ext=str::random(3).'-'.$slug.'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(50,50)->save($path. $ext,50);
            $product->thumbnail=$ext;
        }
        $product->save();
        foreach($request->attribute_id as $key=>$attribute_id)
        { 
           if($attribute_id!='')
           {
             $attribute=Attributes::findorFail($attribute_id);
             $attribute->product_id=$request->product_id;
             $attribute->color_id=$request->color_id[$key];
             $attribute->size_id=$request->size_id[$key];
            
             $attribute->quantity=$request->quantity[$key];
             $attribute->price=$request->price[$key];
             $attribute->sale_price=$request->sale_price[$key];
             $attribute->save();
           }
           else{
            $attrs=new Attributes;
            $attrs->product_id=$request->product_id;
            $attrs->color_id=$request->color_id[$key];
            $attrs->size_id=$request->size_id[$key];
            
            $attrs->quantity=$request->quantity[$key];
            $attrs->price=$request->price[$key];
            $attrs->sale_price=$request->sale_price[$key];
            $attrs->save();
           }
         }
         $path1=public_path('gallery').'/'.$product->created_at->format('Y/m/').$product->id.'/';
         File::makeDirectory($path1,$mode=0777,true,true);
         if($request->hasFile('image_name'))
         {
             $image1=$request->file('image_name');
             foreach($image1 as $key=>$value){
                 $ext1=str::random(3).'-'.$slug.'.'.$image1[$key]->getClientOriginalExtension();
                 Image::make($image1[$key])->resize(150,150)->save($path1.$ext1,50);
                 $gallery=new Gallery;
                 $gallery->image_name=$ext1;
                 $gallery->product_id=$product->id;
                 $gallery->save();
             }
            
         }
        return back()->with('success',"Product updated successfully");
      
    }
    function trashproduct()
    {
        $products=Product::onlyTrashed('deleted','desc')->paginate(2);
        return view("backend.product.trashed_product",compact('products'));
    }
    function restoreproduct($id)
    {
        $products=Product::onlyTrashed()->findorFail($id)->restore();
        return back()->with('success',"Product restored successfully");
    }
    function permanentdeleteproduct($id)
    {
       $products=Product::onlyTrashed()->findorFail($id)->forcedelete();
       return back()->with('success',"Category permanently deleted successfully");
    }
    function deleteproduct($slug)
    {
        $products=Product::where('slug',$slug)->first()->delete();
        return back()->with('success',"Category deleted successfully");
    }
   
}
