<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class paymentController extends Controller
{
    public function authorize_payment(Request $request,$ref_no =null)
    {
      return view('payments.payment-form');
    }
    public function verify_payment(Request $request)
    {
      dd($request->input('hidden'));
    }
}
