<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

//Cart 
Route::post('/user-add-cart','CartController@addToCart')->name('add-to-cart');

Route::get('/user-view','CartController@showProducts')->name('user-view');

Route::get('/user-cart-view','CartController@showCart')->name('user-cart-view');

Route::get('/filter-products','CartController@filterProducts')->name('filter-products');

//Product Add View Page
Route::get('/admin-add-product','ProductController@addShow')->name('add-show');

//Product Update View Page
Route::get('/admin-update-product/{id}','ProductController@updateShow')->name('update-show');


//Admin Product View Page
Route::get('/admin-view-product','ProductController@showProducts')->name('show-products');


Route::get('/home', 'HomeController@index')->name('home');

Route::post('/add-product', 'ProductController@addProduct')->name('add-product');

Route::post('/delete-product', 'ProductController@deleteProduct')->name('delete-product');

Route::post('/update-product', 'ProductController@updateProduct')->name('update-product');

Route::get('/cart','Cartcontroller@showCart');


