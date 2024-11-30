<?php

namespace App\Http\Controllers\User;

use App\Models\ActionLog;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Rating;
use App\Models\Comment;
use App\Models\Payment;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\PaymentHistory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;

class ProductController extends Controller
{
    //Product details
    public function details($id){
        $products = Product::select('products.id','products.name','products.price','products.stock as availabel_item','products.description','products.image','categories.name as category_name')
        ->leftJoin('categories','products.category_id','categories.id')
        ->where('products.id',$id)->first();

        $productList = Product::select('products.id','products.name','products.price','products.description','products.image','categories.name as category_name')
        ->leftJoin('categories','products.category_id','categories.id')
        ->where ('categories.name', $products['category_name'])
        ->where ('products.id','!=',$products['id'])
        ->get();

        $comment = Comment::select('comments.*','users.name as user_name','users.profile as user_profile')
        ->leftJoin('users', 'comments.user_id', 'users.id')
        ->where('comments.product_id',$id)
        ->orderBy('comments.created_at', 'desc')->get();

        $rating = Rating::where('product_id',$id)->avg('count');

        $user_rating = Rating::where( 'product_id',$id)->where( 'user_id' ,Auth::user()->id)->first('count');
        $user_rating = $user_rating = null ? 0 : $user_rating['count']; // 3

        // activity log
        $this->actionLogAdd(Auth::user()->id , $id , 'seen');

        //view count
        $view_count=ActionLog::where('post_id',$id)->where('action','seen')->get();
        $view_count=count($view_count);


        return view('user.home.detail',compact('products','productList','comment','rating','user_rating','view_count'));
    }

    //add to cart
    public function addToCart(Request $request){
        Cart::create([
            'user_id' => $request->userId ,
            'product_id' => $request->productId ,
            'qty' => $request->count,
        ]);

        $this->actionLogAdd($request->userId , $request->productId ,'addtoCart');


        Alert::success('Success ', 'Added to cart');

        return to_route('userHome');
    }

    //cart
    public function cart(){

        $cart = Cart:: select('products.id as product_id','carts.id as cart_id','products.image', 'products.name', 'products.price', 'carts.qty')
        ->leftJoin ('products', 'carts.product_id', 'products.id' )
        ->where('carts.user_id',Auth::user()->id)
        ->get() ;

        $total = 0;

        foreach ($cart as $item) {
            $total += $item->price * $item->qty;
        }

        return view('user.home.cart',compact('cart','total'));
    }

    //cart delete
    public function cartDelete(Request $request){
        $cartId = $request->cartId;
        Cart::where('id',$cartId)->delete();

        return response()->json([
        'status' => 'success',
        'message' => 'cart delete successfully',
        ], 200);
    }

    // http://localhost: 8000/user/product/list
    public function productList(){
        $product = Product::get();

        return response ( )->json($product,200);
    }

    public function cartTemp(Request $request){

        $orderArr = [];

        foreach ($request->all() as $item){
            array_push ($orderArr,[
                'user_id' => $item['user_id'],
                'product_id' => $item['product_id'] ,
                'count' => $item['qty'] ,
                'status' => 0 ,
                'order_code' => $item[ 'order_code'],
                'total_amount' => $item['total_amount'],
            ]);
        }

        Session::put('tempCart',$orderArr);

        return response()->json([
            'status' => 'success',
        ],200.);
    }

    public function deleteComment($id){
        Comment::where('id',$id)->delete();

        return back();
    }

    public function payment(){
        $payment = Payment:: orderBy( 'type', 'desc')->get();
        $orderProduct = Session:: get ( 'tempCart');

        return view( 'user.home.payment',compact('payment','orderProduct'));
    }

    public function order(Request $request){

        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'paymentType' => 'required',
            'payslipImage' => 'required',
        ]);

        // store payslip history
        $paymentHistoryData =[
            'user_name' => $request->name ,
            'phone' => $request->phone ,
            'address' => $request->address ,
            'payment_method' => $request->paymentType ,
            'order_code' => $request->orderCode ,
            'total_amt' => $request->totalAmount ,
        ];

        // dd($paymentHistoryData);

        if($request->hasFile('payslipImage')){
            $fileName = uniqid().$request->file('payslipImage')->getClientOriginalName();
            $request->file( 'payslipImage')->move(public_path() . '/payslip/' , $fileName );
            $paymentHistoryData['payslip_image'] = $fileName;

            PaymentHistory::Create($paymentHistoryData);

            //user order
            $orderProduct = Session::get('tempCart');

            // dd($orderProduct);

            foreach($orderProduct as $item){
                Order::Create([
                    'user_id' => $item['user_id'] ,
                    'product_id' => $item['product_id'],
                    'count' => $item['count'],
                    'status' => $item['status'], // 0 -> pending | 1 -> confirm | 2 -> reject
                    'order_code' => $item['order_code'],
                    'total_price' => $item['total_amount'],
                ]);

                Cart::where( 'user_id',$item['user_id'])->where('product_id',$item['product_id'])->delete();
            }

            return to_route( 'product#orderList');
        }
    }

    public function orderList(){
        $order = Order::where('user_id', Auth::user()->id)
                    ->groupBy('order_code')
                    ->orderBy( 'created_at', 'desc')
                    ->get();

        return view( 'user.home.orderList',compact('order'));
    }

    //customer comment
    public function comment(Request $request){
        Comment::create([
            'product_id' => $request->productId,
            'user_id' => Auth::user()->id,
            'message' => $request->comment,
        ]);

        $this->actionLogAdd(Auth::user()->id , $request->productId , 'comment');


        return back();
    }

    public function rating(Request $request){
    Rating::updateOrCreate([
        'user_id' => Auth::user()->id ,
        'product_id' => $request->productId ,
        ],[
            'count' => $request->productRating
        ]);

        $this->actionLogAdd(Auth::user()->id , $request->productId , 'rating');


        return back();
    }

    //action log process
    public function actionLogAdd($user_id, $product_id, $action){
        //activity logs
        ActionLog::create([
            'user_id' => $user_id,
            'post_id' => $product_id,
            'action' => 'seen'
        ]);
    }
}
