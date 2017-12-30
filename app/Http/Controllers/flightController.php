<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;

use Illuminate\Http\Request;
use Guzzle\Http\Exception\ClientErrorResponseException;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\RequestException;
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
    		'journeyDate' => '18-11-2017',
    		'tripType' => 1,
    		'flightType' => 1,
    		'adults' => 1,
    		'children' =>0,
    		'infants' => 0,
    		'travelClass' => 'E',
    		'userType' => 5,
    		'returnDate' => '18-11-2017'

    	];

			$journey_info = ['date' => $query_params['journeyDate'],'source' => $query_params['source'],'destination' => substr($query_params['destination'],4),'tripType' => $query_params['tripType']];

			$res = 'file:///C:/Users/SRIKLAPWC/Desktop/api/response.json';

			$jsondata = file_get_contents($res);

			$total =json_decode($jsondata,true);

			$totalflight = $total['DomesticOnwardFlights'];
			$returnflight = $total['DomesticReturnFlights'];

			$test_var = 'BLR-BENGALURU';

			dd($returnflight);

			return view('flight.flight-ticket-list',['returnflight' => $returnflight,'totalflight' => $totalflight,'journey_info' => $journey_info,'test_var' => substr($test_var,4)]);

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
							'Accept-Encoding' => 'gzip'
    	];


		$client = new Client([
			'headers' => $headers,
		]);


		if($request->has('return-date'))
		{
			$get_date = DateTime::createFromFormat('M jS,Y', $request->input('return-date'))->format('d-m-Y');
		}
		else
		{
			$get_date = DateTime::createFromFormat('M jS,Y', $request->input('depart-date'))->format('d-m-Y');
		}

    	$query_params =[
    		'source' => substr($request->input('departure'),0,3),
    		'destination' => substr($request->input('destination'),0,3),
    		'journeyDate' => DateTime::createFromFormat('M jS,Y', $request->input('depart-date'))->format('d-m-Y'),
    		'tripType' => $request->input('trip-type'),
    		'flightType' => 1,
    		'adults' => (int)$request->input('adults'),
    		'children' => (int)$request->input('children'),
    		'infants' => (int)$request->input('infants'),
    		'travelClass' => $request->input('air-class'),
    		'userType' => 5,
    		'returnDate' => $get_date

    	];


		try{
			$response = $client->get('http://webapi.i2space.co.in/Flights/AvailableFlights',[

				'query' => $query_params

			]);

		}
		catch(RequestException $e){

    		echo Psr7\str($e->getResponse());
    		exit();
		}
		catch(GuzzleHttp\Exception\RequestException $e){

				echo Psr7\str($e->getResponse());
				exit();
		}
		// storing request parameters and source and destination in session for reference
		$request->Session()->put('passengers' , $query_params);
		$request->Session()->put('search_details' ,['source' => $request->input('departure'),'destination' => $request->input('destination')]);

		$journey_info = ['date' => $query_params['journeyDate'],'source' => $query_params['source'],'destination' => substr($query_params['destination'],4),'tripType' => $query_params['tripType']];

		$res          = json_decode($response->getBody(),true);

		$totalflight  = $res['DomesticOnwardFlights'];

		$returnflight = $res['DomesticReturnFlights'];

		$request->Session()->put('flightdetails',$totalflight);
		$request->Session()->put('returnflight',$returnflight);

		return view('flight.flight-ticket-list',['returnflight' => $returnflight,'totalflight' => $totalflight,'journey_info' => $journey_info]);
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
	// $returnflight = $total['DomesticReturnFlights'];
  //
	// $test_var = 'BLR-BENGALURU';
  //
	// return view('flight.flight-ticket-list',['returnflight' => $returnflight,'totalflight' => $totalflight,'journey_info' => $journey_info,'test_var' => substr($test_var,4)]);

	}
	public function flight_checkout($id,$return_id,Request $request)
	{
		$returnflight = null;$farerule_1 = null;$faredetails_return_flight = null;

		$value = Session('flightdetails');

		$return = Session('returnflight');

		$airport_data = Session('airport_data');

		$search_details = Session('search_details');

		$passengers = Session('passengers');


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
			'tripType' =>$passengers['tripType'],
			'couponFare' =>'',
			'userType' => 5,
			'user' => ''
		];
		if($query_params['tripType'] == 2)
		{
			$query_params_return_flight =[
				'Key' => $return[$return_id]['OriginDestinationoptionId']['Key'],
				'airlineId' => $return[$return_id]['FlightSegments'][0]['OperatingAirlineCode'],
				'flightId' => $return[$return_id]['FlightSegments'][0]['OperatingAirlineFlightNumber'],
				'classCode' => $return[$return_id]['FlightSegments'][0]['BookingClassFare']['ClassType'],
				'service' => 1,
				'provider' => $return[$return_id]['Provider'],
				'tripType' =>$passengers['tripType'],
				'couponFare' =>'',
				'userType' => 5,
				'user' => ''
			];

		}
		//try blovk
		try{

			$response = $client->get('http://webapi.i2space.co.in/Flights/GetFareRule',[

				'query' => $query_params

			]);

			if($query_params['tripType'] == 2)
			{
				$return_data = $client->get('http://webapi.i2space.co.in/Flights/GetFareRule',[

					'query' => $query_params_return_flight

				]);
			}

		}
		catch(ClientException $e){

    		echo Psr7\str($e->getResponse());
    		exit();


		}


		if($query_params['tripType'] == 2)
		{
			$farerule_1 = json_decode($return_data->getBody(),true);
			$request->Session()->put('farerule_1',$farerule_1);
		}

		//put the FareDetails in the session
		$farerule = json_decode($response->getBody(),true);
		$request->Session()->put('farerule',$farerule);

		$totalflight = $value[$id]['FlightSegments'];

		$json_dat = [
			"Provider" => $value[$id]['Provider'],
			"ImagePath" => $value[$id]['FlightSegments'][0]['ImageFileName'],
			"Rule" => $farerule,
		 	"Key" => $value[$id]['OriginDestinationoptionId']['Key'],
			"OnwardFlightSegments" => $value[$id]['FlightSegments'],
			"ReturnFlightSegments" => null,
			"FareDetails" => $value[$id]['FareDetails'],
			"BookingDate" => date('d-m-y'),
			 "PromoCode" => null,
			 "PromoCodeAmount" => 0,
			 "PostMarkup" => 0,
			 "BookedFrom" => null,
			 "CreatedById" => 0,
			 "IsWallet" => false,
			 "IsPartnerAgentDetails" => null,
			 "OcTax" => $value[$id]['FlightSegments'][0]['OcTax'],
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
			 "IsLCC" =>$value[$id]['IsLCC'],
			 "WebsiteUrl" => null
		];

		if($query_params['tripType'] == 2)
		{
			$json_dat_return_flight = [
				"Provider" => $return[$return_id]['Provider'],
				"ImagePath" => $return[$return_id]['FlightSegments'][0]['ImageFileName'],
				"Rule" => $farerule,
				"RuleRet" => $farerule_1,
			 	"Key" => $value[$id]['OriginDestinationoptionId']['Key'],
				"KeyRet" =>$return[$return_id]['OriginDestinationoptionId']['Key'],
				"OnwardFlightSegments" => $value[$id]['FlightSegments'],
				"ReturnFlightSegments" => $return[$return_id]['FlightSegments'],
				"FareDetails" => $return[$return_id]['FareDetails'],
				"BookingDate" => date('d-m-y'),
				 "PromoCode" => null,
				 "PromoCodeAmount" => 0,
				 "PostMarkup" => 0,
				 "IsLCC" =>$value[$id]['IsLCC'],
				 "IsLCCRet" =>$return[$return_id]['IsLCC'],
				 "BookedFrom" => null,
				 "CreatedById" => 0,
				 "IsWallet" => false,
				 "IsPartnerAgentDetails" => null,
				 "OcTax" => 0,
				 "ActualBaseFare" => $value[$return_id]['FareDetails']['ChargeableFares']['ActualBaseFare'],
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
				 "ActualBaseFareRet" => $return[$return_id]['FareDetails']['ChargeableFares']['ActualBaseFare'],
 				 "TaxRet" => $return[$return_id]['FareDetails']['ChargeableFares']['Tax'],
 				 "STaxRet" => $return[$return_id]['FareDetails']['ChargeableFares']['STax'],
 				 "SChargeRet" => $return[$return_id]['FareDetails']['ChargeableFares']['SCharge'],
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
			$returnflight = $return[$return_id]['FlightSegments'];
		}

		try
		{
			$res = $client->post('http://webapi.i2space.co.in/Flights/GetTaxDetails',[
				'json' => $json_dat
			]);

			if($query_params['tripType'] == 2)
			{
				$return_get_data = $client->post('http://webapi.i2space.co.in/Flights/GetTaxDetails',[
					'json' => $json_dat_return_flight
				]);
			}
		}
		catch(ClientException $e){
    		echo Psr7\str($e->getResponse());
    		exit();
		}


		$faredetails = json_decode($res->getBody(),true);

		if($query_params['tripType'] == 2)
		{
			$faredetails_return_flight = json_decode($return_get_data->getBody(),true);
			// dd($faredetails_return_flight);
			$total_fare_2 = $faredetails_return_flight['TotalFare'];
			$total_tax_2 = $faredetails_return_flight['ChargeableFares']['Tax'];
			(Session('passengers')['adults']>=1) ? $adult_fare = $faredetails_return_flight['FareBreakUp']['FareAry'][0]['IntBaseFare']:$adult_fare = 0;
			(Session('passengers')['children']>=1) ? $child_fare = $faredetails_return_flight['FareBreakUp']['FareAry'][1]['IntBaseFare']:$child_fare = 0;
			(Session('passengers')['infants']>=1) ? $infant_fare = $faredetails_return_flight['FareBreakUp']['FareAry'][2]['IntBaseFare']:$infant_fare = 0;
		}
		else {
			$adult_fare = 0;
			$child_fare = 0;
			$infant_fare = 0;
			$total_fare_2 = 0;
			$total_tax_2 = 0;
		}

		$total_final_fare = $faredetails['TotalFare'] + $total_fare_2;

		$request->session()->put('totalfare',(int)$total_final_fare * 100);

			return view('flight.flight-single',[
			'totalflight'  => $totalflight,
			'returnflight' => $returnflight,
			'farerule'     => $farerule,
			'farerule_1'   => $farerule_1,
			'passengers'   => Session('passengers'),
			'faredetails'  => $faredetails,
			'faredetails_return' => $faredetails_return_flight,
			'adult_fare'   => $adult_fare,
			'child_fare'   => $child_fare,
			'infant_fare'  => $infant_fare,
			'total_fare_2' => $total_fare_2,
			'total_tax_2'  => $total_tax_2
		]);
	}




	public function flight_checkout_payment(Request $request,$id,$return_id)
	{
		ini_set('max_execution_time', 300);
		// extarcting all session variables

		$data           = explode('/',url()->full());
		$id             = $data[6];
		$return_data_id = explode('?',$data[7]);
		$return_id      = $return_data_id[0];
		$i=1;
		$j=1;
		$l=1;
		$adults = [];
		$age    = [];
		$gender = [];
		$gender_type = '';
		$date_of_birth  = [];
		$airport_data   = Session('airport_data');
		$search_details = Session('search_details');
		$passengers     = Session('passengers');
		$farerule       = Session('farerule');
		$farerule_1     = Session('farerule_1');
		$return         = Session('returnflight');

			while($i <= $passengers['adults'])
			{
				if($gender_type = $request->input('person-type-adults'.$i) == "M")
				{
					$gender_type  = "Mr.";
				}
				else {
					$gender_type  = "Ms.";
				}
				$gender[]       = $request->input('person-type-adults'.$i);
				$adults[]       = $gender_type.'|'.$request->input('first-name-adult-'.$i).'|'.$request->input('last-name-adult-'.$i).'|ADT';
				$date_of_birth[]= DateTime::createFromFormat('Y-m-d',$request->input('adult-age-'.$i))->format('d-m-Y');
				$today          = date("Y-m-d");
				$diff           = date_diff(date_create($request->input('adult-age-'.$i)), date_create($today));
				$age[]          = $diff->format('%y');
				$i++;
			}
			//for children details
			while($j <= $passengers['children'])
			{
				if($gender_type = $request->input('person-type-children'.$j) == "M")
				{
					$gender_type  = "Mstr.";
				}
				else {
					$gender_type  = "Mstr.";
				}
				$gender[]       = $request->input('person-type-children'.$j);
				$adults[]       = $gender_type.'|'.$request->input('first-name-children-'.$j).'|'.$request->input('last-name-children-'.$j).'|CHD';
				$date_of_birth[]= DateTime::createFromFormat('Y-m-d',$request->input('children-age-'.$j))->format('d-m-Y');
				$today          = date("Y-m-d");
				$diff           = date_diff(date_create($request->input('children-age-'.$j)), date_create($today));
				$age[]          = $diff->format('%y');
				$j++;
			}
			while($l <= $passengers['infants'])
			{
				if($gender_type = $request->input('person-type-infant'.$l) == "M")
				{
					$gender_type  = "Mstr.";
				}
				else {
					$gender_type  = "Mstr.";
				}
				$gender[]       = $request->input('person-type-infant'.$l);
				$adults[]       = $gender_type.'|'.$request->input('first-name-infant-'.$l).'|'.$request->input('last-name-infant-'.$l).'|INF';
				$date_of_birth[]= DateTime::createFromFormat('Y-m-d',$request->input('infant-age-'.$l))->format('d-m-Y');
				$today          = date("Y-m-d");
				$diff           = date_diff(date_create($request->input('infant-age-'.$l)), date_create($today));
				$age[]          = $diff->format('%y');
				$l++;
			}

		$value   = Session('flightdetails');

		$request->session()->put('contact_details',['0' => $request->input('email'),'1' => $request->input('mobile')]);
		$request->session()->put('user_details',['adults' => $adults]);

		$headers = ['ConsumerKey' => '694AAB059FCA4A401220610E8602F10C',
        			'ConsumerSecret' => '1ED23A714D0386CE96EB16977416C7F2',
        			'Content-Type' =>'application/json',
							'Accept-Encoding' => 'gzip,deflate'
    	];

		$client = new Client([
			'headers' => $headers,
			'timeout' => 200,
		]);


		$json_dat = [
			"Provider" => $value[$id]['Provider'],
			"Names" => implode("~",$adults),
			"ages" => implode("~",$age),
			"Genders" => implode("~",$gender),
			"telePhone" => "",
			"MobileNo" => $request->input('mobile'),
			"EmailId" => $request->input('email'),
			"dob" => implode("~",$date_of_birth),
			"psgrtype" => "",
			"Address" => $request->input('address'),
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
			"Rule" => $farerule,
		 	"Key" => $value[$id]['OriginDestinationoptionId']['Key'],
			"flightId" => $value[$id]['FlightSegments'][0]['OperatingAirlineFlightNumber'],
			"OnwardFlightSegments" => $value[$id]['FlightSegments'],
			"ReturnFlightSegments" => null,
			"FareDetails" => $value[$id]['FareDetails'],
			"BookingDate" => date('d-m-y'),
			 "PromoCode" => null,
			 "PromoCodeAmount" => 0,
			 "PostMarkup" => 0,
			 "IsLCC" =>$value[$id]['IsLCC'],
			 "IsLCCRet" => null,
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
			 "IsNonStopFlight" => false,
			 "FlightTimings" => null,
			 "AirlineName" => null,
			 "User" => null,
			 "UserType" => 5,
			 "IsGDS" => null,
			 "AffiliateId" => null,
			 "WebsiteUrl" => null
		];

		if(Session('passengers')['tripType'] == 2)
		{
			$json_dat_return_flight = [
				"Provider" => $return[$return_id]['Provider'],
				"Names" => implode("~",$adults),
				"ages" => implode("~",$age),
				"Genders" => implode("~",$gender),
				"telePhone" => "",
				"MobileNo" => $request->input('mobile'),
				"EmailId" => $request->input('email'),
				"dob" => implode("~",$date_of_birth),
				"psgrtype" => "",
				"Address" => "karnataka",
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
				"Rule" => $farerule,
				"RuleRet" =>$farerule_1,
				"Key" => $value[$id]['OriginDestinationoptionId']['Key'],
				"KeyRet" =>$return[$return_id]['OriginDestinationoptionId']['Key'],
				"FlightId" => "",
				"OnwardFlightSegments" => $value[$id]['FlightSegments'],
				"ReturnFlightSegments" => $return[$return_id]['FlightSegments'],
				"FareDetails" => $value[$id]['FareDetails'],
				"BookingDate" => date('d-m-y'),
				 "PromoCode" => null,
				 "PromoCodeAmount" => 0,
				 "PostMarkup" => 0,
				 "IsLCC" =>$value[$id]['IsLCC'],
				 "IsLCCRet" => $return[$return_id]['IsLCC'],
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
				 "ConveniencefeeRet" => 0,
				 "EProductPrice" => 0,
				 "ActualBaseFareRet" => $return[$return_id]['FareDetails']['ChargeableFares']['ActualBaseFare'],
				 "TaxRet" => $return[$return_id]['FareDetails']['ChargeableFares']['Tax'],
				 "STaxRet" => $return[$return_id]['FareDetails']['ChargeableFares']['STax'],
				 "SChargeRet" => $return[$return_id]['FareDetails']['ChargeableFares']['SCharge'],
				 "TDiscountRet" => 0,
				 "TSDiscountRet" => 0,
				 "TPartnerCommissionRet" => 0,
				 "EProductPriceRet" => 0,
				 "TChargeRet" => 0,
				 "TMarkupRet" => 0,
				 "ConveniencefeeRet" => 0,
				 "IsNonStopFlight" => false,
				 "FlightTimings" => null,
				 "AirlineName" => null,
				 "User" => null,
				 "UserType" => 5,
				 "IsGDS" => null,
				 "AffiliateId" => null,
				 "WebsiteUrl" => null

			];

		}

		// dd($json_dat_return_flight);
		try
		{
			if(Session('passengers')['tripType'] == 2)
			{
				$return_post = $client->post('http://webapi.i2space.co.in/Flights/BlockFlightTicket',[
					'json' => $json_dat_return_flight
				]);
			}
			else
			{
					$res = $client->post('http://webapi.i2space.co.in/Flights/BlockFlightTicket',[
						'json' => $json_dat
					]);
			}
		}
		catch (RequestException $e) {

    // Catch all 4XX errors

    // To catch exactly error 400 use
	    // if ($e->getResponse()->getStatusCode() == '400') {
	    //         echo "Got response 400";
	    // }
			return view('error.500');
			exit();
		}
		catch(ServerException $e)
		{
			return view('error.500',['status' => Psr7\str($e->getResponse())]);
		}
		catch(ClientException $e){

			return view('error.500',['status' => Psr7\str($e->getResponse())]);
		}

		if(Session('passengers')['tripType'] == 1)
			{
				$faredetails  = json_decode($res->getBody(),true);

				$reference_no = $faredetails['ReferenceNo'];

				if($faredetails['BookingStatus'] == 16)
				{
					return view('error.500',['status' => $faredetails['Message']]);
					exit;
				}
					return redirect()->route('payment.user.form',['ref_no' => $reference_no,'id' => $id,'return_id' => $return_id]);
			}
			else
			{
				$faredetails_1 = json_decode($return_post->getBody(),true);


				$reference_no  = $faredetails_1['ReferenceNo'];

				if($faredetails_1['BookingStatus'] == 16)
				{
					return view('error.500',['status' => $faredetails_1['Message']]);
					exit;
				}

				return redirect()->route('payment.user.form',['ref_no' => $reference_no,'id' => $id,'return_id' => $return_id]);

				// return view('payments.payment-form',['reference_no' => $reference_no]);
			}
			// return view('payments.payment-form',['reference_no' => $reference_no]);
		}

}
