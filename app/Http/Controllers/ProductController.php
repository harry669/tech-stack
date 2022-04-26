<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    //

     public function addShow()
     {
         $category= DB::table('category')->select('id', 'cat_name')->get();
         return view('product_add',["category"=>$category]);
     }

     public function updateShow($id)
     {

        $product = DB::table('product')
        ->join('category', 'product.cat_ref', '=', 'category.id')
        ->join('images', 'images.pro_ref', '=', 'product.id')
        ->join('price', 'price.pro_price_ref', '=' , 'product.id')
        ->where('product.id', '=' , $id)
        ->first();

        $category= DB::table('category')->select('id', 'cat_name')->get();
         
        return view('product_update',["product"=>$product,"category"=>$category]);
     }

      //show admin view products
     public function showProducts()
     {
         $product = DB::table('product')
        ->join('category', 'product.cat_ref', '=', 'category.id')
        ->join('images', 'images.pro_ref', '=', 'product.id')
        ->join('price', 'price.pro_price_ref', '=' , 'product.id')
        ->get();

       
        
         
          return view('admin-product',['product'=>$product]);
     }


     public function addProduct(Request $request)
     {
         //add new product
         $validatedData = $request->validate([
            'pro_name' => 'required|max:255',
            'cat_ref' => 'required',
            'pro_path' => 'required|mimes:jpeg,png',
            'price' => 'required|numeric|min:1',
        ]);

        $pro_name= $request->input('pro_name');
        $price= $request->input('price');
        $cat_ref= $request->input('cat_ref');
        $file= $request->file('pro_path');
        $file_original_name= str_replace(' ', '-', $request->file('pro_path')->getClientOriginalName());


        $filename =  time().$file_original_name;

        $path = $file->storeAs('photos',$filename,'public');
        

        
        
        //added product and category ref into database
        DB::table('product')->insert(
            ['pro_name' => $pro_name, 'cat_ref' => $cat_ref]
        );


        $user = DB::table('product')->where( [['pro_name', $pro_name],['cat_ref',$cat_ref]])->first();


        DB::table('price')->insert([
            'price' => $price , 'pro_price_ref' => $user->id
          ]
          );

        //after successsful upload stored file  in database
        
         DB::table('images')->insert(
            ['img_path' => $filename, 'pro_ref'=> $user->id]
         );

         return redirect()->route('show-products')->with('alert', 'Product Added Successfully');
        

     }


     public function deleteProduct(Request $request)
     {

        $product_id=$request->invisible_id;
        
         
        //delete existing product
        DB::table('product')->where('id', $product_id)->delete();
        return redirect()->back()->with('alert', 'Product Deleted');
        

     }

     public function updateProduct(Request $request)
     {
          //update existing product

          $validatedData = $request->validate([
            'pro_name' => 'required|max:255',
            'cat_ref' => 'required',
            'pro_path' => 'required|mimes:jpeg,png',
            'price' => 'required|numeric|min:1',
        ]);

        $pro_name= $request->input('pro_name');
        $price= $request->input('price');
        $id= $request->input('invisible_id');
        $cat_ref= $request->input('cat_ref');
        $file= $request->file('pro_path');
        //$file_original_name= $request->file('pro_path')->getClientOriginalName();
        $file_original_name= str_replace(' ', '-', $request->file('pro_path')->getClientOriginalName());

        $filename =  time().$file_original_name;

        //find previous image and delete it
        $user = DB::table('images')->where( [['pro_ref', $id]])->first();
        //$filename =  $file_original_name.time() . '.' . $file->getClientOriginalExtension();

        $previous_image= $user->img_path;
        if(!is_null($previous_image))
        {
            Storage::delete('/public/photos/'.$previous_image);
            //dd($previous_image);        
        }

         
        $path = $file->storeAs('photos',$filename,'public');


        DB::table('product')
    ->updateOrInsert(
        ['id' => $id],
        ['cat_ref' => $cat_ref, 'pro_name' => $pro_name]
    );

    DB::table('images')
    ->updateOrInsert(
        ['pro_ref' => $id],
        ['img_path' => $filename]
    );

    DB::table('price')
    ->updateOrInsert(
        ['pro_price_ref' => $id],
        ['price' => $price]
    );

         /*
        //update database according to data
        DB::table('product')
        ->where('id', $id)
        ->update(['cat_ref' => $cat_ref],['pro_name' => $pro_name]);
        */

        //update image path also

          return redirect()->route('show-products')->with('alert', 'Product Updated Successfully');
          


     }
}
