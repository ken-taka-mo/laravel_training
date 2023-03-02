<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Http;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function getAddress($code)
    {
        $url = "https://zipcloud.ibsnet.co.jp/api/search?zipcode=" . $code;
        $response = Http::get($url);
        $addressData = $response->json();
        if (!$addressData['results']) {
            return null;
        }
        $prefectureCode = $addressData['results'][0]['prefcode'];
        $address = $addressData['results'][0]['address2'] . $addressData['results'][0]['address3'];
        return ['address' => $address, 'prefecture_code' => $prefectureCode];
    }
}
