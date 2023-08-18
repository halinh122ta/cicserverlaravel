<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setup;
use App\Models\User;
use Carbon\Carbon; 
use App\Models\Limitcoke;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    function full(Request $request){
        $input = $request->input();
        $use = Auth::user();
        $user = User::find($use["id"]);
        $setup = Setup::find(1);
        $domainFull = "http://api.saletaichinh.com:5005/api/Cic/checkcic/".$input["cccd"];
        $domainEbanker = "http://api.saletaichinh.com:5001/api/Ebanker/checkma/".$input["cccd"];
        $domainFig = "http://api.saletaichinh.com:5005/api/Fig/checkduplicate/".$input["cccd"];
        $domainCicShb = "http://api.saletaichinh.com:5001/api/CicShb/checkdup/".$input["cccd"];
        $domainPtf = "http://api.saletaichinh.com:5001/api/Ptf/".$input["cccd"];
        $domainLotteFinance = "http://api.saletaichinh.com:5001/api/LotteFinance/".$input["cccd"];
        $str = $setup->coke;
        $lst = explode("\n", $str);
    reloadCokie:
        $cookies = "";
        for($i = 0 ;$i < count($lst);$i++){
            $coke = trim($lst[$i]);
            if(TransactionController::checkerLimit($coke)){
                $cookies = $coke;
                break;
            }
        }
        if(strlen($cookies) < 10){
            return response()->json([
                'balance' => $user->balance,
                'Message' => "Tài nguyên đang bận"
              ]);
        }
        // type check
        if($input["type"] == "full"){
            $newbalance = $user->balance - $setup->full;
            if($newbalance >= 0){
                $user->balance = $newbalance;
                $user->save();
                TransactionController::postData($cookies,0);
                $res = TransactionController::Ebanker($cookies,$domainFull);
                return response()->json([
                    'balance' => $user->balance,
                    'Message' => json_decode($res)->Message
                  ]);
            }else{
                return response()->json([
                    'Message' => 'Không đủ số dư'
                  ]);
            }
        }
        else{
            $newbalance = $user->balance - $setup->odd;
            if($newbalance < 0){
                return response()->json([
                    'Message' => 'Không đủ số dư'
                  ]);
            }
            $user->balance = $newbalance;
            $user->save();
            $res = response()->json([
                'Message' => 'Kiểu không khả dụng'
            ]); 
            if($input["type"] == "Ebanker"){
                TransactionController::postData($cookies,5);
                $res =  TransactionController::Ebanker($cookies,$domainEbanker);
            }
            if($input["type"] == "Fig"){
                $res =  TransactionController::Ebanker($cookies,$domainFig);
            }
            if($input["type"] == "CicShb"){
                TransactionController::postData($cookies,7);
                $res =   TransactionController::Ebanker($cookies,$domainCicShb);
            }
            if($input["type"] == "Ptf"){
                TransactionController::postData($cookies,8);
                $res =   TransactionController::Ebanker($cookies,$domainPtf);
            }
            if($input["type"] == "LotteFinance"){
                TransactionController::postData($cookies,10);
                $res =   TransactionController::Ebanker($cookies,$domainLotteFinance);
            }
            $message = json_decode($res)->Message;
            if(str_contains($message, "đủ rồi")){
                TransactionController::addCokieLimit($cookies);
                goto reloadCokie;
            }
            else{
                return response()->json([
                    'balance' => $user->balance,
                    'Message' => $message
                  ]);
            }
        }
        // return TransactionController::Ebanker($cookies);
    }
    public function checkerLimit($cookies){
        $today = Carbon::today();
        $limitcokes = Limitcoke::where("coke",$cookies)->whereDate('created_at', $today)->get();
        if(count($limitcokes) > 0){
            return false;
        }
        return true;
    }
    public function addCokieLimit($cookies){
        $user = new Limitcoke;
        $user->coke = $cookies;
        $user->save();
        return true;
    }
    public function  test($PHPSESSID) {
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => 'http://api.saletaichinh.com:5001/api/Ebanker/checkma/125125478',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            'Cookie: '.$PHPSESSID,
            'Referer: http://crm.saletaichinh.com/'
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;
    }
    public function Ebanker($cookies,$domain){
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => $domain,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            'Referer: http://crm.saletaichinh.com/',
            'Cookie: '.$cookies
        ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }
    public function postData($cookies,$item){
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => 'http://crm.saletaichinh.com/app/views/openlink/openNewLinkFull.php',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => 'id=11537&item='.$item,
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/x-www-form-urlencoded',
            'Cookie: '.$cookies
        ),
        ));
        
        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;

    }
    // public function loginData(){

    //     $username = "STC0854403567";
    //     $password = "YF48EG62";

    //     $curl = curl_init();
    //     curl_setopt_array($curl, array(
    //         CURLOPT_URL => 'http://crm.saletaichinh.com/login.php',
    //         CURLOPT_RETURNTRANSFER => true,
    //         CURLOPT_ENCODING => '',
    //         CURLOPT_MAXREDIRS => 10,
    //         CURLOPT_TIMEOUT => 0,
    //         CURLOPT_HEADER => 1,
    //         CURLOPT_SSL_VERIFYPEER => false,
    //         CURLOPT_FOLLOWLOCATION => true,
    //         CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    //         CURLOPT_CUSTOMREQUEST => 'GET',
    //         CURLOPT_HTTPHEADER => array(
    //             'referer: http://crm.saletaichinh.com/login.php',
    //             'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/115.0.0.0 Safari/537.36',
    //         ),
    //     ));
    //     curl_setopt_array($curl, array(
    //     CURLOPT_URL => 'http://crm.saletaichinh.com/app/process/login.php',
    //     CURLOPT_RETURNTRANSFER => true,
    //     CURLOPT_ENCODING => '',
    //     CURLOPT_MAXREDIRS => 10,
    //     CURLOPT_TIMEOUT => 0,
    //     CURLOPT_HEADER => 1,
    //     CURLOPT_SSL_VERIFYPEER => false,
    //     CURLOPT_FOLLOWLOCATION => true,
    //     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    //     CURLOPT_CUSTOMREQUEST => 'POST',
    //     CURLOPT_POSTFIELDS => 'profile_code='.$username.'&password='.$username.'&browserVersion=Chrome%20115&deviceType=Desktop&manufacturer=',
    //     CURLOPT_HTTPHEADER => array(
    //         'Content-Type: application/x-www-form-urlencoded',
    //         'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/115.0.0.0 Safari/537.36',
    //         'referer: http://crm.saletaichinh.com/login.php',
    //         'Origin: http://crm.saletaichinh.com'
    //     ),
    //     ));
    //     $result = curl_exec($curl);
    //     dd($result);
    //     curl_setopt_array($curl, array(
    //         CURLOPT_URL => 'http://crm.saletaichinh.com/',
    //         CURLOPT_RETURNTRANSFER => true,
    //         CURLOPT_ENCODING => '',
    //         CURLOPT_MAXREDIRS => 10,
    //         CURLOPT_TIMEOUT => 0,
    //         CURLOPT_HEADER => 1,
    //         CURLOPT_SSL_VERIFYPEER => false,
    //         CURLOPT_FOLLOWLOCATION => true,
    //         CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    //         CURLOPT_CUSTOMREQUEST => 'GET',
    //         CURLOPT_HTTPHEADER => array(
    //             'Referer: http://crm.saletaichinh.com/login.php',
    //             'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/115.0.0.0 Safari/537.36',
    //         ),
    //     ));
    //     $result  = curl_exec($curl);
    //     echo $result;
    //     preg_match_all('/^Set-Cookie:\s*([^;]*)/mi', $result, $matches);
    //     $cookies = array();
    //     foreach($matches[1] as $item) {
    //         parse_str($item, $cookie);
    //         $cookies = array_merge($cookies, $cookie);
    //     }
    //     curl_close($curl);
    //     return $cookies;
      
    //   }
}
