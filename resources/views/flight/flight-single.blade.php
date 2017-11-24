@extends('layouts.app')


@section('styles')

@endsection
<link rel="stylesheet" href="{{URL::asset('css/snappysnippet.css')}}">
@section('content')
<div class="row">
  <div class="container">
    <div class="col-md-9">
      <div class="ticket_single_block">
        @foreach($totalflight as $val)
        <div class="ticket_single_border">
           <div id="DIV_1" style="width:100% !important;font-family:Raleway,sans-serif;">
               <ul id="UL_2">
                   <li id="LI_3">
                       <i id="I_4"></i>
                       <span id="SPAN_5">
                         <strong id="STRONG_6" style="font-size:19px;font-family:Raleway,sans-serif;">
                           {{$val['OperatingAirlineCode']}}-{{$val['OperatingAirlineFlightNumber']}}
                         </strong><br id="BR_7" />
                           <small id="SMALL_8">
                               Operated by {{$val['AirLineName']}}
                           </small>
                       </span>
                   </li>
                   <li id="LI_9">
                       <span id="SPAN_10" style="font-size:30px;font-family:Raleway,sans-serif;">{{$val['IntDepartureAirportName']}} ({{$val['DepartureAirportCode']}})</span><br id="BR_11" /> <strong id="STRONG_12"style="font-size:12px;">{{$val['DepartureDateTimeZone']}}</strong><br id="BR_13" /> <span id="SPAN_14">Bajpe</span> <span id="SPAN_15">-</span>
                   </li>
                   <li id="LI_16">
                       <i class="fa fa-area-chart"></i>
                       <time id="TIME_18" style="font-size:20px;font-family:Raleway,sans-serif;">
                             {{$val['Duration']}}
                       </time> <span id="SPAN_19">|</span>
                   <span id="SPAN_20">
                       @if($val['IntNumStops']==null)
                           Non Stop
                       @else
                           {{$val['IntNumStops']}}
                       @endif
                   </span><span id="SPAN_21"></span> <span id="SPAN_22">|</span> <span id="SPAN_23">Free Meals</span>
                       <div id="DIV_24">
                           <span id="SPAN_25"></span><i class="fa fa-clock"></i><span id="SPAN_27"></span>
                       </div>
                       <h4 id="H4_28">
                           <span id="SPAN_29">Economy Class</span> <span id="SPAN_30"> <span id="SPAN_31">|</span> <span id="SPAN_32">{{$val['BookingClassFare']['Rule']}}</span></span> <span id="SPAN_33"> <span id="SPAN_34">|</span> <span id="SPAN_35"></span></span>
                           <span id="SPAN_36"><span id="SPAN_37">|</span>
                             <i class="fa fa-arrows-v"></i>
                             {{$val['BaggageAllowed']['HandBaggage']}}
                           </span>
                       </h4>
                   </li>
                   <li id="LI_39">
                       <span id="SPAN_40" style="font-size:30px;font-family:Raleway,sans-serif;">{{$val['IntArrivalAirportName']}} ({{$val['ArrivalAirportCode']}})</span><br id="BR_41" /> <strong id="STRONG_42">{{$val['ArrivalDateTimeZone']}}</strong><br id="BR_43" /> <span id="SPAN_44">Bengaluru</span> <span id="SPAN_45">-</span>
                   </li>
               </ul>
               <div id="DIV_46">
                   <div id="DIV_47">
                       Change planes at <span id="SPAN_48">()</span>, Connecting Time:<span id="SPAN_49"></span> <span id="SPAN_50">|</span> Connecting flight may depart from a different terminal
                   </div>
               </div>
           </div>
        </div>
        @endforeach
     </div>
    </div>
    <div class="col-md-3">
      <h4 style="margin-top:55px;">Fare Details</h4>
      <div class="fare_block">
        <ul class="list-group">
          <li class="list-group-item">Adult {{$passengers['adults']}}<span>RS.{{$faredetails['FareBreakUp']['FareAry'][0]['IntBaseFare']}}</span></li>
          @if($passengers['children'])
           <li class="list-group-item">
             Children {{$passengers['children']}}
             <span>RS.{{$faredetails['FareBreakUp']['FareAry'][1]['IntBaseFare']}}</span>
           </li>
          @endif
          @if($passengers['infants'])
          <li class="list-group-item">
            Infants {{$passengers['infants']}}
            <span>RS.{{$faredetails['FareBreakUp']['FareAry'][2]['IntBaseFare']}}</span>
          </li>
          @endif
          <li class="list-group-item">Tax<span>{{$faredetails['ChargeableFares']['Tax']}}</span></li>
          <li style="height:100px;" class="list-group-item">Total Fare<span style="font-size:27px;"><strong>Rs.{{$faredetails['TotalFare']}}</strong></span></li>
        </ul>
        <center>
          <a href="#" class="" data-toggle="modal" data-target="#myModal">View Fare Rules</a>
        </center>

      </div>
    </div>

    <!-- MODAL FOR DISPALYING FARE DETAILS -->
    <div id="myModal" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 style="text-align:center" class="modal-title">Fare Rules</h4>
          </div>
          <div class="modal-body">
           @php
            echo $farerule
           @endphp
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>

      </div>
    </div>
    <!-- END OF FARE DETAILS MODAL -->
  </div>
</div>
<form method="get" role="form" action="{{route('flight_checkout_payment',['id' => substr(url()->full(),38)])}}">
<div class="row">
  <div class="container">
    <div class="col-lg-12 col-sm-12 col-xs-12">
      <div class="ticket_single_block">
        <div style="height:100%;padding:30px;">
          <h1>Contact Details</h1>
					<div class="col-md-4 col-sm-12 col-xs-12">
						<div>
							<input name="mobile" type="text" id="name" placeholder="Mobile Number" required="required" class="error">
						</div>
					</div>
					<div class="col-md-4 col-sm-12 col-xs-12">
						<div>
							<input name="email" type="email" id="email" placeholder="Email Address" pattern="^[A-Za-z0-9](([_\.\-]?[a-zA-Z0-9]+)*)@([A-Za-z0-9]+)(([\.\-]?[a-zA-Z0-9]+)*)\.([A-Za-z]{2,})$" required="required">
						</div>
					</div>
          <div class="col-lg-12 col-sm-12 col-xs-12">
            <span class="hor_line"></span>
            <h5>Booking Information</h5>
          </div>
          <!-- for adults name boxes -->
          @for($i=1;$i <= (Session('passengers')['adults']);$i++)
          <div class="col-lg-12 col-sm-12 col-xs-12">
            <div class="col-md-4">
              <div style="position:absolute;width:100px;">
                <select style="font-size:21px;padding:0px;" name="person-type-adults{{$i}}">
                  <option value="M">
                    Mr.
                  </option>
                  <option value="F">
                    Ms.
                  </option>
                </select>
                <input type="hidden" value="" id="optionadult" />
              </div>
  						<div style="position:relative;left:100px;padding-right:100px;">
  							<input name="first-name-adult-{{$i}}" type="text" id="first-name" placeholder="First Name" required="required" class="error">
  						</div>
  					</div>
            <div class="col-md-4">
  						<div>
  							<input name="last-name-adult-{{$i}}" type="text" id="last-name" placeholder="Last Name" required="required" class="error">
  						</div>
  					</div>
            <div class="col-md-4 main-search-input-item location date1">
             <div>
               <input type="date" name="adult-age-{{$i}}" id="dob-adult" placeholder="age" required="required" class="datepicker" style="font-size:16px;">

               <!-- <input name="adult-age-{{$i}}" type="text" id="last-name" placeholder="Age" required="required" class="error"> -->
             </div>
           </div>
            <span style="font-size:25px;">Adult {{$i}}</span>
            <span class="hor_line"></span>
          </div>
          @endfor
          <!-- for children name boxes -->
          @if(Session('passengers')['children'])
            @for($i=1;$i <= Session('passengers')['children'];$i++)
            <div class="col-lg-12 col-sm-12 col-xs-12">
              <div class="col-md-4">
                <div style="position:absolute;width:100px;">
                  <select style="font-size:21px;padding: 0px;" name="person-type-children{{$i}}">
                    <option value="M">
                      Mr.
                    </option>
                    <option value="F">
                      Ms.
                    </option>
                  </select>
                  <input type="hidden" value="" id="optionchildren" />

                </div>
               <div style="position:relative;left:100px;padding-right:100px;">
                 <input name="first-name-children-{{$i}}" type="text" id="first-name" placeholder="First Name" required="required" class="error">
               </div>
             </div>
              <div class="col-md-4">
               <div>
                 <input name="last-name-children-{{$i}}" type="text" id="last-name" placeholder="Last Name" required="required" class="error">
               </div>
             </div>
             <div class="col-md-4">
               <div>
                 <input type="date" style="font-size:16px;" name="children-age-{{$i}}" id="dob-children" placeholder="age" required="required" class="datepicker">

                 <!-- <input name="children-age-{{$i}}" type="text" id="last-name" placeholder="age" required="required" class="error"> -->
               </div>
             </div>
              <span style="font-size:25px;">child {{$i}}</span>
              <span class="hor_line"></span>
            </div>
            @endfor
          @endif


          <!-- for infants name boxes -->
          @if(Session('passengers')['infants'])
            @for($i=1;$i <= Session('passengers')['infants'];$i++)
            <div class="col-lg-12 col-sm-12 col-xs-12">
            <div class="col-md-4 col-sm-12 col-xs-12">
              <div style="position:absolute;width:100px;">
                <select style="font-size:21px;padding: 0px;" name="person-type-infant{{$i}}">
                  <option value="M">
                    Master.
                  </option>
                  <option value="F">
                    Miss.
                  </option>
                </select>
                <input type="hidden" value="" id="optionadult" />
              </div>
             <div style="position:relative;left:100px;padding-right:100px;">
               <input name="first-name-infant-{{$i}}" type="text" id="first-name" placeholder="First Name" required="required" class="error">
             </div>
           </div>
            <div class="col-md-4 col-sm-12 col-xs-12">
             <div>
               <input name="last-name-infant-{{$i}}" type="text" id="last-name" placeholder="Last Name" required="required" class="error">
             </div>
           </div>
           <div class="col-md-4">
             <div>
               <input type="date"  style="font-size:16px;" name="infant-age-{{$i}}" id="dob-infant" placeholder="age" required="required" class="datepicker">
               <!-- <input name="infant-age-{{$i}}" type="text" id="last-name" placeholder="age" required="required" class="error"> -->
             </div>
           </div>
            <span style="font-size:25px;">infants 1</span>
          </div>
            @endfor
          @endif
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="container">
    <div class="col-lg-12">
      <div class="ticket_single_block">
        <center style="padding:20px;">
          <button class="btn pavan_button" type="submit">Proceed to payment</button>
        </center>
      </div>
    </div>
  </div>
</div>
</form>
@endsection
@section('scripts')
<script type="text/javascript">
$(document).ready(function(){
    $("#dob-infant").change(function(){
        var mdate = $("#dob-infant").val().toString();
        var yearThen = parseInt(mdate.substring(0,4), 10);
        var monthThen = parseInt(mdate.substring(5,7), 10);
        var dayThen = parseInt(mdate.substring(8,10), 10);

        var today = new Date();
        var birthday = new Date(yearThen, monthThen-1, dayThen);

        var differenceInMilisecond = today.valueOf() - birthday.valueOf();

        var year_age = Math.floor(differenceInMilisecond / 31536000000);
        var day_age = Math.floor((differenceInMilisecond % 31536000000) / 86400000);

        if ((today.getMonth() == birthday.getMonth()) && (today.getDate() == birthday.getDate())) {
            alert("Happy B'day!!!");
        }

        var month_age = Math.floor(day_age/30);

        day_age = day_age % 30;

        if (isNaN(year_age) || isNaN(month_age) || isNaN(day_age)) {
            $("#exact_age").text("Invalid birthday - Please try again!");
        }
        else {
            console.log("You are<br/><span id=\"age\">" + year_age + " years " + month_age + " months " + day_age + " days</span> old");
        }
    });
});
</script>
@endsection
