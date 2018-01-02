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

//putting all session variables to further life cycle of the application

      $request->session()->put('childage',$items);
      $request->session()->put('city_name',$request->input('hotel_id_hidden'));

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


        // dd($sendDetails);

        $request->Session()->put('roomDetails',$sendDetails);

        $facilities  = explode(",",$sendDetails['Facilities']);

        if($sendDetails['HotelName'] == null)
        {
          return view('errors.hotels-details-single-error');
        }
        else
        {
          return view('hotels.hotels-details-single',['hotelDetails' => $sendDetails,'facilities' => $facilities]);
        }

    }
    public function block_hotel(Request $request,$id)
    {
      $roomDetails     = Session('roomDetails');

      $requestDetails  = Session('request_details');

      $room_1_adults   = explode("~",$requestDetails['adults'])[0];

      $room_2_adults   = explode("~",$requestDetails['adults'])[1];

      $room_3_adults   = explode("~",$requestDetails['adults'])[2];

      $room_4_adults   = explode("~",$requestDetails['adults'])[3];

      $room_1_child    = explode("~",$requestDetails['children'])[0];

      $room_2_child    = explode("~",$requestDetails['children'])[1];

      $room_3_child    = explode("~",$requestDetails['children'])[2];

      $room_4_child    = explode("~",$requestDetails['children'])[3];


      return view('hotels.hotel-blocking-form',[
        'roomDetails'    => $roomDetails['RoomDetails'][$id - 1],
        'roomData'       => $roomDetails,
        'requestDetails' => $requestDetails,
        'room_1_adults'  => $room_1_adults,
        'room_2_adults'  => $room_2_adults,
        'room_3_adults'  => $room_3_adults,
        'room_4_adults'  => $room_4_adults,
        'room_1_child'   => $room_1_child,
        'room_2_child'   => $room_2_child,
        'room_3_child'   => $room_3_child,
        'room_4_child'   => $room_4_child,
      ]);
    }

    public function hotel_blocked($id,Request $request)
    {
      ini_set('max_execution_time', 300);

      $adults = [];

      $i = 0;

      $j = $k = $l = $m =0;

     //extractionf neccessary session details
      $room_count = Session('request_details')['adults'];

      $hotelDetails = Session('hoteldata');

      $roomDetails = Session('roomDetails');
      $requestDetails = Session('request_details');

      $roomDetails_fare = Session('roomDetails')['RoomDetails'][$id-1];


      //store the total price in variables


      $hotel_total_price = ((((int)$roomDetails_fare['RoomTotal'] + (int)$roomDetails_fare['ExtGuestTotal']) * (int)$requestDetails['NoOfDays']) + (int)$roomDetails_fare['ServicetaxTotal']) * 100;


      //initialize hotel helper class
      $init = new hotelHelper();


    //room 1 count  for adults
      while($i < explode("~",$room_count)[0])
      {

        // $adults[] = 2;
        if($gender_type = $request->input('room-1-adults-'.$i) == "M")
				{
					$gender_type  = "Mr.";
				}
				else {
					$gender_type  = "Ms.";
				}
				$gender[]       = $request->input('room-1-adults-'.$i);
				$adults[]       = ($request->input('room-1-first-name-adult-'.$i)) ? $gender_type.'|'.$request->input('room-1-first-name-adult-'.$i).'|'.$request->input('room-1-last-name-adult-'.$i).'|ADT' : 0;
				$date_of_birth[]= ($request->input('room-1-adult-age-'.$i)) ? DateTime::createFromFormat('Y-m-d',$request->input('room-1-adult-age-'.$i))->format('d-m-Y') : 0;
				$today          = date("Y-m-d");
				$diff           = date_diff(date_create($request->input('room-1-adult-age-'.$i)), date_create($today));
				$age[]          = $diff->format('%y');
        $i++;
      }


      //rooom 2 count for Adults

      while($j < explode("~",$room_count)[1])
      {

        // $adults[] = 2;
        if($gender_type = $request->input('room-2-adults-'.$i) == "M")
        {
          $gender_type  = "Mr.";
        }
        else {
          $gender_type  = "Ms.";
        }
        $gender[]       = $request->input('room-2-adults-'.$j);
        $adults[]       = ($request->input('room-2-first-name-adult-'.$j)) ? $gender_type.'|'.$request->input('room-2-first-name-adult-'.$j).'|'.$request->input('room-2-last-name-adult-'.$j).'|ADT' : 0;
        $date_of_birth[]= ($request->input('room-2-adult-age-'.$j)) ? DateTime::createFromFormat('Y-m-d',$request->input('room-2-adult-age-'.$j))->format('d-m-Y') : 0;
        $today          = date("Y-m-d");
        $diff           = date_diff(date_create($request->input('room-2-adult-age-'.$j)), date_create($today));
        $age[]          = $diff->format('%y');
        $j++;
      }

      //room 3 count for Adults

      while($k < explode("~",$room_count)[2])
      {

        // $adults[] = 2;
        if($gender_type = $request->input('room-3-adults-'.$k) == "M")
        {
          $gender_type  = "Mr.";
        }
        else {
          $gender_type  = "Ms.";
        }
        $gender[]       = $request->input('room-3-adults-'.$k);
        $adults[]       = ($request->input('room-3-first-name-adult-'.$k)) ? $gender_type.'|'.$request->input('room-3-first-name-adult-'.$k).'|'.$request->input('room-3-last-name-adult-'.$k).'|ADT' : 0;
        $date_of_birth[]= ($request->input('room-3-adult-age-'.$k)) ? DateTime::createFromFormat('Y-m-d',$request->input('room-3-adult-age-'.$k))->format('d-m-Y') : 0;
        $today          = date("Y-m-d");
        $diff           = date_diff(date_create($request->input('room-3-adult-age-'.$k)), date_create($today));
        $age[]          = $diff->format('%y');
        $k++;
      }

      //room 4 count for Adults

      while($l < explode("~",$room_count)[3])
      {

        // $adults[] = 2;
        if($gender_type = $request->input('room-4-adults-'.$l) == "M")
        {
          $gender_type  = "Mr.";
        }
        else {
          $gender_type  = "Ms.";
        }
        $gender[]       = $request->input('room-4-adults-'.$l);
        $adults[]       = ($request->input('room-4-first-name-adult-'.$l)) ? $gender_type.'|'.$request->input('room-4-first-name-adult-'.$l).'|'.$request->input('room-4-last-name-adult-'.$l).'|ADT' : 0;
        $date_of_birth[]= ($request->input('room-4-adult-age-'.$l)) ? DateTime::createFromFormat('Y-m-d',$request->input('room-4-adult-age-'.$l))->format('d-m-Y') : 0;
        $today          = date("Y-m-d");
        $diff           = date_diff(date_create($request->input('room-4-adult-age-'.$l)), date_create($today));
        $age[]          = $diff->format('%y');
        $l++;
      }

        $json_body = [
          'Adults'           => Session('request_details')['adults'],
          'Ages'             => implode("~",$age),
          'ArrivalDate'       => Session('request_details')['arrivalDate'], //info in session has been mixed up
          'DepartureDate'    => Session('request_details')['departureDate'],     // so here were are using alternate dates
          'Children'         => Session('request_details')['children'],
          'ChildrenAges'     => Session('request_details')['childrenAges'],
          'CityName'         => Session('city_name'),
          'Country'          => 'INDIA',
          'DestinationId'    => Session('request_details')['destinationId'],
          'EmailId'          => $request->input('email'),
          'Genders'          => implode("~",$gender),
          'HotelDetail'      => [
                                   'City' => $roomDetails['City'],
                                   'Description' => $roomDetails['Description'] ,
                                   'Facilities' => $roomDetails['Facilities'],
                                   'HotelAddress' => $roomDetails['HotelAddress'],
                                   'HotelName' => $roomDetails['HotelName'],
                                   'Provider' => $roomDetails['Provider'],
                                   'RoomChain' => $roomDetails['RoomChain'],
                                   'RoomCombination' => $roomDetails['RoomCombination'],
                                   'StarRating' => $roomDetails['StarRating'],
                                   'RPH' => $roomDetails['RPH'],
                                   'WebService' => $roomDetails['WebService']
                                ],
          'HotelId'          => $roomDetails['HotelId'],
          'HotelPolicy'      => $roomDetails['RoomDetails'][$id-1]['RoomCancellationPolicy'],
          'HotelType'        => 1,
          'IsOfflineBooking' => false,
          'MobileNo'         => $request->input('mobile'),
          'Names'            => implode("~",$adults),
          'Nationality'      => 'IN',
          'NoOfdays'         => 1,
          'Provider'         => $roomDetails['Provider'],
          'RoomDetails'      => [$roomDetails['RoomDetails'][$id-1]],
          'Rooms'            => Session('request_details')['rooms'],
          'UserType'         => 5,
          'Status'           => 1,
          'User'             => ''
        ];

// return response()->json($json_body);
// exit;

        $blockingInfo = $init->blockHotelRoom($json_body);

        $reference_no = $blockingInfo['ReferenceNo'];

        if($blockingInfo['BookingStatus'] == 1)
        {
          $request->session()->put('refernce_no',$reference_no);
          $request->session()->put('hotel_total_fare',$hotel_total_price);

          return redirect()->back()->with('status',1);
        }
        else
        {
          return view('error.500',['status' => $blockingInfo['Message']]);
        }
    }
}
