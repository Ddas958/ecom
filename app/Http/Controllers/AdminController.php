<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Auth;
use Session;

class AdminController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
    }

    public function login(Request $request){

        if($request->isMethod('post')){
            $data = $request->input();
            if(Auth::attempt(['email'=>$data['email'],'password'=>$data['password'],'admin'=>'1'])){
                //Session::put('adminSession',$data['email']);
                return redirect('admin/dashboard');
            }else{
                return redirect('admin')->with('error','Invalid Username Or Password');
            }
        }
        return view('admin.admin_login');
   }

   public function dashboard(){
    //with session method
    // if(Session::has('adminSession')){
    //     return view('admin.dashboard');
    // }
    // else{
    //     return redirect('admin')->with('error','Please Login To Access.');
    // }
    // with middleware method

        return view('admin.dashboard');
   }

   public function logout(){
        Session::flush();
        return redirect('admin')->with('success','Logged Out Successfully.');
   }

   public function settings(){
        return view('admin.settings');
}
}
