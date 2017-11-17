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


Route::get('/promo/{id}/{user_id}',[
	'uses' => 'promoController@promo',
	'as' => 'promo'
]);

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

Route::get('flights/search',[
	'uses' => 'flightController@search_flights',
	'as' => 'search.flights'
	]);

Route::get('flights/search/s',[
	'uses' => 'flightController@search_flights_s',
	]);

Route::get('/ss',function(){
	return view('flight.flight-ticket-list');
});

Route::get('/flight/checkout/{id}/',[
	'uses' => 'flightController@flight_checkout',
	'as' => 'flight_checkout'
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
	// return view('hotels.hotels-search-result-list');
	$val = Session('search_details');
	$s = Session('airport_data');
	// dd(substr($s['source'],4));
	// dd($s[0][substr($val)]);
	dd(Session('passengers'));
});

Route::get('/fli',function(){
	$res = 'file:///C:/Users/SRIKLAPWC/Desktop/api/response.json';

	$jsondata = file_get_contents($res);

	$total =json_decode($jsondata,true);

	$totalflight = $total['DomesticOnwardFlights'][0]['FlightSegments'];
	return view('flight.flight-single',['totalflight' => $totalflight]);
});

//----------END-OF-HOTEL-ROUTES----------//
