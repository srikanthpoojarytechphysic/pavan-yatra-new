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
    public function hotel_search()
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
}
