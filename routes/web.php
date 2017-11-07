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
//-------END-OF-FLIGHT-ROUTES------------//


//-----------HOTEL-ROUTES----------------//

Route::get('/hotels',[
	'uses' => 'hotelController@hotel_search',
	'as' => 'search.hotel'
]);

Route::get('/hot',function(){
	return view('hotels.hotels-search-result-list');
});


//----------END-OF-HOTEL-ROUTES----------//
