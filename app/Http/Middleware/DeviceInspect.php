<?php

namespace App\Http\Middleware;

use Closure;
use Cookie;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Ahmed\CookiesHelper;
class DeviceInspect
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user = \Auth::user(); //or $request->user()
        $cookies = new CookiesHelper();
      $test  =   $cookies->setCookie($request);

//       $get_cookie =  $cookies->getCookie($request);
//        dd($cookies->setCookie($request));

//            dd($request->cookie('enabled_device'));







//        $currentDevice = $request->userAgent(); //or $_SERVER['HTTP_USER_AGENT'];
//        //it could be fake like codedge said
//        if ($enabledDevice !== $currentDevice) {
//            if ($enabledDevice !== $currentDevice) {
//                return response()->view('errors.401', [
//                    'title' => 'Login Page is Inactive',
//                    'message' => 'Login Page is Inactive',
//                    'code' => '401'
//                ]);
//            $data = array(
//                "device" => false,
//                "message" => "your message to user",
//            );
//            return response([$data], 401); // or something else
//            }
//        }
        return $next($request);
    }
    public function setCookie(Request $request) {
        $response = new Response('New Cookie');
        $response->withCookie(cookie('enabled_device', $_SERVER['HTTP_USER_AGENT'], 60));
        return $response;
    }
    public function getCookie(Request $request) {
        $value = $request->cookie('enabled_device');
        echo $value;
    }
}
