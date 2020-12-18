<?php

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


?>
