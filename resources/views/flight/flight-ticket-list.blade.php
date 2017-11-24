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
					<div class="@if($journey_info['tripType']==1)
					col-lg-12
					@else
					col-lg-6
					@endif">
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
												@if($loop->first)
		                        <tr class="pink-color">
		                            <td style="padding-top: 10px;width:200px;">
		                                <img class="img-responsive airline_img" src="{{URL::asset('images/indigo.png')}}">
		                                <span class="airline_name">
		                                    {{$val['AirLineName']}} <h5>{{$key}}</h5>
		                                </span>
		                                <span class="airline_code">
																			@foreach($value['FlightSegments'] as $r => $s)
																				@if($loop->count==1)
																						{{$value['FlightSegments'][0]['OperatingAirlineCode']}}-{{$value['FlightSegments'][0]['OperatingAirlineFlightNumber']}}
																						@break
																				@elseif($loop->count==2)
																						{{$value['FlightSegments'][0]['OperatingAirlineCode']}}-{{$value['FlightSegments'][0]['OperatingAirlineFlightNumber']}}/{{$value['FlightSegments'][1]['OperatingAirlineFlightNumber']}}
																						@break
																				@elseif($loop->count==3)
																						{{$value['FlightSegments'][0]['OperatingAirlineCode']}}-{{$value['FlightSegments'][0]['OperatingAirlineFlightNumber']}}/{{$value['FlightSegments'][1]['OperatingAirlineFlightNumber']}}/{{$value['FlightSegments'][2]['OperatingAirlineFlightNumber']}}
																						@break
																				@endif
																			@endforeach
		                                </span>
		                            </td>
			                            <td style="padding-top: 30px;">
			                                {{substr($val['DepartureDateTimeZone'],10)}}
			                            </td>
			                            <td style="padding-top: 30px;">
																			@foreach($value['FlightSegments'] as $l => $v)
																				@if($loop->last)
																					{{substr($v['ArrivalDateTimeZone'],10)}}
																				@endif
																			@endforeach
			                            </td>
		                            <td style="padding-top: 30px;text-align:center;">
																		@foreach($value['FlightSegments'] as $r => $s)
																			@if($loop->count==1)
																				{{$val['Duration']}}
			                                    <span class="center">Non Stop</span>
																					@break
																			@elseif($loop->count==2)
																				{{$value['FlightSegments'][1]['AccumulatedDuration']}}
			                                    <span class="center">1 stop via {{$s['IntArrivalAirportName']}}</span>
																					@break

																			@elseif($loop->count==3)
																				{{$value['FlightSegments'][2]['AccumulatedDuration']}}
																					<span class="center">2 stop via {{$value['FlightSegments'][0]['IntArrivalAirportName']}}</span>
																					<span class="center">{{$value['FlightSegments'][1]['IntArrivalAirportName']}}</span>
																					@break
																			@endif
																		@endforeach
		                            </td>
		                            <td>
																	@foreach($totalflight as $y => $value)
																		@if($key == $y)
			                                <a href="{{route('flight_checkout',['id' => $key])}}" class="btn pavan_button">
			                                    <strong>Rs.{{$value['FareDetails']['TotalFare'] }}</strong>
			                                </a>
																		@endif
																	@endforeach
		                            </td>
		                        </tr>
		                        <tr>
		                            <td colspan="2" class="bot">hekko</td>
		                            <td colspan="3" class="bot"><i class="fa fa-plane"></i><a data-toggle="modal" data-target="#flightInfo{{$key}}">Flight Details</a></td>
		                        </tr>
		                        <tr>
		                            <td colspan="5" class="spacer"></td>
		                        </tr>
												@endif

						         @endforeach

                  @endforeach
						    </tbody>
						</table>
					</div>

                    <!-- Modal -->
                    <!-- for each loop for displaying flight information on sperate modal -->
                 @foreach($totalflight as $key => $value)

								 	@foreach($value['FlightSegments'] as $k => $val)

										@if($loop->first)

                          <div id="flightInfo{{$key}}" class="modal fade" role="dialog" style="z-index:6666699;">
                                <div class="modal-dialog" id="flightInfoModal">

                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">Flight Details</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="journey-details">
                                                <span class="inline bold">{{$val['IntDepartureAirportName']}}<i style="margin:0px 10px 0px 10px;" class="fa fa-arrow-right"></i>
																									{{$test_var}}
																								</span>
                                                <span class="inline">Thu, 2 Nov

																									|
																									@foreach($value['FlightSegments'] as $r => $s)
																										@if($loop->count==1)
																											{{$val['Duration']}}
																												|<span> Non Stop</span>
																												@break
																										@elseif($loop->count==2)
																											{{$value['FlightSegments'][1]['AccumulatedDuration']}}
																												|<span>1 Stop(s)</span>
																												@break
																										@elseif($loop->count==3)
																											{{$value['FlightSegments'][2]['AccumulatedDuration']}}
																												|<span>2 Stop(s)</span>
																												@break
																										@endif
																									@endforeach
                                                </span>
                                                <div class="price-section">
                                                    <span>Rs.{{$value['FareDetails']['TotalFare']}}</span>
                                                    <button class="btn pavan_button">Book</button>
                                                </div>
                                            </div>
                                            <div class="flighttabs">
                                                <ul class="nav nav-tabs">
                                                    <li class=""><a href="#tab-1{{$key}}" role="tab" data-toggle="tab">Iternary</a></li>
                                                    <li><a href="#tab-2{{$key}}" role="tab" data-toggle="tab">Fare Details</a></li>
                                                </ul>
                                                <div class="tab-content clearfix">
                                                    <div class="tab-pane active" id="tab-1{{$key}}">
                                                        <div class="display_block">
                                                            <span class="label label-default">DEPARTURE <i class="glyphicon glyphicon-plane"></i></span>
                                                        </div>
																											@foreach($value['FlightSegments'] as $k => $val)
                                                        <div class="display_block_height">
                                                            <div id="DIV_1">
                                                                <ul id="UL_2">
                                                                    <li id="LI_3">
                                                                        <i id="I_4"></i>
																																				<span id="SPAN_5">
																																					<strong id="STRONG_6">
																																						{{$val['OperatingAirlineCode']}}-{{$val['OperatingAirlineFlightNumber']}}
																																					</strong><br id="BR_7" />
																																						<small id="SMALL_8">
																																								Operated by {{$val['AirLineName']}}
																																						</small>
																																				</span>
                                                                    </li>
                                                                    <li id="LI_9">
                                                                        <span id="SPAN_10">{{$val['IntDepartureAirportName']}} ({{$val['DepartureAirportCode']}})</span><br id="BR_11" /> <strong id="STRONG_12">{{$val['DepartureDateTimeZone']}}</strong><br id="BR_13" /> <span id="SPAN_14">Bajpe</span> <span id="SPAN_15">-</span>
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
                                                                            <span id="SPAN_29">Economy Class</span> <span id="SPAN_30"> <span id="SPAN_31">|</span> <span id="SPAN_32">{{$val['BookingClassFare']['Rule']}}</span></span> <span id="SPAN_33"> <span id="SPAN_34">|</span> <span id="SPAN_35"></span></span>
																																						<span id="SPAN_36"><span id="SPAN_37">|</span>
																																							<i class="fa fa-arrows-v"></i>
																																							{{$val['BaggageAllowed']['HandBaggage']}}
																																						</span>
                                                                        </h4>
                                                                    </li>
                                                                    <li id="LI_39">
                                                                        <span id="SPAN_40">{{$val['IntArrivalAirportName']}} ({{$val['ArrivalAirportCode']}})</span><br id="BR_41" /> <strong id="STRONG_42">{{$val['ArrivalDateTimeZone']}}</strong><br id="BR_43" /> <span id="SPAN_44">Bengaluru</span> <span id="SPAN_45">-</span>
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
                                                    <div class="tab-pane" id="tab-2{{$key}}">
                                                        <div class="col-md-12">
                                                            <table class="table fare_table">
                                                                <thead>
                                                                <tr>
                                                                    <th>Fare Details</th>
                                                                    <th>Passengers</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                <tr>
                                                                    <td>Actual Base Fair</td>
																																		<td>{{$value['FareDetails']['ChargeableFares']['ActualBaseFare']}}</td>
                                                                </tr>
																																<tr>
																																		<td>Tax</td>
																																	 <td>{{$value['FareDetails']['ChargeableFares']['Tax']}}</td>
																																</tr>
																																<tr>
																																		<td>Service Fee</td>
																																	 <td>{{$value['FareDetails']['ChargeableFares']['SCharge']}}</td>
																																</tr>
																																<tr style="background:#eaeaea;">
																																		<td>Total</td>
																																	 <td><strong>Rs.{{$value['FareDetails']['TotalFare']}}</strong></td>
																																</tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <!-- <div class="col-md-8">
                                                            <table class="table fare_table">
                                                                <thead>
                                                                <tr>
                                                                    <th>Fare summary</th>
                                                                    <th></th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
																																	<tr>
																																		<td>
																																			jsdifjjsdfjsjdf
																																		</td>
																																		<td>
																																			kjdsgjfgsj
																																		</td>
																																	</tr>
                                                                </tbody>
                                                            </table>
                                                        </div> -->
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

										@endif

                  @endforeach

                @endforeach
                <!--     //end of for each loop -->
					@if($journey_info['tripType'] == 2 )
					<div class="col-lg-6">
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
						    @foreach($returnflight as $key => $value)

		                @foreach($value['FlightSegments'] as $k => $val)
												@if($loop->first)
		                        <tr class="pink-color">
		                            <td style="padding-top: 10px;width:200px;">
		                                <img class="img-responsive airline_img" src="{{URL::asset('images/indigo.png')}}">
		                                <span class="airline_name">
		                                    {{$val['AirLineName']}} <h5>{{$key}}</h5>
		                                </span>
		                                <span class="airline_code">
																			@foreach($value['FlightSegments'] as $r => $s)
																				@if($loop->count==1)
																						{{$value['FlightSegments'][0]['OperatingAirlineCode']}}-{{$value['FlightSegments'][0]['OperatingAirlineFlightNumber']}}
																						@break
																				@elseif($loop->count==2)
																						{{$value['FlightSegments'][0]['OperatingAirlineCode']}}-{{$value['FlightSegments'][0]['OperatingAirlineFlightNumber']}}/{{$value['FlightSegments'][1]['OperatingAirlineFlightNumber']}}
																						@break
																				@elseif($loop->count==3)
																						{{$value['FlightSegments'][0]['OperatingAirlineCode']}}-{{$value['FlightSegments'][0]['OperatingAirlineFlightNumber']}}/{{$value['FlightSegments'][1]['OperatingAirlineFlightNumber']}}/{{$value['FlightSegments'][2]['OperatingAirlineFlightNumber']}}
																						@break
																				@endif
																			@endforeach
		                                </span>
		                            </td>
			                            <td style="padding-top: 30px;">
			                                {{substr($val['DepartureDateTimeZone'],10)}}
			                            </td>
			                            <td style="padding-top: 30px;">
																			@foreach($value['FlightSegments'] as $l => $v)
																				@if($loop->last)
																					{{substr($v['ArrivalDateTimeZone'],10)}}
																				@endif
																			@endforeach
			                            </td>
		                            <td style="padding-top: 30px;text-align:center;">
																		@foreach($value['FlightSegments'] as $r => $s)
																			@if($loop->count==1)
																				{{$val['Duration']}}
			                                    <span class="center">Non Stop</span>
																					@break
																			@elseif($loop->count==2)
																				{{$value['FlightSegments'][1]['AccumulatedDuration']}}
			                                    <span class="center">1 stop via {{$s['IntArrivalAirportName']}}</span>
																					@break

																			@elseif($loop->count==3)
																				{{$value['FlightSegments'][2]['AccumulatedDuration']}}
																					<span class="center">2 stop via {{$value['FlightSegments'][0]['IntArrivalAirportName']}}</span>
																					<span class="center">{{$value['FlightSegments'][1]['IntArrivalAirportName']}}</span>
																					@break
																			@endif
																		@endforeach
		                            </td>
		                            <td>
																	@foreach($returnflight as $y => $value)
																		@if($key == $y)
			                                <button class="btn btn-default pavan_button">
			                                    <strong>Rs.{{$value['FareDetails']['TotalFare'] }}</strong>
			                                </button>
																		@endif
																	@endforeach
		                            </td>
		                        </tr>
		                        <tr>
		                            <td colspan="2" class="bot">hekko</td>
		                            <td colspan="3" class="bot"><i class="fa fa-plane"></i><a data-toggle="modal" data-target="#flightInfo{{$key}}">Flight Details</a></td>
		                        </tr>
		                        <tr>
		                            <td colspan="5" class="spacer"></td>
		                        </tr>
												@endif

						         @endforeach

                  @endforeach
						    </tbody>
						</table>
					</div>

                    <!-- Modal -->
                    <!-- for each loop for displaying flight information on sperate modal -->
                 @foreach($returnflight as $key => $value)

								 	@foreach($value['FlightSegments'] as $k => $val)

										@if($loop->first)

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
                                                <span class="inline bold">{{$val['IntDepartureAirportName']}}<i style="margin:0px 10px 0px 10px;" class="fa fa-arrow-right"></i>
																									{{$test_var}}
																								</span>
                                                <span class="inline">Thu, 2 Nov

																									|
																									@foreach($value['FlightSegments'] as $r => $s)
																										@if($loop->count==1)
																											{{$val['Duration']}}
																												|<span> Non Stop</span>
																												@break
																										@elseif($loop->count==2)
																											{{$value['FlightSegments'][1]['AccumulatedDuration']}}
																												|<span>1 Stop(s)</span>
																												@break
																										@elseif($loop->count==3)
																											{{$value['FlightSegments'][2]['AccumulatedDuration']}}
																												|<span>2 Stop(s)</span>
																												@break
																										@endif
																									@endforeach
                                                </span>
                                                <div class="price-section">
                                                    <span>Rs.{{$value['FareDetails']['TotalFare']}}</span>
                                                    <button class="btn pavan_button">Book</button>
                                                </div>
                                            </div>
                                            <div class="flighttabs">
                                                <ul class="nav nav-tabs">
                                                    <li class=""><a href="#tab-1{{$key}}" role="tab" data-toggle="tab">Iternary</a></li>
                                                    <li><a href="#tab-2{{$key}}" role="tab" data-toggle="tab">Fare Details</a></li>
                                                </ul>
                                                <div class="tab-content clearfix">
                                                    <div class="tab-pane active" id="tab-1{{$key}}">
                                                        <div class="display_block">
                                                            <span class="label label-default">DEPARTURE <i class="glyphicon glyphicon-plane"></i></span>
                                                        </div>
																											@foreach($value['FlightSegments'] as $k => $val)
                                                        <div class="display_block_height">
                                                            <div id="DIV_1">
                                                                <ul id="UL_2">
                                                                    <li id="LI_3">
                                                                        <i id="I_4"></i>
																																				<span id="SPAN_5">
																																					<strong id="STRONG_6">
																																						{{$val['OperatingAirlineCode']}}-{{$val['OperatingAirlineFlightNumber']}}
																																					</strong><br id="BR_7" />
																																						<small id="SMALL_8">
																																								Operated by {{$val['AirLineName']}}
																																						</small>
																																				</span>
                                                                    </li>
                                                                    <li id="LI_9">
                                                                        <span id="SPAN_10">{{$val['IntDepartureAirportName']}} ({{$val['DepartureAirportCode']}})</span><br id="BR_11" /> <strong id="STRONG_12">{{$val['DepartureDateTimeZone']}}</strong><br id="BR_13" /> <span id="SPAN_14">Bajpe</span> <span id="SPAN_15">-</span>
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
                                                                            <span id="SPAN_29">Economy Class</span> <span id="SPAN_30"> <span id="SPAN_31">|</span> <span id="SPAN_32">{{$val['BookingClassFare']['Rule']}}</span></span> <span id="SPAN_33"> <span id="SPAN_34">|</span> <span id="SPAN_35"></span></span>
																																						<span id="SPAN_36"><span id="SPAN_37">|</span>
																																							<i class="fa fa-arrows-v"></i>
																																							{{$val['BaggageAllowed']['HandBaggage']}}
																																						</span>
                                                                        </h4>
                                                                    </li>
                                                                    <li id="LI_39">
                                                                        <span id="SPAN_40">{{$val['IntArrivalAirportName']}} ({{$val['ArrivalAirportCode']}})</span><br id="BR_41" /> <strong id="STRONG_42">{{$val['ArrivalDateTimeZone']}}</strong><br id="BR_43" /> <span id="SPAN_44">Bengaluru</span> <span id="SPAN_45">-</span>
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
                                                    <div class="tab-pane" id="tab-2{{$key}}">
                                                        <div class="col-md-12">
                                                            <table class="table fare_table">
                                                                <thead>
                                                                <tr>
                                                                    <th>Fare Details</th>
                                                                    <th>Passengers</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                <tr>
                                                                    <td>Actual Base Fair</td>
																																		<td>{{$value['FareDetails']['ChargeableFares']['ActualBaseFare']}}</td>
                                                                </tr>
																																<tr>
																																		<td>Tax</td>
																																	 <td>{{$value['FareDetails']['ChargeableFares']['Tax']}}</td>
																																</tr>
																																<tr>
																																		<td>Service Fee</td>
																																	 <td>{{$value['FareDetails']['ChargeableFares']['SCharge']}}</td>
																																</tr>
																																<tr style="background:#eaeaea;">
																																		<td>Total</td>
																																	 <td><strong>Rs.{{$value['FareDetails']['TotalFare']}}</strong></td>
																																</tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <!-- <div class="col-md-8">
                                                            <table class="table fare_table">
                                                                <thead>
                                                                <tr>
                                                                    <th>Fare summary</th>
                                                                    <th></th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
																																	<tr>
																																		<td>
																																			jsdifjjsdfjsjdf
																																		</td>
																																		<td>
																																			kjdsgjfgsj
																																		</td>
																																	</tr>
                                                                </tbody>
                                                            </table>
                                                        </div> -->
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

										@endif

                  @endforeach

                @endforeach
                <!--     //end of for each loop -->
							@endif
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
