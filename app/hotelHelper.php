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

class hotelHelper
{
  public $header;

  public function __construct()
  {
    $this->header = ['ConsumerKey'   => '694AAB059FCA4A401220610E8602F10C',
                     'ConsumerSecret'  => '1ED23A714D0386CE96EB16977416C7F2',
                     'Content-Type'    =>'application/json',
                     'Accept-Encoding' => 'gzip,deflate'
                   ];
  }

  public function getHotelDetails($query)
  {
    $client = new Client([
			'headers' => $this->header
		]);

    try
    {
			$response = $client->get('http://webapi.i2space.co.in/Hotels/HotelDetails',[
        'query' =>$query
      ]);
		}
		catch(ClientException $e)
    {
    		return Psr7\str($e->getResponse());
		}
    catch(RequestException $e)
    {
    		return Psr7\str($e->getResponse());
		}

    return  json_decode($response->getBody(),true);
  }
  //blocking hotel room

  public function blockHotelRoom($query)
  {
    $client = new Client([
     'headers' => $this->header
   ]);

    try
    {
     $response = $client->post('http://webapi.i2space.co.in/Hotels/BlockHotelRoom',[
        'json' =>$query
      ]);
    }
   catch(ClientException $e)
    {
       return Psr7\str($e->getResponse());
    }
    catch(RequestException $e)
    {
       return Psr7\str($e->getResponse());
    }

    return  json_decode($response->getBody(),true);
  }

  public function bookHotelRoom($query)
  {
    $client = new Client([
     'headers' => $this->header
   ]);

    try
    {
     $response = $client->get('http://webapi.i2space.co.in/Hotels/BookHotelRoom',[
        'query' =>$query
      ]);
    }
   catch(ClientException $e)
    {
       return Psr7\str($e->getResponse());
    }
    catch(RequestException $e)
    {
       return Psr7\str($e->getResponse());
    }

    return  json_decode($response->getBody(),true);
  }

}
