<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
class AdminController extends Controller
{
    public function index(){
        return view('admin.admin_login');
    }
   
    public function showDashboard(Request $request){
        $admin_email = $request->email;
        $admin_password = Hash::make($request->password);
        $result = Admin::where('admin_email',$request->email)->where('admin_password',$request->password)->first();
        if($result){
            Session::put('admin_id', $result->admin_id);
            Session::put('admin_name', $result->admin_name);
           return Redirect::to('/admin/home');
        }else{
            return redirect()->route('admin.loging')->with('success', 'Invalid Password');
        }
    }
}
