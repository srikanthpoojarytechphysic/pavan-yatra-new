<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class rechargeController extends Controller
{
    public function index()
    {
      return view('recharge.recharge-home');
    }
}
