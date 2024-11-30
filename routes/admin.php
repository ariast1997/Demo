<?php

use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ProfileController;

Route::group(['prefix' => 'admin','middleware' => 'admin'],function(){

    Route::get('home',[AdminController::class,'adminHome'])->name('adminHome');

    Route::get('contact',[AdminController::class,'adminContact'])->name('adminContact');

    //category
    Route::group(['prefix' => 'category'],function(){

        Route::get('list',[CategoryController::class,'list'])->name('list');

        //create category
        Route::post('create',[CategoryController::class,'create'])->name('category#create');

        Route::get('delete/{id}',[CategoryController::class,'delete'])->name('category#delete');

        Route::get('updatePage/{id}',[CategoryController::class,'updatePage'])->name('Cat#updatePage');
        Route::post('update/{id}',[CategoryController::class,'update'])->name('category#update');

    });

    //Profile

    Route::group(['prefix' => 'profile'],function(){

        Route::get('changePassword',[ProfileController::class,'changePasswordPage'])->name('change#password#page');
        Route::post('change',[ProfileController::class,'changePassword'])->name('change#Password');

        Route::get('profile',[ProfileController::class,'accountProfile'])->name('account#profile');

        Route::get('editProfile',[ProfileController::class,'edit'])->name('edit#Profile');
        Route::post('editUpdate',[ProfileController::class,'updateProfile'])->name('edit#update');

        Route::group(['middleware' => 'superadmin'],function(){

            //add admin
            Route::get('add/newAdminPage',[ProfileController::class,'add'])->name('add#adminPage');
            Route::post('add/newAdmin',[ProfileController::class,'addAccount'])->name('add#admin');

            //admin list
            Route::get('admin/list',[ProfileController::class,'list'])->name('admin#list');
            //delete admin
            Route::get('admin/delete/{id}',[ProfileController::class,'delete'])->name('delete#admin');

            //payment
            Route::get('paymentPage',[PaymentController::class,'payment'])->name('payment');
            Route::post('createPayment',[PaymentController::class,'create'])->name('create#payment');

            // edit payment
            Route::get('editPayment/{id}',[PaymentController::class,'editPage'])->name('edit#payment');
            Route::post('updatePayment',[PaymentController::class,'update'])->name('update#payment');

            Route::get('delete/{id}',[PaymentController::class,'deletePayment'])->name('delete#payment');

            //user list
            Route::get('user/list',[ProfileController::class,'userList'])->name('user#list');
            //delete user
            Route::get('user/delete/{id}',[ProfileController::class,'delete'])->name('delete#user');
        });
    });

    //Products
    Route::group(['prefix' => 'product'],function(){

        Route::get('createPage',[ProductController::class,'createPage'])->name('product#createPage');
        Route::post('create',[ProductController::class,'create'])->name('porduct#create');

        //list
        Route::get('list/{amt?}',[ProductController::class,'list'])->name('product#list');
        Route::get('updatePage/{id}',[ProductController::class,'updatePage'])->name('update#page');
        Route::post('update',[ProductController::class,'update'])->name('product#update');
        Route::get('delete/{id}',[ProductController::class,'delete'])->name('product#delete');
        Route::get('detail/{id}',[ProductController::class,'detail'])->name('product#detail');
    });

    //Products
    Route::group(['prefix' => 'order'],function(){
        Route::get('list',[OrderController::class,'list'])->name('order#list');
        Route::get('details/{orderCode}', [OrderController::class, 'details'])->name('order#details');

        Route::get('changeStatus', [OrderController::class,'changeStatus'])->name ('order#changeStatus');
        Route::get('confirmOrder',[OrderController::class,'confirmOrder'])->name('order#confirmOrder');

        Route::get('rejectOrder',[OrderController::class,'rejectOrder'])->name('order#rejectOrder');

    });


});
