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
        $init = new guzzleHelper();

        $requestQuery = ['referenceNo' => $request->input('ref_no'),'type' => 2];

        try{
          $resultSet = $init->bookingDetails($requestQuery);
        }
        catch(\Exception $e)
        {
          $request->session()->flash('status', 'Opps! The Reference Number Is Not Valid');
          return redirect()->back();
        }

        $booking_info  = flightbooking::where('reference_no',$request->input('ref_no'))->first();

        $request->session()->put(['details' => $resultSet,'booking_info' => $booking_info]);

        return redirect()->back();

    }
    public function cancelTicket(Request $request)
    {
      $booking_info  = flightbooking::where('reference_no',$request->input('ref_no'))->first();

      if($booking_info)
      {
        $query_params  = [
          'referenceNo'         => $booking_info->reference_no,
          'onwardFlightNumbers' => $booking_info->onwardflightnumber,
          'onwardPax'           => $booking_info->onwardpax,
          'returnFlightNumbers' => $booking_info->returnflightnumber,
          'returnPax'           => $booking_info->returnpax,
        ];

        $init = new guzzleHelper($query_params);

        $resultSet = $init->cancelTicket($query_params);

        dd($resultSet);
      }
      else
      {
        $request->session()->flash('status', 'Opps! The Reference Number Is Not Valid');
        return redirect()->back();
      }

    }
}
