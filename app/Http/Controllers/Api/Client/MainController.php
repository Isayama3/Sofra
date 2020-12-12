<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\Review;
use App\Models\Setting;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function createReview(Request $request)
    {
        $review = $request->user('client')->reviews()->create($request->all());
        return responseJson('1','success',$review);
    }
    public function makeOrder(Request $request)
    {
        $validation = validator()->make($request->all(),[
            'product_id'=>'required',
            'address'=>'required'
        ]);
        if ($validation->fails())
        {
            return responseJson('0','validation error',$validation->errors()->all());
        }
        $product = Product::where('id',$request->product_id)->first()->toArray();
        $order = $request->user('client')->orders()->create([
            'address'=>$request->address,
            'restaurant_id'=>$product['restaurant_id']
        ]);
        $order->products()->attach($request->product_id,['price'=>$product['price'],'quantity'=>$request->quantity]);
        $client_orders = Order::where('client_id',$request->user('client')->id)->get()->toArray();
        $total = OrderProduct::where('order_id',20)->sum('price');
        $commission = $total * (Setting::pluck('app_commission')->first()) / 100;
        return $commission;
//        $total =
//        return responseJson('1','success',$order);
    }
    public function currentOrders(Request $request)
    {
        $current_orders = $request->user('client')->orders()->where('status','processing')->get();
        return responseJson('1','success',$current_orders);
    }
    public function previousOrders(Request $request)
    {
        $previous_orders = $request->user('client')->orders()->where('status','completed')->get();
        return responseJson('1','success',$previous_orders);
    }
    public function receiveOrder(Request $request)
    {
        $order = Order::where('id',$request->order_id)->first();
        $order->update(['status'=>'received']);
        return responseJson('1','success',$order);
    }
    public function rejectOrder(Request $request)
    {
        $order = Order::where('id',$request->order_id)->first();
        $order->update(['status'=>'decline']);
        return responseJson('1','success',$order);
    }
}
