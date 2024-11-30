<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class ContactController extends Controller
{
    public function contactPage(){
        $data = Auth::user()->id;

        return view('user.home.contact',compact('data'));
    }

    public function contact(Request $request){
        $contact =[
            'user_id' => Auth::user()->id,
            'title' => $request->title,
            'message' => $request->message,
        ];
        $this->Check($request);

        Contact::create($contact);

        Alert::success('Success ', 'Sent Successful');

        return to_route('userHome');
    }

    private function Check($request){
        $request->validate([
            'name' => 'required | max:15',
            'title'=> 'required',
            'message'=> 'required',
        ]);
    }
}
