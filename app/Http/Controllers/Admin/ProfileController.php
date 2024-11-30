<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class ProfileController extends Controller
{   //change passwordpage
    public function changePasswordPage(){

        return view('admin.profile.changePassword');
    }

    //chage process
    public function changePassword(Request $request){

        $this->passwordValidationCheck($request);

        $currentPassword = auth()->user()->password;
        if(Hash::check($request->oldPassword, $currentPassword)){
            User::where('id',auth()->user()->id)->update([
                'password' => Hash::make($request->newPassword),
            ]);
        }

        return to_route('adminHome');
    }

    //profile account
    public function accountProfile(){
        return view('admin.profile.accountProfile');
    }

    //edit profile page
    public function edit(){
        return view('admin.profile.edit');
    }

    // edit profile update
    public function updateProfile(Request $request){

        $this->editUpdate($request);

        $data = $this->requestUpdate($request);

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

        return back();



    }
    //new admin page
    public function add(){
        return view('admin/adminaccount/create');
    }

    //add new admin
    public function addAccount(Request $request){
        $this->addAdmincheck($request);
        $data = $this->addRequest($request);

        User::create($data);

        Alert::success('Success ', 'Created Successful');

        return back();



    }

    //admin list
    public function list(){

        $admins = User::select('id','name','email','phone','address','role','created_at','provider')
        ->whereIn('role',['admin','superadmin'])
        ->when(request('searchKey'),function($query){
            $query->whereAny(['name','email','phone','address','role','provider'],'like','%'.request('searchKey').'%');
        })->paginate();

        return view('admin.adminaccount.list',compact('admins'));
    }

    //delete

    public function delete($id){

        User::where('id',$id)->delete();

        Alert::success('Success ', 'Deleted Successful');

        return back();
    }


    //request update data
    public function requestUpdate($request){
        return[
            'name' => $request->name,
            'email'=> $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
        ];

    }


    //check new admin validation
    private function addAdminCheck($request){
        $request->validate([
            'name' => 'required | max:15',
            'email'=> 'required|unique:users,email',
            'phone'=> 'required | min:8 | max:15',
            'password' => 'required',
            'confirmPassword' => 'required  ',
        ]);
    }

    //request add new admin
    public function addRequest($request){
        return [
            'name' => $request->name,
            'email'=> $request->email,
            'phone'=> $request->phone,
            'password' => Hash::make($request->password),
            'role' => 'admin',
        ];
    }


    //password validation
    private function passwordValidationCheck($request){
        $request->validate([
            'oldPassword' => 'required',
            'newPassword' => 'required',
            'confirmPassword' => 'required | same:newPassword',
        ]);
    }

    //update profile validation
    private function editUpdate($request){
        $request->validate([
            'name' => 'required',
            'email'=> 'required|unique:users,email,'.Auth::user()->id,
            'phone'=> 'required | unique:users,phone,'.Auth::user()->id,
            'address' => 'required',

        ]);
    }

    //user list
    public function userList(){
        $users = User::select(['id','name','email','phone','address','role','provider','created_at'])
        ->where('role','user')
        ->get();



        return view('admin.adminaccount.userList',compact('users'));
    }
}
