<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Cart;
class CartController extends Controller
{
    //

      public function showCart()
      {
         // $image_data= DB::table('images')->select('id','img_path','pro_ref')->get();
          //show cart
          $cart_data= Cart::content();
          //Cart::destroy();
           return view('cart_view',['cart_data' => $cart_data]);
      }

      public function addToCart(Request $request)
      {
           //using laravel shoping cart package
            //$product_id= 1;
            //$quantity= 1;

            $product_id= $request->input('invisible_id');
            $quantity= 1;
            
              
           $product= DB::table('product')->select('id', 'pro_name')->where('id','=',$product_id)->first();

           $price= DB::table('price')->select('id','price')->where('pro_price_ref', '=',$product_id)->first();

           $image= DB::table('images')->select('img_path')->where('pro_ref', '=' , $product_id)->first();

           Cart::add($product_id,$product->pro_name, $quantity,$price->price,['img_path' => $image->img_path]);

           //Cart::add($product_id, $product->pro_name, $quantity, $price->price,[]); //add product to cart

           return redirect()->back()->with('alert','Product Added To Cart Successsfully');
           
           

           
      }

      public function showProducts()
      {
     
        $category= DB::table('category')->select('id','cat_name')->get();
        $price= DB::table('price')->select('id', 'price')->get();

        $product = DB::table('product')
        ->join('category', 'product.cat_ref', '=', 'category.id')
        ->join('images', 'images.pro_ref', '=', 'product.id')
        ->join('price', 'price.pro_price_ref', '=' , 'product.id')
        ->get();

         return view('product_page',['product'=> $product, 'category' => $category , 'price' => $price]);
      }

      public function filterProducts(Request $request)
      {
            $category_id= $request->input('category');
            $price_id= $request->input('price');
  
            

            $category= DB::table('category')->select('id','cat_name')->get();
            $price= DB::table('price')->select('id', 'price')->get();


            if( $price_id > 0 && $category_id > 0)
            {
               $product = DB::table('product')
               ->join('category', 'product.cat_ref', '=', 'category.id')
               ->join('images', 'images.pro_ref', '=', 'product.id')
               ->join('price', 'price.pro_price_ref', '=' , 'product.id')
               ->where('category.id', '=',$category_id)
               ->where('price.id', '=',$price_id)
               ->get();

              // return redirect()->back()->with();
                //dd($product);

               return view('product_page',['product'=> $product, 'category' => $category , 'price' => $price]);
            }
            



      }
}
