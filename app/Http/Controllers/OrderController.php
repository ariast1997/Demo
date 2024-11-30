<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\PaymentHistory;
use App\Models\Product;

class OrderController extends Controller
{
    //Order List
    public function list(){
        $order = Order::select('orders.id','orders.status', 'orders.order_code', 'orders.created_at', 'users.name as user_name')
        ->leftJoin('users', 'orders.user_id', 'users.id')
        ->orderBy('created_at','desc')
        ->groupBy('order_code')
        ->get();
        // dd($order->toArray());
        return view('admin.order.list',compact('order'));
    }

    //Order Details
    public function details ($orderCode){
        $order = Order::select('orders.count as order_count', 'orders.order_code as order_code','orders.created_at as created_at','products.id as product_id','products.name as product_name', 'products.price as product_price','products.stock as available_stock', 'products.image as product_image','users.name as user_name', 'users.nickname as user_nickname', 'users.phone as user_phone', 'users.email as user_email')
                        ->leftJoin ('products', 'orders.product_id', 'products.id' )
                        ->leftJoin( 'users', 'orders.user_id', 'users.id')
                        ->where ('orders.order_code', $orderCode)
                        ->get ();

        $payslipData = PaymentHistory::where( 'order_code',$orderCode)->first();

        $confirmStatus = [];
        $status = true ;

        foreach ($order as $item) {
            array_push($confirmStatus , $item->available_stock < $item->order_count ? false : true) ;
        }

        foreach ($confirmStatus as $item){
            if($item == false){
                $status = false ; break;
            }
        }


        return view('admin.order.details', compact ('order','payslipData','status'));
    }

    // change status
    public function changeStatus(Request $request) {
        Order::where('order_code', $request ['order_code'])->update([
                    'status' => $request ['status']
                ]);

        return response()->json([
            'status' => 'success',
        ],200);
    }

    // confirm order
    public function confirmOrder(Request $request){
        Order::where('order_code', $request[0]['order_code'])->update([
                    'status' => 1
                ]);

        foreach ($request->all() as $item){
           Product::where('id', $item['product_id'])->decrement('stock', $item['order_count']);
        }

        return response()->json([
            'status' => 'success'
        ],200);
    }

    //reject order
    public function rejectOrder(Request $request){
        Order::where( 'order_code', $request['orderCode'])->update([
                    'status' => 2
                ]);

        return response()->json([
            'status'=> 'success'
        ],200);
    }
}
