<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class tourController extends Controller
{
    public function find_package()
    {
    	return view('tour_package');
    }
}
