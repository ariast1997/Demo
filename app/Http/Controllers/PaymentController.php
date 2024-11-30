<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PaymentController extends Controller
{
    //payment page
    public function payment(){
        $payment = Payment::get();
        return view('admin.payment.list',compact('payment'));
    }

    //create payment
    public function create(Request $request){
        $this->paymentCheck($request);

        Payment::create([
            'account_number' => $request->number,
            'account_name' => $request->name,
            'type'  => $request->type,
        ]);

        Alert::success('Successed', 'Create Successful');

        return to_route('payment');
    }

    //edit payment page
    public function editPage($id){
        $payment = Payment::where('id',$id)->first();

        return view('admin.payment.editPayment',compact('payment'));
    }

    //update payment
    public function update(Request $request){

        // dd($request->id);
        $this->paymentCheck($request);

        $paymentData= $request->all();

        $id=$request->id;

        $data = Payment::where('id',$id)->update([
            'account_number' => $request->number,
            'account_name'=> $request->name,
            'type'=> $request->type,
        ]);
        Alert::success('Successed', 'Update Successful');

        return back();

    }

    // delete payment
    public function delete($id){
        Payment::find($id)->delete();

        Alert::success('Successed', 'Delete Successful');

        return back();
    }

    //payment validation
    public function paymentCheck($request){
        $request->validate([
            'number' => 'required',
            'name' => 'required',
            'type'=> 'required',
        ]);
    }
}
