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



//Route::get('/shipmentnature','Customer\API\CustomerAPI@getNatureOfShipment')->name('NatureOfShipment');

Route::post('/signup','Customer\API\CustomerAPI@register')->name('SignUp');
Route::post('/login','Customer\API\CustomerAPI@login')->name('LogIn');
Route::get('/cargo','Customer\API\CustomerAPI@cargoData')->name('GetCargo');
Route::post('/terminalcharge','Customer\API\CustomerAPI@terminalCharge')->name('TerminalCharge');
Route::get('/countries','Customer\API\CustomerAPI@getCountries')->name('Countries');
Route::get('/flight','Customer\API\CustomerAPI@getFlightNo')->name('Flight');
Route::get('/deliverer','Customer\API\CustomerAPI@getDeliverers')->name('Deliverer');
Route::post('/WeightChecker','Customer\API\CustomerAPI@weightChecker')->name('WeightChecker');
Route::post('/searchshipment','Customer\API\CustomerAPI@searchShipment')->name('SearchShipment');
Route::post('/check','Customer\API\CustomerAPI@cargoFlight')->name('CheckCargoLoadable');
Route::post('/loadable','Customer\API\CustomerAPI@loadable')->name('Loadable');
Route::get('/carrier','Customer\API\CustomerAPI@carrier')->name('Carrier');
Route::post('/sendclaims','Customer\API\CustomerAPI@sendclaim')->name('AddClaims');
Route::post('/book','Customer\API\CustomerAPI@store')->name('BookingShipment');
Route::post('/edit','Customer\API\CustomerAPI@edituser')->name('EditUser');

Route::group([
    'middleware' => 'auth:api'
], function() {


    Route::get('/logout','Customer\API\CustomerAPI@logout')->name('LogOut');
    Route::get('/user','Customer\API\CustomerAPI@user')->name('User');
    Route::get('/receivedata','Customer\API\CustomerAPI@receivedData')->name('ReceiveData');



//    Route::post('/bookshipment/unregistered','Customer\API\CustomerAPI@storeunregistered')->name('UnregisteredBookShipment');

//
//    Route::post('/pay','Customer\API\CustomerAPI@payment')->name('Payment');


});



