<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\hotelHelper;

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

      $request->session()->put('childage',$items);

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
      ];


      $request->Session()->put('request_details',$query_params);

      try{
        $response = $client->get('http://webapi.i2space.co.in/Hotels/AvailableHotels',[
          'query' => $query_params
        ]);

        $request->Session()->forget('hoteldata');

      }
      catch(ClientException $e){
          echo Psr7\str($e->getResponse());
          exit();
      }

      // dd(json_decode($response->getBody(),true));
      $hotel_details = json_decode($response->getBody(),true);

      // dd($hotel_details['AvailableHotels']);

      $request->Session()->put('hoteldata',$hotel_details['AvailableHotels']);

      return view('hotels.hotels-search-result-list',['hotel_details' => $hotel_details]);

    }
    public function hotel_single_details(Request $request,$id,$query,$hotelid,$roomcount)
    {
        $getDetails = Session('hoteldata');

        $items = [];

        $userData   = explode("&",$query);

        // dd(substr($userData[0],0));

        $init =  new hotelHelper();

        $query = [
          'hotelId'       => $getDetails[$id]['HotelId'],
          'webService'    => $getDetails[$id]['WebService'],
          'cityId'        => substr($userData[4],6),
          'provider'      => $getDetails[$id]['Provider'],
          'adults'        => substr($userData[0],7),
          'children'      => substr($userData[5],14),
          'arrivalDate'   => DateTime::createFromFormat('Y-m-d',substr($userData[1],14))->format('d-m-Y'),
          'departureDate' => DateTime::createFromFormat('Y-m-d',substr($userData[2],15))->format('d-m-Y'),
          'noOfDays'      => 1,
          'childrenAges'  => implode("~",Session('childage')),
          'roomscount'    => 1,
          'userType'      => 5,
          'hoteltype'     => 1,
          'user'          => '',
       ];


     	   //  $res = 'file:///C:/Users/SRIKLAPWC/Desktop/api/hotel.json';
         //
         // 	$jsondata = file_get_contents($res);
         //
         // 	$total =json_decode($jsondata,true);
         //
         // $sendDetails = $total;

        $sendDetails = $init->getHotelDetails($query);
        $facilities  = explode(",",$sendDetails['Facilities']);

        return view('hotels.hotels-details-single',['hotelDetails' => $sendDetails,'facilities' => $facilities]);
    }
}
