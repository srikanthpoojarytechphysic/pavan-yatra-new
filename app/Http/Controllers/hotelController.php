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
      $items    = [];
      $i=1;$j=1;$k=1;
      $adults   = [];
      $children = [];
      $childrenAges = [];

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
        $check_in_date  = DateTime::createFromFormat('Y-m-d', $request->input('check-in-date'))->format('d-m-Y');
  			$check_out_date = DateTime::createFromFormat('Y-m-d', $request->input('check-out-date'))->format('d-m-Y');
  		}

      $i = 1;
      while($i <= 4)
      {
        $adults[]   = ($request->input('adults'.$i)) ? $request->input('adults'.$i) : 0;
        $i++;
      }
      while($j <= 4)
      {
        $children[] = ($request->input('children'.$j)) ? $request->input('children'.$j) : 0;
        $j++;
      }
      while($k <= 8)
      {
        $childrenAges[] = -1;
        $k++;
      }

      $request->session()->put('childage',$items);

      $query_params =[
        'destinationId' => $request->input('hotel'),
        'arrivalDate' => $check_in_date,
        'departureDate' => $check_out_date,
        'rooms' => $request->input('rooms'),
        'adults' =>implode("~",$adults),
        'children' => implode("~",$children),
        'childrenAges' => implode("~",$childrenAges),
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

      $request->Session()->put('hoteldata',$hotel_details['AvailableHotels']);

      return view('hotels.hotels-search-result-list',['hotel_details' => $hotel_details]);

    }
    public function hotel_single_details(Request $request,$id,$query,$hotelid,$roomcount)
    {
        $getDetails = Session('hoteldata');

        $userData   = Session('request_details');

        $init =  new hotelHelper();

        $query = [
          'hotelId'       => $getDetails[$id]['HotelId'],
          'webService'    => $getDetails[$id]['WebService'],
          'cityId'        => $userData['destinationId'],
          'provider'      => $getDetails[$id]['Provider'],
          'adults'        => $userData['adults'],
          'children'      => $userData['children'],
          'arrivalDate'   => $userData['arrivalDate'],
          'departureDate' => $userData['departureDate'],
          'noOfDays'      => 1,
          'childrenAges'  => $userData['childrenAges'],
          'roomscount'    => 1,
          'userType'      => 5,
          'hoteltype'     => 1,
          'user'          => '',
       ];

         //
     	   //  $res = 'file:///C:/Users/SRIKLAPWC/Desktop/api/hotel.json';
         //
         // 	$jsondata = file_get_contents($res);
         //
         // 	$total =json_decode($jsondata,true);
         //
         // $sendDetails = $total;
         //
         // dd($sendDetails);


        $sendDetails = $init->getHotelDetails($query);

        dd($sendDetails);

        $request->Session()->put('roomDetails',$sendDetails);

        $facilities  = explode(",",$sendDetails['Facilities']);

        return view('hotels.hotels-details-single',['hotelDetails' => $sendDetails,'facilities' => $facilities]);
    }
    public function block_hotel(Request $request,$id)
    {
      $roomDetails     = Session('roomDetails');

      $requestDetails  = Session('request_details');

      return view('hotels.hotel-blocking-form',['roomDetails' => $roomDetails['RoomDetails'][$id - 1],'roomData' => $roomDetails,'requestDetails' => $requestDetails]);
    }
}
