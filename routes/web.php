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

Auth::routes();
Route::group(['middleware'=>['auth:web','check-permission','device']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::resource('categories', 'CategoriesController');
    Route::resource('cities', 'CitiesController');
    Route::resource('clients', 'ClientsController');
    Route::resource('contacts', 'ContactsController');
    Route::resource('districts', 'DistrictsController');
    Route::resource('offers', 'OffersController');
    Route::resource('orders', 'OrdersController');
    Route::resource('payment-methods', 'PaymentMethodsController');
    Route::resource('payments', 'PaymentsController');
    Route::resource('restaurants', 'RestaurantsController');
    Route::resource('restaurants-payments', 'RestaurantsPaymentsController');
    Route::resource('settings', 'SettingsController');
    Route::resource('users', 'UsersController');
    Route::resource('roles', 'RolesController');
    Route::get('profile/{id}', 'ProfileController@edit')->name('profile');
    Route::post('profile/{id}', 'ProfileController@update')->name('profileUpdate');
    Route::get('logout', 'HomeController@logout');
});


// Route::get('/cookie/set','CookieController@setCookie')->name('set_cookie');
// Route::get('/cookie/get','CookieController@getCookie')->name('get_cookie');

Route::get('export-exel', 'ProductController@exportExcel');
Route::get('export-csv', 'ProductController@exportCsv');
Route::get('export-pdf', 'ProductController@generatePdf');
Route::post('import-exel', 'ProductController@importExcel')->name('import-product-excel');
Route::get('import-exel-view',function (){
    return view('imports.product');
});
