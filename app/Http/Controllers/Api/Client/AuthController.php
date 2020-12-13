<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Mail\ResetPassword;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = validator()->make($request->all(),[
            'name'=>'required',
            'email'=>'required|unique:clients',
            'phone'=>'required|unique:clients',
            'password'=>'required|confirmed',
            'district_id'=>'required'
        ]);
        if($validator->fails()){
            return responseJson('0','validation error',$validator->errors()->all());
        }
        $client = Client::create($request->all());
        $client->api_token = Str::random(60);
        $client->save();
        return responseJson(1,'done',[
            'api_token'=>$client->api_token,
            'client' => $client
        ]);
    }
    public function login(Request $request)
    {
        $validator = validator()->make($request->all(),[
            'email'=>'required',
            'password'=>'required'

        ]);
        if($validator->fails()){
            return responseJson('0','validation error',$validator->errors()->all());
        }
        $client = Client::where('email',$request->email)->first();
        if ($client){
            if (Hash::check($request->password,$client->password)){
                return responseJson('1','welcome',[
                    'api_token' =>$client->api_token,
                    'client' => $client
                    ]);
            }else{
                return responseJson(0,'uncorrect passowrd');
            }

        }else{
            return responseJson(0,'user not found');
        }
    }
    public function resetPassword(Request $request)
    {
        $validation = validator()->make($request->all(), [
            'phone' => 'required'
        ]);
        if ($validation->fails()) {
            return responseJson(0, 'validation error', $validation->errors()->all());
        }
        $client = Client::where('phone', $request->phone)->first();
        if ($client) {
            $code = rand(111111, 111111);
            $update = $client->update(['pin_code' => $code]);
            if ($update) {
                Mail::to($client->email)
                    ->bcc('ahmed.ismail11199@gmail.com')
                    ->send(new ResetPassword($code));

                return responseJson(1, 'check ur phone',
                    [
                        'pin_code_for_test' => $code,
                        'mail_fails' => Mail::failures()
                    ]);
            }else{
                return responseJson('0', 'try again');
            }
        }else{
            return responseJson('0', 'wrong phone number please try again');
        }
    }
    public function newPassword(Request $request)
    {
        $validation = validator()->make($request->all(),[
            'pin_code' => 'required',
            'password' => 'required|confirmed'
        ]);
        if ($validation->fails()){
            return responseJson(0,'validation error',$validation->errors()->all());
        }
        $user = Client::where('pin_code',$request->pin_code)->first();
        if ($user)
        {
            $user->password = $request->password;
            $user->pin_code = null;
            if($user->save())
            {
                return responseJson(1,'password changed successfully');
            }else{
                return responseJson(0 , 'please try again');
            }
        }else{
            return responseJson(0 , 'pin code error ');
        }

    }
    public function editProfile(Request $request)
    {
        $validator = validator()->make($request->all(),[
            'email'=>Rule::unique('clients')->ignore($request->user('client')->id),
            'phone'=>Rule::unique('clients')->ignore($request->user('client')->id)

        ]);
        if($validator->fails()){
            return responseJson('0','validation error',$validator->errors()->all());
        }
        $login_user = $request->user('client');
        $login_user->update($request->all());
        return responseJson(1,'successfull',[
            'api_token'=>$request->user('client')->api_token,
            'user' => $login_user
        ]);
    }
}
