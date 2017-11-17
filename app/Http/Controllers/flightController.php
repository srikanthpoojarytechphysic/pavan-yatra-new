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
	public function flights(Request $request)
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

		$request->Session()->put('airport_data',json_decode($response->getBody()));

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
    		'source' => substr($request->input('departure'),0,3),
    		'destination' => substr($request->input('destination'),0,3),
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

		try{
			$response = $client->get('http://webapi.i2space.co.in/Flights/AvailableFlights',[

				'query' => $query_params

			]);

		}
		catch(ClientException $e){

    		echo Psr7\str($e->getResponse());
    		exit();


		}
		//storing request parameters and source and destination in session for reference
		$request->Session()->put('passengers' , $query_params);
		$request->Session()->put('search_details' ,['source' => $request->input('departure'),'destination' => $request->input('destination')]);

		$test_var = 'BLR-BENGALURU';

		$journey_info = ['date' => $query_params['journeyDate'],'source' => $query_params['source'],'destination' => substr($query_params['destination'],4),'tripType' => $query_params['tripType']];

		$res = json_decode($response->getBody(),true);

		$totalflight = $res['DomesticOnwardFlights'];

		$returnflight = $res['DomesticReturnFlights'];

		$request->Session()->put('flightdetails',$totalflight);

		// dd($totalflight[0]['FlightSegments'][0]['BaggageAllowed']);

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
	public function flight_checkout($id,Request $request)
	{
		$value = Session('flightdetails');

		$headers = ['ConsumerKey' => '694AAB059FCA4A401220610E8602F10C',
        			'ConsumerSecret' => '1ED23A714D0386CE96EB16977416C7F2',
        			'Content-Type' =>'application/json',
							'Accept-Encoding' => 'gzip,deflate'
    	];


		$client = new Client([
			'headers' => $headers
		]);

		$query_params =[
			'Key' => $value[$id]['OriginDestinationoptionId']['Key'],
			'airlineId' => $value[$id]['FlightSegments'][0]['OperatingAirlineCode'],
			'flightId' => $value[$id]['FlightSegments'][0]['OperatingAirlineFlightNumber'],
			'classCode' => $value[$id]['FlightSegments'][0]['BookingClassFare']['ClassType'],
			'service' => 1,
			'provider' => $value[$id]['Provider'],
			'tripType' =>1,
			'couponFare' =>'',
			'userType' => 5,
			'user' => ''
		];


		try{
			$response = $client->get('http://webapi.i2space.co.in/Flights/GetFareRule',[

				'query' => $query_params

			]);

		}
		catch(ClientException $e){

    		echo Psr7\str($e->getResponse());
    		exit();


		}

		$farerule = json_decode($response->getBody(),true);

		$totalflight = $value[$id]['FlightSegments'];

		$airport_data = Session('airport_data');

		$search_details = Session('search_details');

		$passengers = Session('passengers');

		$json_dat = [
			"Provider" => $value[$id]['Provider'],
			"ImagePath" => $value[$id]['FlightSegments'][0]['ImageFileName'],
			"Rule" => $farerule,
		 	"Key" => $value[$id]['OriginDestinationoptionId']['Key'],
			"OnwardFlightSegments" => [
				$value[$id]['FlightSegments'][0]
			],
			"ReturnFlightSegments" => null,
			"FareDetails" => $value[$id]['FareDetails'],
			"BookingDate" => "16-11-2017",
			 "PromoCode" => null,
			 "PromoCodeAmount" => 0,
			 "PostMarkup" => 0,
			 "IsLCC" => "true",
			 "IsLCCRet" => null,
			 "BookedFrom" => null,
			 "CreatedById" => 0,
			 "IsWallet" => false,
			 "IsPartnerAgentDetails" => null,
			 "OcTax" => 0,
			 "ActualBaseFare" => $value[$id]['FareDetails']['ChargeableFares']['ActualBaseFare'],
			 "Tax" => $value[$id]['FareDetails']['ChargeableFares']['Tax'],
			 "STax" => $value[$id]['FareDetails']['ChargeableFares']['STax'],
			 "SCharge" => $value[$id]['FareDetails']['ChargeableFares']['SCharge'],
			 "TDiscount" => 0,
			 "TPartnerCommission" => 0,
			 "TCharge" => 0,
			 "TMarkup" => 0,
			 "TSdiscount" => 0,
			 "TransactionId" => null,
			 "Conveniencefee" => 0,
			 "EProductPrice" => 0,
			 "ActualBaseFareRet" => 0,
			 "TaxRet" => 0,
			 "STaxRet" => 0,
			 "SChargeRet" => 0,
			 "TDiscountRet" => 0,
			 "TSDiscountRet" => 0,
			 "TPartnerCommissionRet" => 0,
			 "EProductPriceRet" => 0,
			 "TChargeRet" => 0,
			 "TMarkupRet" => 0,
			 "ConveniencefeeRet" => 0,
			 "Source" => substr($search_details['source'],0,3),
			 "SourceName" =>  $airport_data[substr($search_details['source'],4)]->City.', '.$airport_data[substr($search_details['source'],4)]->Country.' - '.'('.substr($search_details['source'],0,3).')-'.$airport_data[substr($search_details['source'],4)]->AirportDesc,
			 "Destination" => substr($search_details['destination'],0,3),
			 "DestinationName" => $airport_data[substr($search_details['destination'],4)]->City.', '.$airport_data[substr($search_details['destination'],4)]->Country.' - '.'('.substr($search_details['destination'],0,3).')-'.$airport_data[substr($search_details['destination'],4)]->AirportDesc,
			 "JourneyDate" => $passengers['journeyDate'],
			 "ReturnDate" => $passengers['returnDate'],
			 "TripType" => (int)$passengers['tripType'],
			 "FlightType" => $passengers['flightType'],
			 "AdultPax" => (int)$passengers['adults'],
			 "ChildPax" => (int)$passengers['children'],
			 "InfantPax" => (int)$passengers['infants'],
			 "TravelClass" => $passengers['travelClass'],
			 "IsNonStopFlight" => false,
			 "FlightTimings" => null,
			 "AirlineName" => null,
			 "User" => null,
			 "UserType" => 5,
			 "IsGDS" => null,
			 "AffiliateId" => null,
			 "WebsiteUrl" => null
		];

		$res = $client->post('http://webapi.i2space.co.in/Flights/GetTaxDetails',[
			'json' => $json_dat
		]);

		$faredetails = json_decode($res->getBody(),true);

		return view('flight.flight-single',['totalflight' => $totalflight, 'farerule' => $farerule,'passengers' => Session('passengers'),'faredetails' => $faredetails]);
	}

}
