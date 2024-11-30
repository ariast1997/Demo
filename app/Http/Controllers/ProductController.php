<?php

namespace App\Http\Controllers;


use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\FuncCall;
use RealRashid\SweetAlert\Facades\Alert;

class ProductController extends Controller
{
    //create products page
    public Function createPage(){
        $categories = Category::all();
        return view('admin.product.create',compact('categories'));
    }

    //create product
    public function create(Request $request){
        $this->validation($request,"create");
        $product = $this->getProducts( $request);


        if($request->hasFile('image')){

            $fileName = uniqid( ) . $request->file('image')->getClientOriginalName();
            $request->file('image')->move( public_path().'/product/' , $fileName);
            $product['image']   = $fileName;


        }

        Product::create($product);

        Alert::success('Success ', 'Created Successful');

        return back();

    }

    //Product list
    public function list($amt = 'default'){
        $product = Product::select('categories.name as category_name','products.id','products.name','products.image','products.price','products.stock')
        ->leftJoin('categories','products.category_id','categories.id')
        ->when(request('searchKey'),function($query){
            $query->whereAny(['products.name','categories.name'],'like','%'.request('searchKey').'%');
        });

        if( $amt != 'default'){
            $product= $product->where('stock','<=',5);
        }

        $product = $product -> orderBy('products.created_at','desc')->get();


        // dd($product->toArray());
        return view('admin.product.list',compact('product'));
    }

    //product update page
    public function updatePage($id){
        $categories = Category::get();
        $products = Product::where('id',$id)->first();

        return view('admin.product.updatePage',compact('products','categories'));

    }

    //update products
    public function update(Request $request){
        $this->validation($request,"update");
        $products = $this->getProducts($request);

        if($request->hasFile('image')){

            if(file_exists(public_path( 'product/'.$request->oldPhoto))){
                unlink(public_path('product/'.$request->oldPhoto));
            }
            $fileName = uniqid() . $request->file( 'image') ->getClientOriginalName();
            $request->file( 'image') ->move( public_path() . '/product/', $fileName );
            $products['image'] = $fileName;

        }else{
            $products['image'] = $request->oldPhoto;
        }

        Product::where ('id', $request->productId)->update ($products);
        Alert:: success ('Product Update', 'Product Update Successfully...');
        return to_route( 'product#list');


    }

    //delete products
    public function delete($id){
        Product::where('id',$id)->delete();

        Alert:: success ('Product Deleted', 'Product Delete Successfully...');
        return back();

    }

    //product detail
    public function detail($id){
        $data=Product::select('categories.name as category_name','products.name','products.image','products.price','products.stock')
        ->leftJoin('categories','products.category_id','categories.id')
        ->where('products.id',$id)
        ->orderBy('products.created_at')->first();

        return view('admin.product.detail',compact('data'));
    }


    //request data
    public function getProducts($request){
        return[
            'name' => $request->name,
            'image'=> $request->image,
            'price' => $request->price,
            'category_id' => $request->categoryId,
            'stock' => $request->stock,
            'description' => $request->description,
        ];

    }
    //validation
    public function validation($request,$action){
        $rules = [

            'name' => 'required|unique:products,name,'.$request->productId,
            'categoryId' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required',
            'description' => 'required',
        ];

        $rules['image'] = $action == 'create' ? 'required' : '';
        $messages = [];

        $request->validate($rules, $messages);
    }
}
