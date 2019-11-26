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
Route::post('/address/insert', 'UserAddressController@insertAddress');
Route::post('user/address','UserAddressController@store');

//Route::post('address', 'UserAddressController@insert');

Route::get('/user/schedule/{userId}', 'ScheduleController@getScheduleByUser');
Route::get('symptom/{register_date}/{id}', 'SymptomController@getByDate');
Route::post('user/{id}', 'UserController@update');
Route::resource('user', 'UserController');
Route::resource('article', 'ArticlesController');
Route::resource('doctor', 'DoctorController');
Route::resource('symptom', 'SymptomController');
Route::resource('medicine', 'MedicineController');
Route::resource('clinic', 'ClinicController');
Route::resource('schedule', 'ScheduleController');
Route::resource('scheduleContent', 'ScheduleContentController');
Route::resource('message', 'MessageController');
Route::resource('category', 'CategoryController');
Route::resource('promotion', 'PromotionController');
Route::resource('chat', 'ChatController')->middleware('auth');

Route::resource('index', 'IndexController');
Route::post('user/{id}', 'UserController@update')->name('update');
Route::post('login', 'CartController@login')->name('login');
Route::post('logout', 'Authcontroller@logout')->name('logout');
Route::post('schedules/edit/:id', 'ScheduleController@postEdit');

// cart
Route::post('cart', 'CartController@add');
Route::get('cart/{userId}', 'CartController@getCart');
Route::post('cart/add', 'CartController@plus');
Route::post('cart/div', 'CartController@divide');
Route::post('cart/del', 'CartController@delete');
Route::post('cart/checkout', 'CartController@checkout');
//Route::get('user/address/{id}','UserController@getAddress');
Route::get('/province', 'ProvinceController@index');
Route::get('/district/{province_id}', 'ProvinceController@getDistrict');
Route::get('/ward/{district_id}', 'ProvinceController@getWard');
Route::post('chat', 'ChatController@chat');
Route::get('chat', 'ChatController@getAfter');

//bill

Route::get('/bill', 'BillController@getBillByStatus');
Route::get('/bill/{id}', 'BillController@show');
Route::post('/search', 'MedicineController@search');
