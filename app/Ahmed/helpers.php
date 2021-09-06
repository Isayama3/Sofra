<?php

use Illuminate\Http\Response;
use Illuminate\Http\Request;

function responseJson($status , $message , $data = null)
{
    $response = [
        'status' => $status,
        'message' => $message,
        'data' => $data
    ];
    return response()->json($response);
}
function create_permission($name , $route)
{
    DB::table('permissions')->insert([
        'name' => $name,
        'guard_name' => 'web',
        'routes' => $route
    ]);
}

//    function setCookieFunc(Request $request ,$name,$value,$minutes)
//    {
//        $response = new Response('Set Cookie');
//        $response->withCookie(cookie($name, $value, $minutes));
//        return $response;
//    }
//
//    function getCookieFunc(Request $request,$name)
//    {
//        $value = $request->cookie($name);
//        echo $value;
//    }


?>
