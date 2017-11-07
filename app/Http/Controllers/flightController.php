<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;

use Illuminate\Http\Request;
use Guzzle\Http\Exception\ClientErrorResponseException;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Exception\BadResponseException;

use GuzzleHttp\Psr7;

use DateTime;


class flightController extends Controller
{
	//function for making api request to flight using http request using guzzle package to fetch all the flight route details
	public function flights()
	{

		$headers = ['ConsumerKey' => '694AAB059FCA4A401220610E8602F10C',
		        	'ConsumerSecret' => '1ED23A714D0386CE96EB16977416C7F2',
		        	'Content-Type' =>'application/json',
		        	'Accept-Encoding' => 'gzip,deflate'
		];

		$client = new Client([
			'headers' => $headers
		]);

		try{
			$response = $client->get('http://webapi.i2space.co.in/Flights/Airports?flightType=1');

		}
		catch(ClientException $e){

    		echo Psr7\str($e->getResponse());

    		exit();

		}

		return view('flight.flight-search-page',['response' => json_decode($response->getBody())]);
	}
	public function search_flights_s(Request $request)
	{
		$headers = ['ConsumerKey' => '694AAB059FCA4A401220610E8602F10C',
        			'ConsumerSecret' => '1ED23A714D0386CE96EB16977416C7F2',
        			'Content-Type' =>'application/json',
        			'decode_content' => 'gzip,deflate',
    	];

		$client = new Client([
			'headers' => $headers
		]);

    	$query_params =[
    		'source' => 'IXE',
    		'destination' => 'BLR',
    		'journeyDate' => '11-11-2017',
    		'tripType' => 2,
    		'flightType' => 1,
    		'adults' => 1,
    		'children' =>0,
    		'infants' => 0,
    		'travelClass' => 'E',
    		'userType' => 5,
    		'returnDate' => '14-11-2017'

    	];

    	// dd($query_params);

		try{
			$response = $client->get('http://webapi.i2space.co.in/Flights/AvailableFlights',[

				'query' => $query_params

			]);

		}
		catch(ClientException $e){

    		echo Psr7\str($e->getResponse());

    		exit();

		}

		$res = json_decode($response->getBody(),true);

		$totalflight = $res['DomesticOnwardFlights'];

		$returnflight = $res['DomesticReturnFlights'];

	}
	//function for searching available flights on applied filters

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search_flights(Request $request)
	{

		$headers = ['ConsumerKey' => '694AAB059FCA4A401220610E8602F10C',
        			'ConsumerSecret' => '1ED23A714D0386CE96EB16977416C7F2',
        			'Content-Type' =>'application/json',
							'Accept-Encoding' => 'gzip,deflate'
    	];

		$client = new Client([
			'headers' => $headers
		]);

		if($request->has('return-date'))
		{
			$get_date = DateTime::createFromFormat('Y-m-d', $request->input('return-date'))->format('d-m-Y');
		}
		else
		{
			$get_date = DateTime::createFromFormat('Y-m-d', $request->input('depart-date'))->format('d-m-Y');
		}

    	$query_params =[
    		'source' => $request->input('departure'),
    		'destination' => $request->input('destination'),
    		'journeyDate' => DateTime::createFromFormat('Y-m-d', $request->input('depart-date'))->format('d-m-Y'),
    		'tripType' => $request->input('trip-type'),
    		'flightType' => 1,
    		'adults' => $request->input('adults'),
    		'children' => $request->input('children'),
    		'infants' => $request->input('infants'),
    		'travelClass' => $request->input('air-class'),
    		'userType' => 5,
    		'returnDate' => $get_date

    	];

  //   	// dd($query_params['userType]);


		try{
			$response = $client->get('http://webapi.i2space.co.in/Flights/AvailableFlights',[

				'query' => $query_params

			]);

		}
		catch(ClientException $e){

    		echo Psr7\str($e->getResponse());
    		exit();


		}

		$test_var = 'BLR-BENGALURU';

		$journey_info = ['date' => $query_params['journeyDate'],'source' => $query_params['source'],'destination' => substr($query_params['destination'],4),'tripType' => $query_params['tripType']];

		$res = json_decode($response->getBody(),true);

		$totalflight = $res['DomesticOnwardFlights'];

		$returnflight = $res['DomesticReturnFlights'];

		// $roundtripflights = $res['']

		return view('flight.flight-ticket-list',['returnflight' => $returnflight,'totalflight' => $totalflight,'journey_info' => $journey_info,'test_var' => substr($test_var,4)]);
	//
	// $journey_info = ['date' => $query_params['journeyDate'],'source' => $query_params['source'],'destination' => substr($query_params['destination'],4),'tripType' => $query_params['tripType']];
	//
	// $res = 'file:///C:/Users/SRIKLAPWC/Desktop/api/response.json';
	//
	// $jsondata = file_get_contents($res);
	//
	// $total =json_decode($jsondata,true);
	//
	// $totalflight = $total['DomesticOnwardFlights'];
	//
	// $test_var = 'BLR-BENGALURU';
	//
	// return view('flight.flight-ticket-list',['totalflight' => $totalflight,'journey_info' => $journey_info,'test_var' => substr($test_var,4)]);

	}
}
