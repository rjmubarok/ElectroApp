<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CheckController extends Controller
{
    public function index(){
        
        return view('frontend.pages.checkout');
    }
    public function UserLoginCheck(){
        return view('frontend.pages.userlogin');
    }
}
