<?php

namespace App\Http\Controllers;

use App\Models\Resource;
use App\Services\FileService;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\ResourceImport;
use App\Models\User;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

class PaymentGateWays extends Controller
{

    public function UnionPay(Request  $request){

        $data_req = $request->all();
        $merchent_id = "000000000100646";
        $tradeNum =  Carbon::now()->format('ydmhis');
        $arrkey =[
            "amount"=>  $data_req['amount'],
            "billAddrCity"=>"bcity",
            "billAddrCountry"=>"166",
            "billAddrPostCode"=>"bpostcode",
            "billAddrState"=>"bst",
            "billAddress1"=>"badr1",
            "callback" => "http://127.0.0.1:8080/#/payDone",
            "description"=>"1111",
            "currency"=>"840",
            "failUrl"=>"http://127.0.0.1:8080/#/payDone",
            "merNo"=> $merchent_id,
            "payIP" => "192.168.1.1",
            "shipAddrCity" => "scity",
            "shipAddrCountry"=>"166",
            "shipAddrPostCode"=>"spostcode",
            "shipAddrState"=>"sst",
            "shipAddress1"=>"sadr1",
            "successUrl"=>"http://127.0.0.1:8080/#/payDone",
            "tradeNo"=> $tradeNum,
            "transType"=>"sales"
        ]
        ;
        $data= $arrkey;
        ksort($data);
        $arr = [];
        $str = '';
        foreach($data as $x=>$x_value)
        {
            $str = $str. $x."=".$x_value.'&';
        }
        $str = $str."key=12345678";
        $hashString = hash('SHA256', $str) ;
        $response2 = Http::accept('application/json')->post('https://cmsapi-sit.pipay.com/gateway/checkout.do', [
            "amount"=>$data_req['amount'],
            "billAddrCity"=>"bcity",
            "billAddrCountry"=>"166",
            "billAddrPostCode"=>"bpostcode",
            "billAddrState"=>"bst",
            "billAddress1"=>"badr1",
            "callback" => "http://127.0.0.1:8080/#/payDone",
            "description"=>"1111",
            "currency"=>"840",
            "failUrl"=>"http://127.0.0.1:8080/#/payDone",
            "merNo"=> $merchent_id,
            "payIP" => "192.168.1.1",
            "shipAddrCity" => "scity",
            "shipAddrCountry"=>"166",
            "shipAddrPostCode"=>"spostcode",
            "shipAddrState"=>"sst",
            "shipAddress1"=>"sadr1",
            "successUrl"=>"http://127.0.0.1:8080/#/payDone",
            "tradeNo"=> $tradeNum,
            "transType"=>"sales",
            "digest"=>  $hashString
          ]);

        return  $response2;
    }

    public function MasterPay(Request  $request){
        $data_req = $request->all();
        $orderNum =  Carbon::now()->format('ydmhis');
        $resMasterCard= Http::withBasicAuth('merchant.TEST12345168', '9f9d917ff2fc2a729bf1f6ab3cd7192e')->post('https://test-gateway.mastercard.com/api/rest/version/63/merchant/TEST12345168/session', [
            "apiOperation"=> "INITIATE_CHECKOUT",
            "interaction" => [
                "operation"=> "AUTHORIZE"
            ],
            "order" => [
                "id" => $orderNum,
                "amount"=>  $data_req['amount'],
                "currency"=>$data_req['currency'],
                "description"=> "Goods for buy"
            ]
          ]);
        return $resMasterCard;
    }

    public function CreateUser(Request  $request){
        $user = User::create($request->all());
        PaymentGateWays::schedule($user->id);
        Log::debug($user);
        return response()->json([
            'message'=> 'success',
            'data' => $user
        ]);
    }

    protected function schedule($id)
    {
        $schedule = new Schedule();
        $udpateS =  $schedule->command('update:checkstatus')->everyMinute();
        Log::debug($udpateS);
    }


}
