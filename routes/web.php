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

Route::group(['middleware' => ['auth'], 'namespace' => 'Admin', 'prefix' => 'admin'], function () {
    Route::get('/', 'IndexController@index')->name('dashboard');
    Route::get('/user/{id}', 'UserController@index');

    //medicine
    Route::get('/medicine', 'MedicineController@index')->name('medicineList');
    Route::get('/medicine/add', 'MedicineController@create')->name('medicineAdd');
    Route::post('/medicine/add', 'MedicineController@store')->name('medicineAddPost');
    Route::get('/medicine/{id}', 'MedicineController@show')->name('medicineEdit');
    Route::post('/medicine/{id}', 'MedicineController@store')->name('medicineEditPost');
    Route::post('/medicine/delete/{id}', 'MedicineController@delete')->name('medicineDelete');


    //schedule
    Route::get('/schedule', 'ScheduleController@index')->name('scheduleList');
    Route::post('/schedule/add', 'ScheduleController@store')->name('scheduleAddPost');
    Route::get('/schedule/add', 'ScheduleController@create')->name('scheduleAdd');
    Route::get('/schedule/{id}', 'ScheduleController@show')->name('scheduleEdit');
    Route::post('/schedule/{id}', 'ScheduleController@store')->name('scheduleEditPost');
    Route::post('/schedule/delete/{id}', 'ScheduleController@delete')->name('scheduleDelete');
    //article
    Route::get('/article', 'ArticlesController@index')->name('ArticleList');
    Route::get('/article/add', 'ArticlesController@create')->name('ArticleAdd');
    Route::post('/article/add', 'ArticlesController@store')->name('ArticleAddPost');
    Route::get('/article/{id}', 'ArticlesController@show')->name('ArticleEdit');
    Route::post('/article/{id}', 'ArticlesController@store')->name('ArticleEditPost');
    Route::get('/article/delete/{id}', 'ArticlesController@delete')->name('ArticleDelete');
    //message
    Route::get('/message', 'MessageController@index')->name('messageList');
    Route::get('/message/{id}', 'MessageController@show')->name('messageDetail');
    Route::post('/message/read/{id}', 'MessageController@read')->name('messageRead');
    Route::post('/new-chat/{id}', 'MessageController@newChat');
    //user

    Route::get('/user', 'UserController@index')->name('userIndex');
    Route::get('/user/{id}', 'UserController@show')->name('getDetailUser');

    //bill

    Route::get('bill/waiting-pay', 'BillController@waitingPay')->name('waitingPay');
    Route::get('bill/delivering', 'BillController@delivering')->name('delivering');
    Route::get('bill/delivered', 'BillController@delivered')->name('delivered');
    Route::get('bill/canceled', 'BillController@canceled')->name('cancel');
    Route::get('bill/{id}', 'BillController@create')->name('getStatusBill');
    Route::post('bill/{id}', 'BillController@store')->name('updateStatusBill');

    //medicine
    Route::get('/promotion', 'PromotionController@index')->name('promotionList');
    Route::get('/promotion/add', 'PromotionController@create')->name('promotionAdd');
    Route::post('/promotion/add', 'PromotionController@store')->name('promotionAddPost');
    Route::get('/promotion/{id}', 'PromotionController@show')->name('promotionEdit');
    Route::post('/promotion/{id}', 'PromotionController@store')->name('promotionEditPost');
    Route::post('/promotion/delete/{id}', 'PromotionController@delete')->name('promotionDelete');
    //
});

//Route::group(['middleware' => ['auth']], function () {
Route::post('/chatAdmin', 'ChatController@chatAdmin');
Route::get('/chat', 'ChatController@index');
Route::post('/chat', 'ChatController@chat');
////});

//Route::view('admin/{any}', 'admin/master')
//    ->where('any', '.*');

Route::view('{any}', 'frontend/master')
    ->where('any', '^(?!admin$).*$');
