<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HistoriesController extends Controller
{
    function index(){
        $user = Auth::user();
        return  view('web.histories',compact('user'));
    }
}
