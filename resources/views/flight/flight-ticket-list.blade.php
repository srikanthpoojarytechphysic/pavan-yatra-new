@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="{{URL::asset('/css/snappysnippet.css')}}">
@endsection
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="ticket_list">
				<div class="row">
					<div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
						<span class="flight_count">Found {{count($totalflight)}} Flights</span>
					</div>
					<div class="col-md-4 col-lg-4 col-sm-12 col-xs-12 text_center">
						<h5 class="ticket_route_text">manglore</h5>
							<span>--------></span>
						<h5 class="ticket_route_text">Banglore</h5><br>
						<span style="padding: 10px;display: block;">{{$journey_info['date']}}</span>

					</div>
					<div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
						<div class="modify_search">
							<button class="btn btn-default">Modify Search</button>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12">
						<table class="table">
						    <thead>
						      <tr>
						        <th style="padding-left:50px;">Airline</th>
						        <th>Depart</th>
						        <th>Arrive</th>
						        <th>Duration</th>
						        <th>Price</th>
						      </tr>
						    </thead>
						    <tbody>
						    @foreach($totalflight as $key => $value)

		                @foreach($value['FlightSegments'] as $k => $val)

		                        <tr class="pink-color">
		                            <td style="padding-top: 10px;">
		                                <img class="img-responsive airline_img" src="{{URL::asset('images/indigo.png')}}">
		                                <span class="airline_name">
		                                    {{$val['AirLineName']}} <h5>{{$key}}</h5>
		                                </span>
		                                <span class="airline_code">
		                                    {{$val['OperatingAirlineCode']}}-{{$val['OperatingAirlineFlightNumber']}}
		                                </span>
		                            </td>
		                            <td style="padding-top: 30px;">
		                                {{substr($value['FlightSegments'][0]['DepartureDateTimeZone'],10)}}
		                            </td>
		                            <td style="padding-top: 30px;">
		                                {{substr($val['ArrivalDateTimeZone'],10)}}
		                            </td>
		                            <td style="padding-top: 30px;">
		                                {{$val['Duration']}}
		                                @if($val['IntNumStops']==null)
		                                    <span class="center">Non Stop</span>
		                                @else
		                                    <span class="center">!stop</span>
		                                @endif
		                            </td>
		                            <td>
		                                <button class="btn btn-default pavan_button">
		                                    <strong>Rs.{{$value['FareDetails']['TotalFare']}}</strong>
		                                </button>
		                            </td>
		                        </tr>
		                        <tr>
		                            <td colspan="2" class="bot">hekko</td>
		                            <td colspan="3" class="bot"><i class="fa fa-plane"></i><a data-toggle="modal" data-target="#flightInfo{{$key}}">Flight Details</a></td>
		                        </tr>
		                        <tr>
		                            <td colspan="5" class="spacer"></td>
		                        </tr>											

						         @endforeach

                  @endforeach
						    </tbody>
						</table>
					</div>

                    <!-- Modal -->
                    <!-- for each loop for displaying flight information on sperate modal -->
                 @foreach($totalflight as $key => $value)

                        @foreach($value['FlightSegments'] as $k => $val)


                            <div id="flightInfo{{$key}}" class="modal fade" role="dialog">
                                <div class="modal-dialog" id="flightInfoModal">

                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">Flight Details</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="journey-details">
                                                <span class="inline bold">{{$val['IntDepartureAirportName']}}<i style="margin:0px 10px 0px 10px;" class="fa fa-arrow-right"></i>{{$val['IntArrivalAirportName']}}</span>
                                                <span class="inline">Thu, 2 Nov | $va['Duration'] | @if($val['IntNumStops']==null)
                                                    Non Stop
                                                @else
                                                    {{$val['IntNumStops']}}
                                                @endif
                                                </span>
                                                <div class="price-section">
                                                    <span>Rs.34354</span>
                                                    <button class="btn pavan_button">Book</button>
                                                </div>
                                            </div>
                                            <div class="flighttabs">
                                                <ul class="nav nav-tabs">
                                                    <li class=""><a href="#tab-1{{$key}}" role="tab" data-toggle="tab">first Tab</a></li>
                                                    <li><a href="#tab-2{{$key}}" role="tab" data-toggle="tab">Second Tab</a></li>
                                                </ul>
                                                <div class="tab-content clearfix">
                                                    <div class="tab-pane active" id="tab-1{{$key}}">
                                                        <div class="display_block">
                                                            <span class="label label-default">DEPARTURE <i class="glyphicon glyphicon-plane"></i></span>
                                                        </div>
                                                        <div class="display_block">
                                                            <div id="DIV_1">
                                                                <ul id="UL_2">
                                                                    <li id="LI_3">
                                                                        <i id="I_4"></i> <span id="SPAN_5"> <strong id="STRONG_6">{{$val['OperatingAirlineCode']}} - {{$val['OperatingAirlineFlightNumber']}}</strong><br id="BR_7" /> <small id="SMALL_8">Operated by {{$value['FlightSegments'][0]['AirLineName']}}</small></span>
                                                                    </li>
                                                                    <li id="LI_9">
                                                                        <span id="SPAN_10">{{$val['IntDepartureAirportName']}} ({{$value['RequestDetails']['Source']}})</span><br id="BR_11" /> <strong id="STRONG_12">Thu, 2 Nov, 21:50</strong><br id="BR_13" /> <span id="SPAN_14">Bajpe</span> <span id="SPAN_15">-</span>
                                                                    </li>
                                                                    <li id="LI_16">
                                                                        <i class="fa fa-area-chart"></i>
                                                                        <time id="TIME_18">
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
                                                                            <span id="SPAN_29">Economy Class</span> <span id="SPAN_30"> <span id="SPAN_31">|</span> <span id="SPAN_32">{{$val['BookingClassFare']['Rule']}}</span></span> <span id="SPAN_33"> <span id="SPAN_34">|</span> <span id="SPAN_35"></span></span> <span id="SPAN_36"><span id="SPAN_37">|</span><i class="fa fa-arrows-v"></i></span>
                                                                        </h4>
                                                                    </li>
                                                                    <li id="LI_39">
                                                                        <span id="SPAN_40">{{$val['IntArrivalAirportName']}} ({{$value['RequestDetails']['Destination']}})</span><br id="BR_41" /> <strong id="STRONG_42">Thu, 2 Nov, 22:50</strong><br id="BR_43" /> <span id="SPAN_44">Bengaluru</span> <span id="SPAN_45">-</span>
                                                                    </li>
                                                                </ul>
                                                                <div id="DIV_46">
                                                                    <div id="DIV_47">
                                                                        Change planes at <span id="SPAN_48">()</span>, Connecting Time:<span id="SPAN_49"></span> <span id="SPAN_50">|</span> Connecting flight may depart from a different terminal
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane" id="tab-2{{$key}}">
                                                        <div class="col-md-4">
                                                            <table class="table fare_table">
                                                                <thead>
                                                                <tr>
                                                                    <th>Firstname</th>
                                                                    <th>Lastname</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                <tr>
                                                                    <td>John</td>
                                                                    <td>Doe</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Mary</td>
                                                                    <td>Moe</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>July</td>
                                                                    <td>Dooley</td>
                                                                </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <table class="table fare_table">
                                                                <thead>
                                                                <tr>
                                                                    <th>Firstname</th>
                                                                    <th>Lastname</th>
                                                                    <th>Email</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                <tr>
                                                                    <td>John</td>
                                                                    <td>Doe</td>
                                                                    <td>john@example.com</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Mary</td>
                                                                    <td>Moe</td>
                                                                    <td>mary@example.com</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>July</td>
                                                                    <td>Dooley</td>
                                                                    <td>july@example.com</td>
                                                                </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div
                                            </div>

                                        </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        @endforeach

                    @endforeach
                <!--     //end of for each loop -->
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
