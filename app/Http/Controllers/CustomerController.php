<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

class CustomerController extends Controller
{
    public function UserLogin(Request $request){
        $email = $request->email;
        $password = $request->password;
        $result = Customer::where('email',$email)->where('password',$password)->first();
        if($result){
            return redirect()->route('checkout');
        }else{
            return redirect()->back()->with('success', 'Invalid Password/ Email');
        }
    }

    public function UserRegistration(Request $request){
       
        $data = array();
        $data['name']=$request->name;
        $data['email']=$request->email;
        $data['password']=$request->password;
        $data['phone']=$request->phone;
        $id = Customer::insertGetId($data);
        $request->session()->put('id', $id);
        $request->session()->put('name', $request->name);
        
          return redirect()->route('checkout');
    }
    public function logout(){
       Auth::check();
        return redirect()->route('/');
    }
}
