<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\Restaurant;
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
            'restaurant_id'=>'required|exists:restaurants,id',
            'products.*.product_id' => 'required|exists:products,id',
            'products.*.quantity' => 'required',
            'address'=>'required',
            'payment_method' => 'required'
        ]);
        if ($validation->fails())
        {
            return responseJson('0','validation error',$validation->errors()->all());
        }
        $restaurant = Restaurant::find($request->restaurant_id);
        if ($restaurant->status == 'closed')
        {
            return responseJson('0','sorry this restaurant is closed');
        }
        $order = $request->user('client')->orders()->create([
            'address'=>$request->address,
            'restaurant_id'=>$request->restaurant_id,
            'note' => $request->note,
            'payment_method' => $request->payment_method
        ]);
        $cost = 0 ;
        $delivery_cost = $restaurant->delivery_cost;
        foreach ($request->products as $p)
        {
            // ['id'=> 1 , 'quantity' => 2 , 'note' => 'no notes']
            $product = Product::find($p['product_id']);
            $ready_item = [
                $p['product_id'] => [
                    'price' => $product->price,
                    'quantity' => $p['quantity'],
                    'note' => (isset($p['note']))?$p['note']:''
                ]
            ];
            $order->products()->attach($ready_item);
            $cost += ($product->price * $p['quantity']);
        }
        if ($restaurant->min_price <= $cost)
        {
            $total = $delivery_cost + $cost;
            $commission = Setting::pluck('app_commission')->first() * $cost / 100;
            $net = $total - $commission;
            $update = $order->update([
                'cost' => $cost,
                'delivery_cost' => $delivery_cost,
                'total' => $total,
                'commission' => $commission,
                'net' => $net
            ]);
//            if($update)
//            {
//                // notification
//                $notification = $restaurant->restaurantable()->saveMany([
//                    'title' => 'new order',
//                    'content' => 'you have new order from ',
//                    'order_id' => $order->id
//                ]);
//            }
            $data = ['order'=> $order->fresh()->load('products')]; //load() خاصة بال relation
            return responseJson('1','success',$data);
        }else{
            $order->products()->delete();
            $order->delete();
            return responseJson('0','لطلب لا يجب ان يكون اقل من 20 ريال');
        }




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
