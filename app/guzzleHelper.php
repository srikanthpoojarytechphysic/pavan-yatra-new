<?php

namespace App;

use GuzzleHttp\Client;

use Illuminate\Http\Request;
use Guzzle\Http\Exception\ClientErrorResponseException;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Exception\BadResponseException;

use GuzzleHttp\Psr7;

class guzzleHelper
{
  public $header = [];
  public $query;
  public $try;
  public $result;

  public function __construct()
  {
    $this->header = ['ConsumerKey'   => '694AAB059FCA4A401220610E8602F10C',
                     'ConsumerSecret'  => '1ED23A714D0386CE96EB16977416C7F2',
                     'Content-Type'    =>'application/json',
                     'Accept-Encoding' => 'gzip,deflate'
                   ];
  }

  public function cancelTicket($query)
  {
    $client = new Client([
			'headers' => $this->header
		]);

    try
    {
			$response = $client->get('http://webapi.i2space.co.in/Flights/CancelFlightTicket?referenceNo',[
        'query' =>$query
      ]);
		}
		catch(ClientException $e)
    {
    		return Psr7\str($e->getResponse());
		}

    return  json_decode($response->getBody());
  }

  public function bookingDetails($requestQuery)
  {
    $client = new Client([
     'headers' => $this->header
   ]);

    try
    {
     $response = $client->get('http://webapi.i2space.co.in/Flights/FlightTicketBookingDetails?referenceNo',[
        'query' =>$requestQuery
      ]);
   }
   catch(ClientException $e)
    {
       return Psr7\str($e->getResponse());
   }
   catch(RequestException $e)
    {
       throw new \Exception("OOPs!something went wrong");
   }

    return  json_decode($response->getBody(),true);
  }

}
