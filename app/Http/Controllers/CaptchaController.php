<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Tncode\SlideCaptcha;
use Illuminate\Support\Facades\Cache;
use SlideCode;
// use Illuminate\Http\Str;
class CaptchaController extends Controller
{
    public function getImageV2()
    {
         $captcha = app('slide_captcha');
         $captcha->build();

         $imgData = $captcha->getInline();
         $code = $captcha->getCode();
    }
    public function getCaptchaDemo(Request $request, SlideCaptcha $captcha)
    {
        $key = 'slide-captcha-' . Str::random(32);

        $captcha->build();

        Cache::put($key, ['code' => $captcha->getCode()], 600);

        $result = [
            'captcha_key' => $key,
            'expired_at' => time() + 600,
            'captcha_image_content' => $captcha->getInline()
        ];
        return $this->responseData($result, 'dd', 'hoe');
    }

    public function checkDemo(Request $request)
    {
        return view('index');
    }

    public function responseData($msg, $data = 'data', $status = 200) {
        $jsonData = [
            'message' => $msg,
            'data' => $data,
            'status' => $status
        ];
        return response()->json($jsonData, 200);
    }

    public function Captcha(Request $request){
        $datas = $request->all();
        session(['captcha' => $datas]);
        $sum = array_sum($datas);
        $avg = $sum / count($datas);
        $sum2 = array_sum(
            array_map(
                function($data) use ($avg) {
                    return pow($data - $avg, 2);
                }, $datas
            )
        );
        $stddev = $sum2 / count($datas);
        return $stddev;
    }

    public function chapView(){
        return view('captcha/index');
    }
}
