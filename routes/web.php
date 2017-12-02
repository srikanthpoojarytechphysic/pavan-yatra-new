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
Route::get('/hotels/details/{id}/{query}/{hotelid}/{provider}/{roomcount}',[

	'uses' => 'hotelController@hotel_single_details',
	'as' => 'single.hotel_details'
]);

Route::get('/hot',function(Request $request){
	$airport_data   = Session('airport_data');
	$search_details = Session('search_details');
	$value = $airport_data[substr($search_details['destination'],4)]->City;

	$v = Session('passengers');
	dd($v);

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

Route::get('/flights/payments/pay/{ref_no}/',[
	'uses' => 'paymentController@authorize_payment',
	'as'   => 'payment.user.form'
]);

Route::POST('/flights/payments/pay/{ref_no}/verify',[
	'uses' => 'paymentController@verify_payment',
	'as'   => 'verify.payment.form'
]);

//--------------END-OF-PAYMENT-ROUTE----//
