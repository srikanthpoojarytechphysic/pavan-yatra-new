<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Razorpay\Api\Api;


use GuzzleHttp\Client;
use Guzzle\Http\Exception\ClientErrorResponseException;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Exception\BadResponseException;
use GuzzleHttp\Psr7;

use App\flightbooking;

class paymentController extends Controller
{
    public function authorize_payment(Request $request,$id,$return_id,$ref_no= null)
    {
      $value          = Session('flightdetails');

      $return         = Session('returnflight');

      $airport_data   = Session('airport_data');

      $search_details = Session('search_details');

      $passengers     = Session('passengers');

      if(Session('passengers')['tripType'] == 2)
      {
        $return_flight = $return[$return_id];
      }
      else
      {
        $return_flight = null;
      }

      // dd($value[$id]['RequestDetails']['DepartDate']);

      return view('payments.payment-form',[
        'total_flight'  => $value[$id],
        'return_flight' => $return_flight,
        'airport_data'  => $airport_data,
        'passengers'    => $passengers,
        'search_details'=> $search_details
      ]);
    }
    public function verify_payment(Request $request,$ref_no)
    {
      ini_set('max_execution_time', 300);

      $razor_pay_id = $request->get('razorpay_payment_id');

      $amount       = Session('totalfare');

      $api          = new Api('rzp_test_pKL2dR77Wf9ipw', 'Uur6mBi48YdqP8DoGjT34GNm');

      $payment      = $api->payment->fetch($razor_pay_id);

      $res          = $payment->capture(array('amount' => $amount));

      if($res['error_code'] != null)
      {
          dd($res['error_description']);
      }
      else
      {

        $headers = ['ConsumerKey'   => '694AAB059FCA4A401220610E8602F10C',
    		        	'ConsumerSecret'  => '1ED23A714D0386CE96EB16977416C7F2',
    		        	'Content-Type'    =>'application/json',
    		        	'Accept-Encoding' => 'gzip,deflate'
    		];

    		$client = new Client([
    			'headers' => $headers
    		]);

        $query_params =[
          'referenceNo' => $ref_no
        ];

    		try{
    			$response = $client->get('http://webapi.i2space.co.in/Flights/BookFlightTicket',[
            'query' => $query_params
          ]);

    		}
    		catch(ClientException $e){

        		echo Psr7\str($e->getResponse());

        		exit();

    		}
        $bookingdetails   = json_decode($response->getBody(),true);

        $booking_info     = new flightbooking([
          'user_id'       => '1',
          'reference_no'  => $ref_no,
          'GDFPNRNo'      => $bookingdetails['GDFPNRNo'],
          'EticketNo'     => $bookingdetails['EticketNo'],
          'BookingStatus' => $bookingdetails['BookingStatus'],
          'TransactionId' => $bookingdetails['TransactionId'],
        ]);

        $booking_info->save();

         return view('payments.payment-success');

      }
    }
}
