<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::group(['middleware'=>'auth:web'],function()
{
    Route::get('/home', 'HomeController@index')->name('home');
    Route::resource('categories','CategoriesController');
    Route::resource('cities','CitiesController');
    Route::resource('clients','ClientsController');
    Route::resource('contacts','ContactsController');
    Route::resource('districts','DistrictsController');
    Route::resource('offers','OffersController');
    Route::resource('orders','OrdersController');
    Route::resource('payment-methods','PaymentMethodsController');
    Route::resource('payments','PaymentsController');
    Route::resource('restaurants','RestaurantsController');
    Route::resource('restaurants-payments','RestaurantsPaymentsController');
    Route::resource('settings','SettingsController');
    Route::resource('users','UsersController');
    Route::resource('roles','RolesController');
});


