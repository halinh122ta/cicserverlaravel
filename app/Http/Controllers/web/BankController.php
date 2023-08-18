<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setup;
use App\Models\Historie;
use App\Models\Price;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class BankController extends Controller
{
    function index(){
        $user = Auth::user();
        $set = Setup::find(1);
        return  view('web.bank',compact('user','set'));
    }
    function create(){
        $user = Auth::user();
        $pri = new Price;
        $pri->id_user = $user["id"];
        $pri->volatility = $_GET['voly'];
        $pri->notify = $_GET['notify'];
        $pri->type = 1;
        $pri->status = 0;
        $pri->save();
        return 1;
    }
    function applyBill(){
        $user = Auth::user();
        $add = 0;
        if($user->role == 1)
        {
            $pri = Price::find($_GET['id']);
            $pri->status = $_GET['status'];
            $person = User::find($pri->id_user);
            if($_GET['status'] == 1){
                // dd($person);
                $add = $pri->volatility + $person->balance;
                $person->balance = $add;
                $person->save();
                BankController::addHistoriesData($pri->id_user,"+".$pri->volatility,$person->balance,"Nạp tiền +".$pri->volatility);
            }else{
                BankController::addHistoriesData($pri->id_user,"0",$person->balance,"Nạp tiền bị từ chối");
            }
            $pri->save();
            return 1;
        }
        return 0;
    }
    public function addHistoriesData($id_user,$change,$balance,$content){
        try {
            $user = new Historie;
            $user->id_user = $id_user;
            $user->balance_change = $change;
            $user->balance_stay = $balance;
            $user->content = $content;
            $user->save();
            return true;
        } catch (Exception $th) {
            //throw $th;
        }
    }
    function appvora(){
        $user = Auth::user();
        if($user->role == 1){
            $appvo = Price::orderBy('created_at', 'desc')->where('type',1)->where('status',0)->limit(30)->get(); 
            $appvoAll = Price::orderBy('created_at', 'desc')->where('type',1)->limit(30)->get(); 
            return  view('web.bit',compact('user','appvo','appvoAll'));
        }else{
            return  view('web.role',compact('user'));
        }
    }
    // bnk top[]
    function person(){
        $user = Auth::user();
        $user = Auth::user();
        if($user->role == 1){
            $users = User::get();
            return  view('web.person',compact('user','users'));
        }else{
            return  view('web.role',compact('user'));
        }
    }
    function price(){
        $user = Auth::user();
        if($user->role == 1){
            $set = Setup::find(1);
            return  view('web.price',compact('user','set'));
        }else{
            return  view('web.role',compact('user'));
        }
    }
    function savePrice(Request $request){
        $user = Auth::user();
        if($user->role == 1){
            $input = $request->input();
            $set = Setup::find(1);
            $set->full = $input["full"];
            $set->odd = $input["odd"];
            $set->name = $input["name"];
            $set->bank_number = $input["bank_number"];
            $set->bank = $input["bank"];
            $set->coke = $input["coke"];
            $set->save();
            return redirect()->route('price.index');
        }else{
            return  view('web.role',compact('user'));
        }
    }
}
