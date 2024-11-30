<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    //direction to home page

    public function userHome(){

        $categories = Category::get();

        // if( request('sortingType')){
        //     dd(explode("," , request('sortingType')));
        // }

        $products = Product::select('categories.name as category_name','products.id','products.name','products.image','products.price','products.description')
        ->leftJoin('categories','products.category_id','categories.id')
        ->when(request('searchKey'),function($query){//search by name
            $query = $query->whereAny(['products.name'],'like','%'.request('searchKey').'%');
        })
        ->when(request('sortingType'),function($query){//sort by
            $sortRule = explode("," , request('sortingType')) ;
            $sortName = 'products.'.$sortRule[0];
            $sortBy = $sortRule[1];
            $query = $query->orderBy($sortName,$sortBy);
        })
        ->when (request('categoryId'), function ($query) {//Search by category
            $query->where ('products.category_id' , request('categoryId'));
        })
        ->when(request('minPrice') != null && request('maxPrice') !=null,function($query){//Price Between
            $query = $query->whereBetween('products.price',[request('minPrice'),request('maxPrice')]);
        })
        ->when(request('minPrice') != null && request('maxPrice') == null,function($query){//miniPrice
            $query = $query->where('products.price','>=',request('minPrice'));
        })
        ->when(request('minPrice') == null && request('maxPrice') != null,function($query){//maxPrice
            $query = $query->where('products.price','<=',request('maxPrice'));
        })

        // ->orderBy('products.created_at','desc')
        ->paginate(15);


        // dd(request()->toArray());
        return view('user.home.list',compact('products','categories'));
    }

    //edit page
    public function updateProfile(){
        return view('user.home.editPage');
    }

    //update
    public function update(Request $request){
        $this->checkValidation($request);
        $data= $this->getData($request);

        if($request->hasFile('image')){

            //delete old image
            if(Auth::user()->profile != null ){
                if(file_exists(public_path('profile/'.Auth::user()->profile))){
                    unlink(public_path('profile/'.Auth::user()->profile));
                }
            }


            //store image
            $filename = uniqid() . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('').'/profile/', $filename);

            $data['profile'] = $filename;
        }
        else{
            $data['profile'] = Auth::user()->image;
        }
        User::where('id',Auth::user()->id)->update($data);

        Alert::success('Success ', 'Updated Successful');

        return to_route('userHome');

    }

    //update data
    public function getData($request){
        return[
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
        ];
    }

    //change password page
    public function passwordPage(){
        return view('user.home.changePassword');
    }
    public function changePassword(Request $request){
        $this->passwordValidationCheck($request);

        $currentPassword = auth()->user()->password;
        if(Hash::check($request->oldPassword, $currentPassword)){
            User::where('id',auth()->user()->id)->update([
                'password' => Hash::make($request->newPassword),
            ]);
        }

        Alert::success('Success ', 'Changed Successful');

        return to_route('userHome');
    }

    private function checkValidation($request){
        $request->validate([
            'name' => 'required',
            'email'=> 'required|unique:users,email,'.Auth::user()->id,
            'phone'=> 'required | unique:users,phone,'.Auth::user()->id,
            'address' => 'required',

        ]);
    }

    //password validation
    private function passwordValidationCheck($request){
        $request->validate([
            'oldPassword' => 'required',
            'newPassword' => 'required',
            'confirmPassword' => 'required | same:newPassword',
        ]);
    }

    public function shop(){
        return view('user.home.shop');
    }

    public function shopDetail(){
        return view('user.home.shop-detail');
    }
}
