<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    
    function homePage(){
        $user = Auth::user();
        return  view('web.home',compact('user'));
    }
}
