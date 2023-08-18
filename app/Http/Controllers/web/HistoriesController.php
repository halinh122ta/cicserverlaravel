<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Historie;
use Illuminate\Support\Facades\Auth;

class HistoriesController extends Controller
{
    function index(){
        $user = Auth::user();
        $histories = Historie::orderBy('created_at', 'desc')->where("id_user",$user->id)->limit(30)->get();
        return  view('web.histories',compact('user','histories'));
    }
}
