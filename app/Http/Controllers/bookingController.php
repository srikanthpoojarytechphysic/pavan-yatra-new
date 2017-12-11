<?php

namespace App\Http\Controllers;

use App\guzzleHelper;

use Illuminate\Http\Request;

use App\flightbooking;

class bookingController extends Controller
{
    public function booking($datatype)
    {
      return view('bookinginfo.flight-booking-info');
    }
    public function bookingStatus(Request $request)
    {

      $booking_info  = flightbooking::where('reference_no',$request->input('ref_no'))->first();

      $query_params  = [
        'referenceNo'         => $booking_info->reference_no,
        'onwardFlightNumbers' => $booking_info->onwardflightnumber,
        'onwardPax'           => $booking_info->onwardpax,
        'returnFlightNumbers' => $booking_info->returnflightnumber,
        'returnPax'           => $booking_info->returnpax,
      ];

      $init = new guzzleHelper($query_params);

      $resultSet = $init->cancelTicket();

      echo $resultSet->Message;

    }
}
