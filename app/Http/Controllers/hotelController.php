<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use GuzzleHttp\Client;
use Guzzle\Http\Exception\ClientErrorResponseException;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Exception\BadResponseException;
use GuzzleHttp\Psr7;

use DateTime;

class hotelController extends Controller
{
    public function hotels()
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
      			$response = $client->get('http://webapi.i2space.co.in/Hotels/Cities?hoteltype=1');

      		}
      		catch(ClientException $e){

          		echo Psr7\str($e->getResponse());

          		exit();

      		}

      		return view('hotels.hotels-search-page',['response' => json_decode($response->getBody())]);
    }
    public function hotels_search(Request $request)
    {
      $items = [];
      $i=1;
      $children =  $request->input('no_of_children');

      $headers = ['ConsumerKey' => '694AAB059FCA4A401220610E8602F10C',
                'ConsumerSecret' => '1ED23A714D0386CE96EB16977416C7F2',
                'Content-Type' =>'application/json',
                'Accept-Encoding' => 'gzip,deflate'
      ];

      $client = new Client([
        'headers' => $headers
      ]);

      if($request->has('check-in-date') && $request->has('check-out-date'))
  		{
        $check_in_date= DateTime::createFromFormat('Y-m-d', $request->input('check-in-date'))->format('d-m-Y');
  			$check_out_date= DateTime::createFromFormat('Y-m-d', $request->input('check-out-date'))->format('d-m-Y');
  		}

      if(!$request->input('no_of_children') == 0)
      {
        for ($i=1;$i <= $children;) {
            $items[] = $request->input('child_age'.$i);
            $i++;
        }
      }else
      {
        $items = ['-1'];
      }

      $query_params =[
        'destinationId' => $request->input('hotel'),
        'arrivalDate' => $check_in_date,
        'departureDate' => $check_out_date,
        'rooms' => 1,
        'adults' => $request->input('adults'),
        'children' => $children,
        'childrenAges' => implode("~",$items),
        'NoOfDays' => 1,
        'userType' => 5,
        'hoteltype' => 1,
        'user' => ''
      ];

      try{
        $response = $client->get('http://webapi.i2space.co.in/Hotels/AvailableHotels',[
          'query' => $query_params
        ]);

      }
      catch(ClientException $e){

          echo Psr7\str($e->getResponse());

          exit();

      }

      // dd(json_decode($response->getBody(),true));
      $hotel_details = json_decode($response->getBody(),true);

      // dd($hotel_details['AvailableHotels']);

      return view('hotels.hotels-search-result-list',['hotel_details' => $hotel_details]);

    }
}
