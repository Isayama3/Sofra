<?php

namespace App\Ahmed;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CookiesHelper
{
//    public function setCookie(Request $request) {
//        $minutes = 1;
//        $response = new Response('Hello World');
//        $response->withCookie(cookie('enabled_device', $_SERVER['HTTP_USER_AGENT'], $minutes));
//        return $response;
//    }
//    public function getCookie(Request $request) {
//        $value = $request->cookie('enabled_device');
//        echo $value;
//    }
    public function setCookie(Request $request) {
        $minutes = 1;
        $response = new Response('Hello World');
        $response->withCookie(cookie('enabled_device', $_SERVER['HTTP_USER_AGENT'], $minutes));
        return $response;
    }
    public function getCookie(Request $request) {
        $value = $request->cookie('enabled_device');
        echo $value;
    }
}
