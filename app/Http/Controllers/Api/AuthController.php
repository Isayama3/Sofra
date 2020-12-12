<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function resetPassword(Request $request)
    {
        $validation = validator()->make($request->all(),[
            'email' => 'required|exists:restaurant'
        ]);
        if ($validation->fails()){
            return responseJson(0,'unvalid email');
        }
    }
}
