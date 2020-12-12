<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
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
        $validation = validator()->make($request->all(),[
            'phone' => 'required'
        ]);
        if ($validation->fails()){
            return responseJson(0,'validation error',$validation->errors()->all());
        }
        $client = Client::where('phone',$request->phone)->first();
        if ($client){
            $code = rand(111111,111111);
            $update = $client->update(['pin_code' => $code]);
            if ($update){

            }
        }else{
            return responseJson(0,'phone not found',$validation->errors()->all());
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
