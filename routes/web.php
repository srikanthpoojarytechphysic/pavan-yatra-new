<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/



Auth::routes();

Route::get('/', 'HomeController@index');


Route::get('/tours',[
	'uses' => 'tourController@find_package',
	'as' =>'tour.package'
]);

//----------FLIGHTS---ROUTES-------------//

Route::get('/flights',[
	'uses' => 'flightController@flights',
	'as' =>'flights'
]);

Route::get('/flights/search',[
	'uses' => 'flightController@search_flights',
	'as' => 'search.flights'
	]);

Route::get('/flights/search/s',[
	'uses' => 'flightController@search_flights_s',
	]);

Route::get('/ss',function(){
	return view('flight.flight-ticket-list');
});

Route::get('/flight/checkout/{id}/{return_id?}/',[
	'uses' => 'flightController@flight_checkout',
	'as' => 'flight_checkout'
],function($return_id = 0){
	return $return_id;
});

Route::get('/flight/checkout/pay/{id}/{return_id}/',[
	'uses' => 'flightController@flight_checkout_payment',
	'as' => 'flight_checkout_payment'
]);
//-------END-OF-FLIGHT-ROUTES------------//


//-----------HOTEL-ROUTES----------------//

Route::get('/hotels',[
	'uses' => 'hotelController@hotels',
	'as' => 'search.hotel'
]);

Route::get('/hotels/search',[
	'uses' => 'hotelController@hotels_search',
	'as' => 'search.hotels'
]);
Route::get('/hotels/details/{id}/{query}/{hotelid}/{roomcount}',[

	'uses' => 'hotelController@hotel_single_details',
	'as' => 'single.hotel_details'
]);

Route::get('/hotels/book/payment/{id}/',[
	'uses' => 'hotelController@block_hotel',
	'as'   => 'block.hotel',
]);

Route::get('/hotels/book/payment/blocked/{id}/',[
	'uses' => 'hotelController@hotel_blocked',
	'as'   => 'hotel.blocked.true',
]);


Route::get('/hot',function(Request $request){

	$value          = Session('hotel_total_fare');

	dd($value);

});

Route::get('/fli',function(){
	$res = 'file:///C:/Users/SRIKLAPWC/Desktop/api/response.json';

	$jsondata = file_get_contents($res);

	$total =json_decode($jsondata,true);

	$totalflight = $total['DomesticOnwardFlights'][0]['FlightSegments'];

	dd(Session('totalfare'));
	return view('flight.flight-single',['totalflight' => $totalflight]);
});

//----------END-OF-HOTEL-ROUTES----------//


//--------------payments--routes--------//

Route::get('/flights/payments/pay/{id}/{return_id}/{ref_no}',
[
	'uses' => 'paymentController@authorize_payment',
	'as'   => 'payment.user.form'
]);

Route::POST('/flights/payments/pay/{ref_no}/{id}/{return_id}/verify/',[
	'uses' => 'paymentController@verify_payment',
	'as'   => 'verify.payment.form'
]);

Route::POST('/hotel/payement/pay/{id}/',[
	'uses' => 'paymentController@verify_payment_hotel',
	'as'   => 'verify.payment.hotel'
]);



//--------------END-OF-PAYMENT-ROUTE----//


//--------------ROUTE--FOR--BOOKING--INFO-//

Route::get('/booking/info/{datatype}',[
	'uses' => 'bookingController@booking',
	'as'   => 'booking-info'
]);

Route::get('/booking/info/type/status',[
	'uses' => 'bookingController@bookingStatus',
	'as'   => 'booking_status'
]);

Route::get('/booking/info/type/cancel',[
	'uses' => 'bookingController@cancelTicket',
	'as'   => 'cancel_ticket'
]);
//--------------END-OF-PAYMENT-ROUTE--------//

//--------------MISC routes-----------------//
Route::get('/terms',[
	'uses' => 'miscController@terms',
	'as'   => 'terms'
]);

Route::get('/privacy-policy',[
	'uses' => 'miscController@privacy',
	'as'   => 'privacy'
]);

//---------------END-OF-MISC-ROUTES----------//



//----------------RECHARGE-ROUTES------------//
Route::get('/recharge',[
	'uses' => 'rechargeController@index',
	'as'   => 'recharge.home'
]);







//----------------END-OF-RECHARGE-ROUTES-----//
