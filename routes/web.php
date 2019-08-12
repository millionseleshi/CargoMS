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

use Illuminate\Support\Facades\Auth;

Route::get('/', function () {

    return view('welcome');
});

Auth::routes();

Route::get('/locale/{locale}',function ($locale){
Session::put('locale',$locale);
return redirect()->back();
})->name('Amharic');

Route::get('/international',function (){
Session::remove('locale');
return redirect()->back();
})->name('English');

Route::get('/home', 'HomeController@index')->name('home');

//Customer
Route::get('/dashboard','Customer\dashboard@index')->name('customerdashboard');
Route::get('/sendshipment','Customer\sendshipment@create')->name('sendshipment');
Route::post('/bookshipment','Customer\sendshipment@store')->name('BookShipment');
Route::post('/WeightChecker','Customer\sendshipment@weightChecker')->name('WeightChecker');
Route::post('/bookshipment/unregistered','Customer\sendshipment@storeunregistered')->name('UnregisteredBookShipment');

Route::get('/receiveshipment','Customer\receiveshipment@index')->name('receiveshipment');
Route::get('/received','Customer\receiveshipment@create')->name('ReceiveShipment');
Route::get('/receivedata','Customer\receiveshipment@receivedData')->name('ReceiveData');

Route::get('/terminalcharge','Customer\terminalcharge@create')->name('terminalcharge');

Route::get('/editprofile','Customer\editprofile@create')->name('EditProfileView');
Route::post('/editprofile','Customer\editprofile@store')->name('EditProfile');
Route::post('/resetpassword','Customer\editprofile@resetPassword')->name('ResetPassword');

Route::get('/checkshipment','Customer\checkshipment@create')->name('checkshipment');
Route::post('/searchshipment','Customer\checkshipment@searchShipment')->name('SearchShipment');

Route::get('/cargosechedule','Customer\cargosechedule@index')->name('cargosechedule');
Route::get('/cargo','Customer\cargosechedule@cargoData')->name('GetCargo');

Route::get('/sendclaims','Customer\sendclaims@create')->name('sendclaims');
Route::post('/sendclaims','Customer\sendclaims@store')->name('AddClaims');

Route::get('/cargoloadable','Customer\cargoloadablity@index')->name('cargoloadable');
Route::post('/check','Customer\cargoloadablity@loadableAjax')->name('CheckCargoloadable');

Route::get('/payment/{id}','Customer\payment@show')->name('PaymentView');
Route::post('/paytoaccept','Customer\payment@searchShipment')->name('ShipmentToProcess');
Route::post('/accept','Customer\payment@store')->name('PAY');



//Admin
Route::get('/admin/dashboard','Admin\dashboard@index')->name('AdminDashboard');

Route::get('/admin/forwarders','Admin\manageforwarder@create')->name('AdminForwarder');
Route::post('/admin/forwarders/add','Admin\manageforwarder@store')->name('AdminAddForwarder');
Route::get('/admin/forwarders/list','Admin\manageforwarder@index')->name('AdminForwarderList');
Route::put('/admin/forwarders/','Admin\manageforwarder@update')->name('EditForwarder');
Route::delete('/admin/forwarders/','Admin\manageforwarder@destroy')->name('DeleteForwarder');

Route::get('/admin/deliverers','Admin\managedeliverer@create')->name('AdminDeliverer');
Route::post('/admin/deliverers/add','Admin\managedeliverer@store')->name('AdminAddDeliverer');
Route::get('/admin/deliverers/list','Admin\managedeliverer@index')->name('AdminDelivererList');
Route::put('/admin/deliverers/','Admin\managedeliverer@update')->name('EditDeliverer');
Route::delete('/admin/deliverers/','Admin\managedeliverer@destroy')->name('DeleteDeliverer');

Route::get('/admin/employees/','Admin\manageemployee@create')->name('AdminEmployee');
Route::post('/admin/employees/','Admin\manageemployee@store')->name('AdminAddEmployee');

//Forwarder
Route::get('/forwarder/dashboard','Forwarder\dashboard@index')->name('ForwarderDashboard');
Route::get('/shipment','Forwarder\forwardershipment@create')->name('ForwarderShipment');
Route::get('/processpayment','Forwarder\processpayment@create')->name('ForwarderPayment');
Route::get('/checkclaims','Forwarder\checkclaims@index')->name('ForwarderClaims');
Route::post('/settleclaims','Forwarder\checkclaims@store')->name('SettleClaims');
Route::get('/shipmentdetails/{id}','Forwarder\MoreDetail@show')->name('ShipmentDetails');
Route::post('/processshipment','Forwarder\forwardershipment@store')->name('ProcessShipment');
Route::get('/schedule','Forwarder\cargoschedule@index')->name('FlightSchedule');
Route::post('/flight','Forwarder\cargoschedule@create')->name('CreateSchedule');
Route::get('/addforwarder','Forwarder\addemployee@index')->name('AddForwarderEmployee');
Route::post('/addforwarder','Forwarder\addemployee@store')->name('AddForwarder');
Route::post('/processpayment','Forwarder\processpayment@store')->name('Process');

//Deliverer
Route::get('/deliverer/dashboard','Deliverer\dashboard@index')->name('DelivererDashboard');
Route::get('deliveries','Deliverer\deliveries@create')->name('Deliveries');
Route::get('/delivered/{id}','Deliverer\deliveries@store')->name('Delivered');
Route::get('/adddeliverer','Deliverer\addemployee@create')->name('AddDelivererEmployee');
Route::post('/adddeliverer','Deliverer\addemployee@store')->name('AddDeliverer');




