<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix'=>'client','namespace'=>'Api\Client'],function(){
    Route::post('register','AuthController@register');
    Route::post('login','AuthController@login');
    Route::get('reset-password','AuthController@resetPassword');
    Route::post('edit-profile','AuthController@editProfile');
    Route::get('create-review','MainController@createReview');
    Route::get('make-order','MainController@makeOrder');
    Route::get('current-orders','MainController@currentOrders');
    Route::get('previous-orders','MainController@previousOrders');
    Route::get('receive-order','MainController@receiveOrder');
    Route::get('reject-order','MainController@rejectOrder');

});
Route::group(['prefix'=>'restaurant','namespace'=>'Api\Restaurant'],function(){
    Route::post('register','AuthController@register');
    Route::post('login','AuthController@login');
    Route::get('reset-password','AuthController@resetPassword');
    Route::post('edit-profile','AuthController@editProfile');
    Route::get('add-product','MainController@addProduct');
    Route::get('edit-product','MainController@editProduct');
    Route::get('new-orders','MainController@newOrders');
    Route::get('accept-order','MainController@acceptOrder');
    Route::get('reject-order','MainController@rejectOrder');
    Route::get('current-orders','MainController@currentOrders');
    Route::get('previous-orders','MainController@previousOrders');
    Route::get('restaurant-offers','MainController@restaurantOffers');
    Route::get('new-offer','MainController@newOffer');
    Route::get('edit-offer','MainController@editOffer');
    Route::get('delete-offer','MainController@deleteOffer');
    Route::get('reviews','MainController@reviews');


});
Route::group(['prefix'=>'main','namespace'=>'Api'],function(){
    Route::get('cities','MainController@cities');
    Route::get('districts','MainController@districts');
    Route::get('restaurants','MainController@restaurants');
    Route::get('restaurant-search','MainController@restaurantSearch');
    Route::get('menu','MainController@menu');
    Route::get('offers','MainController@offers');
    Route::get('about-app','MainController@aboutApp');
    Route::get('contact-us','MainController@contactUs');
    Route::get('settings','MainController@settings');
});
