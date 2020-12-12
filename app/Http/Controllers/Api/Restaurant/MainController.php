<?php

namespace App\Http\Controllers\Api\Restaurant;

use App\Http\Controllers\Controller;
use App\Models\Offer;
use App\Models\Order;
use App\Models\Product;
use App\Models\Restaurant;
use App\Models\Review;
use Illuminate\Http\Request;

class MainController extends Controller
{

    public function addProduct(Request $request)
    {
        $validation = validator()->make($request->all(),[
            'name'=>'required',
            'price'=>'required',
            'description' => 'required',
            'time'=> 'required',
            'category_id'=>'required'
        ]);
        if ($validation->fails())
        {
            return responseJson('0','validation error',$validation->errors());
        }
        $product = $request->user('restaurant')->products()->create($request->all());
        return responseJson('0','success',$product);
    }
    public function editProduct(Request $request)
    {
        $validation = validator()->make($request->all(),[
            'name'=>'required',
            'price'=>'required',
            'description' => 'required',
            'time'=> 'required',
            'product_id'=>'required',
            'category_id'=>'required'
        ]);
        if ($validation->fails())
        {
            return responseJson('0','validation error',$validation->errors());
        }
        $product = Product::where('id',$request->product_id)->first();
        $product->update($request->except(['product_id']));
        return responseJson('1','success',$product);
    }
    public function newOrders(Request $request)
    {
        $new_orders = $request->user('restaurant')->orders()->where('status','pending')->paginate(6);
        return responseJson('1','success',$new_orders);
    }
    public function acceptOrder(Request $request)
    {
        $order = Order::where('id',$request->order_id)->first();
        $order->update(['status'=>'processing']);
        return responseJson('1','success',$order);
    }
    public function rejectOrder(Request $request)
    {
        $order = Order::where('id',$request->order_id)->first();
        $order->update(['status'=>'decline']);
        return responseJson('1','success',$order);
    }
    public function currentOrders(Request $request)
    {
        $current_orders = $request->user('restaurant')->orders()->where('status','processing')->paginate(6);

        return responseJson('1','success',$current_orders);
    }
    public function previousOrders(Request $request)
    {
        $previous_orders = $request->user('restaurant')->orders()->where('status','completed')->paginate(6);

        return responseJson('1','success',$previous_orders);
    }
    public function restaurantOffers(Request $request)
    {
        $offers = $request->user('restaurant')->offers()->paginate(5);
        return responseJson('1','success',$offers);
    }
    public function newOffer(Request $request)
    {
        $validation = validator()->make($request->all(),[
            'name'=>'required',
            'discount'=>'required',
            'from'=>'required',
            'to'=>'required',
        ]);
        if ($validation->fails())
        {
            return responseJson('0','validation error',$validation->errors());
        }
        $offer = $request->user('restaurant')->offers()->create($request->all());
        return responseJson('1','success',$offer);
    }
    public function editOffer(Request $request)
    {
        $validation = validator()->make($request->all(),[
            'name'=>'required',
            'discount'=>'required',
            'from'=>'required',
            'to'=>'required',
            'id'=>'required'
        ]);
        if ($validation->fails())
        {
            return responseJson('0','validation error',$validation->errors());
        }
        $offer = Offer::where('id',$request->id)->first();
        $offer->update($request->all());
        return responseJson('1','success',$offer);
    }
    public function deleteOffer(Request $request)
    {
        $offer = Offer::where('id',$request->id)->delete();
        if ($offer)
        {
            return responseJson('1','deleted');
        }
        else{
            return responseJson('0','error');
        }
    }
    public function reviews(Request $request)
    {
        $reviews = $request->user('restaurant')->reviews()->paginate(5);
        return responseJson('1' , 'success',$reviews);
    }
    public function 
}
