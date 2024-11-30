<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;


class CategoryController extends Controller
{

    //list page
    public function list(){
        $categories=Category::orderBy('created_at','desc')->paginate(5);
        return view('admin.category.list',compact('categories'));
    }

    //create
    public function create(Request $request){

        $this->checkvalidation($request);

        Category::create([
            'name' => $request->categoryName,
        ]);

        Alert::success('Successed', 'Created Successful');

        return back();
    }

    //delete
    public function delete($id){
        Category::find($id)->delete();

        Alert::success('Successed', 'Deleted Successful');

        return back();
    }

    //Update Page
    public function updatePage($id){

        $categories = Category::where('id',$id)->first();

        return view('admin.category.updatePage',compact('categories'));
    }

    // Update
    public function update($id,Request $request){

        $this->checkvalidation($request);

        Category::where('id',$id)->update([
            'name' => $request->categoryName,

        ]);

        Alert::success('Successed', 'Updated Successful');


        return to_route('list');
    }

    //check validation
    public function checkvalidation($request){

        $request->validate([
            'categoryName' => 'required',
        ],[
            //validation text you want to show

            'categoryName.required' => 'You need to fill Category Name',

        ]

        );
    }
}
