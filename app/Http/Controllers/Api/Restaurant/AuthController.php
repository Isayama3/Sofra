<?php

namespace App\Http\Controllers\Api\Restaurant;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
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
            'email'=>'required|unique:restaurants',
            'phone'=>'required|unique:restaurants',
            'password'=>'required|confirmed',
            'district_id'=>'required',
            'min_price'=>'required',
            'max_price'=>'required',
            'delivery_cost'=>'required',
            'status'=>'required'
        ]);
        if($validator->fails()){
            return responseJson('0','validation error',$validator->errors()->all());
        }
        $restaurant = Restaurant::create($request->all());
        $restaurant->api_token = Str::random(60);
        $restaurant->save();
        return responseJson(1,'done',[
            'api_token'=>$restaurant->api_token,
            'restaurant' => $restaurant
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
        $restaurant = Restaurant::where('email',$request->email)->first();
        if ($restaurant){
            if (Hash::check($request->password,$restaurant->password)){
                return responseJson('1','welcome',[
                    'api_token' =>$restaurant->api_token,
                    'restaurant' => $restaurant
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
        $restaurant = Restaurant::where('phone',$request->phone)->first();
        if ($restaurant){
            $code = rand(111111,111111);
            $update = $restaurant->update(['pin_code' => $code]);
            if ($update){

            }
        }else{
            return responseJson(0,'phone not found',$validation->errors()->all());
        }
    }
    public function editProfile(Request $request)
    {
        $validator = validator()->make($request->all(),[
            'email'=>Rule::unique('restaurants')->ignore($request->user('restaurant')->id),
            'phone'=>Rule::unique('restaurants')->ignore($request->user('restaurant')->id)

        ]);
        if($validator->fails()){
            return responseJson('0','validation error',$validator->errors()->all());
        }
        $login_user = $request->user('restaurant');
        $login_user->update($request->all());
        return responseJson(1,'successfull',[
            'api_token'=>$request->user('restaurant')->api_token,
            'user' => $login_user
        ]);
    }
}
