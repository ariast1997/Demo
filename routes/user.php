<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\User\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;

Route::group(['prefix' => 'user','middleware' => 'user'],function(){
    Route::get('home',[UserController::class,'userHome'])->name('userHome');
    Route::get('contactPage',[ContactController::class,'contactPage'])->name('contact#page');
    Route::post('contact',[ContactController::class,'contact'])->name('contact');

    Route::get('shop',[UserController::class,'shop'])->name('shop');
    Route::get('shopDetail',[UserController::class,'shopDetail'])->name('shop#detail');

    Route::get('editProfile',[UserController::class,'updateProfile'])->name('editProfile');
    Route::post('update',[UserController::class,'update'])->name('update');

    Route::get('changePassword/page',[UserController::class,'passwordPage'])->name('change#passwordPage');
    Route::post('changePassword',[UserController::class,'changePassword'])->name('change#password');


    Route::get('product/details/{id}',[ProductController::class,'details'])->name('product#details');

    Route::post('addToCart',[ProductController::class,'addToCart'])->name('product#addToCart');
    Route::get('cart',[ProductController::class,'cart'])->name('product#cart');

    //api
    Route:: get( 'cart/delete', [ProductController:: class,'cartDelete'])->name( 'product#cartDelete');

    Route:: get('product/list', [ProductController:: class,'productList'])->name('product#cartList');

    Route:: get ('cart/temp', [ProductController:: class, 'cartTemp'])->name ( 'product#cartTemp');

    Route:: get( 'payment', [ProductController::class,'payment'])->name('payment');

    Route::post('order',[ProductController::class,'order'])->name('product#order');
    Route::get('orderList',[ProductController::class,'orderList'])->name('product#orderList');

    Route::post('comment',[ProductController::class,'comment'])->name('product#comment');
    Route::get('comment/delete/{id}',[ProductController::class,'deleteComment'])->name('delete#comment');

    Route::post('rating',[ProductController::class,'rating'])->name('product#rating');



});
