<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Order;
use App\Models\Contact;
use Illuminate\Http\Request;
use App\Models\PaymentHistory;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    //direct home to admin
    public function adminHome(){
        $total_sell_amt = number_format(PaymentHistory::sum('total_amt'));

        $order = number_format(Order::where('status',1)->count('status'));

        $user_count = number_format(User::where('role','user')->count('id'));

        // dd($total_sell_amt);
        return view('admin.home.list',compact('total_sell_amt','order','user_count'));
    }

    //Contact
    public function adminContact(){
        $contact = Contact::select('users.name as user_name','contacts.*')
        ->leftJoin('users','contacts.user_id','users.id')->get();

        // dd($contact->toArray());
        return view('admin.home.contact',compact('contact'));
    }


}
