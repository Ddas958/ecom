<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;
use Session;
use App\Models\User;

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
    public function checkPassword(Request $request){
        $data = $request->all();
        $current_password = $data['current_pwd'];
        $check_password  = User::where(['admin'=>'1'])->first();
        if(Hash::check($current_password,$check_password->password)){
            return true;
        }else{
            return false;
        }
    }
    public function updatePassword(Request $request){
        $data = $request->all();
        $current_password = $data['current_pwd'];
        $check_password  = User::where(['email'=> Auth::user()->email])->first();
        if(Hash::check($current_password,$check_password->password)){
            $password = bcrypt($data['new_pwd']);
            User::where('id','1')->update(['password'=> $password]);
            return redirect('/admin/settings')->with('success','Password Updated Successfully.');
        }else{
            return redirect('/admin/settings')->with('error','Current Password is Incorrect.');
        }
    }
}
