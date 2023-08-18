<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    
    function login(){
        if(Auth::check()){
            return redirect()->route('home.index');
        }else{
            return  view('web.login');
        }
    }
    function loginPost(Request $request){
        $credentials = $request->validate([
            'phonenumber' => ['required'],
            'password' => ['required'],
        ]);
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('home.index');
        }else{
            return  view('web.login')->with('status',"False login !");;
        }
    }
    function register(){
        if(Auth::check()){
            return redirect()->route('home.index');
        }else{
            return  view('web.register');
        }
    }
    function registerPost(Request $request){
        $credentials = $request->validate([
            'name' => ['required'],
            'phonenumber' => ['required','unique:users'],
            'password' => ['required'],
            're_password' => ['required'],
            'provinceSelect' => ['required']
        ]);
        $input = $request->input();
        try{
            if($input["password"] == $input["re_password"]){
                $user = new User;
                $user->name = $input["name"];
                $user->phonenumber = $input["phonenumber"];
                $user->password = bcrypt($input["password"]);;
                $user->area = $input["provinceSelect"];
                $user->save();
                return  view('web.login')->with('status',"Register success!");
            }else{
                return  view('web.register')->with('status',"False Register Pass !");
            }
        }catch(Exception $ex){
            return  view('web.register')->with('status',"False login !");
        }
    }
    function getInfoUser(){
        $use = Auth::user();
        if($use["role"] == 1){
            $user_phone = $_GET["phonenumber"];
            if(strlen($user_phone) > 8){
                $user = User::where('phonenumber', $user_phone)->limit(1)->get();
                if(count($user) > 0 ){
                    return response()->json([
                        'Message' => "Ok",
                        'user' => $user[0],
                    ]);
                }else{
                    return response()->json([
                        'Message' => "Không tìm thấy"
                      ]);
                }
            }else{
                return response()->json([
                    'Message' => "Không phải số điện thoại"
                  ]);
            }
        }else{
            return response()->json([
                'Message' => "Không đủ quyền"
              ]);
        }
    }
    function updateInfoUser(){
        $use = Auth::user();
        if($use["role"] == 1){
            $id_user = $_GET["id"];
            $balance = $_GET["balance"];
            $user = User::find($id_user);
            if($user != null){
                $user->balance  = $balance;
                $user->save();
                return response()->json([
                    'Message' => "Thay đổi thành công"
                  ]);
            }else{
                return response()->json([
                    'Message' => "Không tìm thấy nội dung"
                  ]);
            }
        }else{
            return response()->json([
                'Message' => "Không đủ quyền"
              ]);
        }
    }
    function logout(){
        Auth::logout();
        return redirect()->route('login');
    }
}
