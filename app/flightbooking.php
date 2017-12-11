<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class flightbooking extends Model
{
    protected $fillable = ['user_id','reference_no','GDFPNRNo','EticketNo','BookingStatus','TransactionId','onwardflightnumber','onwardpax','returnflightnumber','returnpax','email','mobile','type'];
}
