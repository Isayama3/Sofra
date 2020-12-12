<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Contact;
use App\Models\District;
use App\Models\Offer;
use App\Models\Product;
use App\Models\Restaurant;
use App\Models\Review;
use App\Models\Setting;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function cities()
    {
        $cities = City::all();
        return responseJson('1' , 'success',$cities);
    }
    public function districts()
    {
        $districts = District::all();
        return responseJson('1' , 'success',$districts);
    }
    public function restaurants()
    {
        $restaurants = Restaurant::all();
        return responseJson('1' , 'success',$restaurants);
    }
    public function restaurantSearch(Request $request)
    {
        $restaurants = Restaurant::where('name',$request->name)->get('name')->first();
        if ($restaurants) {
            return responseJson('1', 'success', $restaurants);
        }else{
            return responseJson('0', 'no data found', $restaurants);
        }
    }
    public function menu(Request $request)
    {
        $menu = Product::get()->where('restaurant_id',$request->restaurant_id);
        return responseJson('1','success',$menu );
    }
    public function offers(Request $request)
    {
        $offers = Offer::paginate(6);
        return responseJson('1','success',$offers );
    }
    public function aboutApp(Request $request)
    {
        $about_app = Setting::pluck('about_us');
        return responseJson('1','success',$about_app );
    }
    public function contactUs(Request $request)
    {
        $validation = validator()->make($request->all(),[
            'name'=>'required',
            'email'=>'required',
            'phone'=>'required',
            'message'=>'required',
            'type'=>'required'
        ]);
        if ($validation->fails())
        {
            return responseJson('0','validation error',$validation->errors());
        }
        $contact = Contact::create($request->all());
        return responseJson('1','success',$contact);
    }
    public function settings()
    {
        $settings = Setting::first();
        return responseJson('1','success',$settings);
    }
}
