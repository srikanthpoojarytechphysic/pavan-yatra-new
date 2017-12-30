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
						<span class="flight_count">Found {{count($totalflight)}} Flights<img class="icon--small" src="/icons/016-airplane.png" /></span>
					</div>
					<div class="col-md-4 col-lg-4 col-sm-12 col-xs-12 text_center">
						<h5 class="ticket_route_text">manglore</h5>
							<i class="fa fa-arrow-right" aria-hidden="true"></i>
						<h5 class="ticket_route_text">Banglore</h5><img class="icon--small" src="/icons/003-placeholder.png" /><br>
						<span style="padding: 10px;display: block;" id="date" data-date="{{$journey_info['date']}}"></span>

					</div>
					<div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
						<div class="modify_search">
							<button class="btn btn-default" data-toggle="modal" data-target="#modifysearch">Modify Search</button>
						</div>
						<div id="modifysearch" class="modal fade" role="dialog">
							<div class="modal-dialog modal-lg" style="width:100%;">

								<!-- Modal content-->
								<div class="modal-content" st>
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal">&times;</button>
										<h4 class="modal-title">Modal Header</h4>
									</div>
									<div class="modal-body">
										<form method="GET" action="{{Route('search.flights')}}" role="form">

                        {{ csrf_field() }}
                           <div class="main-search-input">
                            <div class="main-search-input-item">
                                <select id="flight-type" name="trip-type" data-placeholder="" class="chosen-select">
                                    <option></option>
                                    <option value="1">One Way</option>
                                    <option value="2">Round Trip</option>
                                </select>
                            </div>
                            <div class="main-search-input-item">
                                <select name="air-class" id='purpose' data-placeholder="Cabin Class" class="chosen-select">
                                    <option></option>
                                    <option value="B">Business</option>
                                    <option value="E">Economy</option>
                                    <option value="ER">Premium Economy</option>
                                    <option value="B">First</option>
                                </select>
                            </div>
                            <div class="main-search-input-item location">
                                <a href="#"><i class="fa fa-user"></i></a>
                                <input type="text" placeholder="No of Adults" name="adults" value=""/>

                            </div>
                            <div class="main-search-input-item location">
                                <a href="#"><i class="fa fa-user"></i></a>
                                <input type="text" placeholder="No of Childrens" name="children" value=""/>

                            </div>
                            <div class="main-search-input-item location">
                                <a href="#"><i class="fa fa-user"></i></a>
                                <input type="text" placeholder="No of infants" name="infants" value=""/>

                            </div>

                          </div>
                          <div class="main-search-input">
                            <div class="main-search-input-item">
                                <select name="departure" id="departure" data-placeholder="Departure" class="chosen-select" style="padding-left: 20px;width:200px;">
                                    @foreach(Session('airport_data') as $key => $items)
                                        <option value="{{$items->AirportCode}}-{{$key}}">{{$items->City}}<em>    </em>{{$items->AirportCode}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="main-search-input-item">
                               <select name="destination" id="destination" data-placeholder="Destination" class="chosen-select" style="padding-left: 20px;width:200px;">
                                    @foreach(Session('airport_data') as $key => $items)
                                        <option value="{{$items->AirportCode}}-{{$key}}">{{$items->City}}<em>    </em>{{$items->AirportCode}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div id="depart-date" class="main-search-input-item location date1">
                                <a href="#"><i class="fa fa-calendar"></i></a>
                                <!-- <input type="text" name="depart-date" onfocus="(this.type='date')" class="datepicker" placeholder="Depart Date" name="return-date" value=""/> -->
                                <input type="text" name="depart-date" id="depart-date-date" data-large-mode="true" placeholder="Depart Date" data-init-set="false" data-format="M S,Y" data-lock="from"  data-theme="depart-date"/>
                            </div>

                            <div id="flight-return" class="main-search-input-item location date1">
                                <a href="#"><i class="fa fa-calendar"></i></a>
                                <input type="text" name="return-date" id="return-date-date" data-large-mode="true" data-format="M S,Y" placeholder="Return Date" data-lock="from" data-init-set="false" data-theme="depart-date"/>
                            </div>


                            <button class="button flightloader" type="submit">Search</button>
                          </div>
                        </div>
                		</form>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
									</div>
								</div>

							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="@if($journey_info['tripType']==1)
					col-lg-12
					@else
					col-lg-6
					@endif">
						<table class="table type_1" id="type_1">
						    <thead>
						      <tr>
						        <th style="padding-left:50px;">Airline</th>
						        <th>Depart</th>
						        <th>Arrive</th>
						        <th style="text-align:center;">Duration</th>
										<th>Price</th>
						        <th>Details</th>
						      </tr>
						    </thead>
						    <tbody>
						    @foreach($totalflight as $key => $value)

		                @foreach($value['FlightSegments'] as $k => $val)
												@if($loop->first)
		                        <tr class="pink-color">
		                            <td style="padding-top: 10px;width:200px;">
		                                <img class="img-responsive airline_img" src="/images/{{$value['FlightSegments'][0]['ImageFileName']}}.png">
		                                <span class="airline_name">
		                                    {{$val['AirLineName']}}
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
			                            <td style="padding-top: 30px;" class="depart">
			                                {{substr($val['DepartureDateTimeZone'],10)}}
			                            </td>
			                            <td style="padding-top: 30px;" class="arrive">
																			@foreach($value['FlightSegments'] as $l => $v)
																				@if($loop->last)
																					{{substr($v['ArrivalDateTimeZone'],10)}}
																				@endif
																			@endforeach
			                            </td>
		                            <td style="padding-top: 30px;text-align:center;">
																		@foreach($value['FlightSegments'] as $r => $s)
																			@if($loop->count==1)
																				<span class="duration">{{$val['Duration']}}</span>
			                                    <span class="center stop_1">Non Stop</span>
																					@break
																			@elseif($loop->count==2)
																				<span class="duration">{{$value['FlightSegments'][1]['AccumulatedDuration']}}</span>
			                                    <span class="center stop_1">1 stop via {{$s['IntArrivalAirportName']}}</span>
																					@break

																			@elseif($loop->count==3)
																				<span class="duration">{{$value['FlightSegments'][2]['AccumulatedDuration']}}</span>
																					<span class="center stop_1">2 stop via {{$value['FlightSegments'][0]['IntArrivalAirportName']}}</span>
																					<span class="center stop_sec">{{$value['FlightSegments'][1]['IntArrivalAirportName']}}</span>
																					@break
																			@endif
																		@endforeach
		                            </td>
		                            <td>
																	@foreach($totalflight as $y => $value)
																		@if($key == $y)
																			@if($journey_info['tripType'] == 1 )
																				<a href="{{route('flight_checkout',['id' => $key,'return_id' => 'null'])}}" class="btn pavan_button" id="flight_type_1" data-key="{{$key}}">
																					<strong>Rs.{{$value['FareDetails']['TotalFare'] }}</strong>

																			@else
																				<a href="#" class="btn pavan_button flight_type_1" data-key="{{$key}}" data-price="{{$value['FareDetails']['TotalFare']}}">
				                                    <strong>Rs.{{$value['FareDetails']['TotalFare'] }}</strong>
				                                </a>
																			@endif
																		@endif
																	@endforeach
		                            </td>
																<td>
																	<a style="
																	@if($journey_info['tripType']==2)
																	font-size:11px;
																	@else
																	''
																	@endif
																	"
																	data-toggle="modal" data-target="#flightInfo{{$key}}" class="align-middle">Flight Details<img class="icon--small" src="/icons/013-luggage.png" /></a>
																</td>
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
																									{{$val['IntArrivalAirportName']}}
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
						<table class="table type_2" id="type_2">
						    <thead>
						      <tr>
						        <th style="padding-left:50px;">Airline</th>
						        <th>Depart</th>
						        <th>Arrive</th>
						        <th>Duration</th>
										<th>Price</th>
						        <th>Details</th>
						      </tr>
						    </thead>
						    <tbody>
						    @foreach($returnflight as $key => $value)

		                @foreach($value['FlightSegments'] as $k => $val)
												@if($loop->first)
		                        <tr class="pink-color">
		                            <td style="padding-top: 10px;width:200px;">
																	<img class="img-responsive airline_img" src="/images/{{$value['FlightSegments'][0]['ImageFileName']}}.png">

		                                <span class="airline_name">
		                                    {{$val['AirLineName']}}
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
			                            <td style="padding-top: 30px;" class="depart">
			                                {{substr($val['DepartureDateTimeZone'],10)}}
			                            </td>
			                            <td style="padding-top: 30px;" class="arrive">
																			@foreach($value['FlightSegments'] as $l => $v)
																				@if($loop->last)
																					{{substr($v['ArrivalDateTimeZone'],10)}}
																				@endif
																			@endforeach
			                            </td>
		                            <td style="padding-top: 30px;text-align:center;">
																		@foreach($value['FlightSegments'] as $r => $s)
																			@if($loop->count==1)
																				<span class="duration">{{$val['Duration']}}</span>
			                                    <span class="center stop_2">Non Stop</span>
																					@break
																			@elseif($loop->count==2)
																				<span class="duration">{{$value['FlightSegments'][1]['AccumulatedDuration']}}</span>
			                                    <span class="center stop_2">1 stop via {{$s['IntArrivalAirportName']}}</span>
																					@break

																			@elseif($loop->count==3)
																				<span class="duration">{{$value['FlightSegments'][2]['AccumulatedDuration']}}</span>
																					<span class="center stop_2">2 stop via {{$value['FlightSegments'][0]['IntArrivalAirportName']}}</span>
																					<span class="center stop_sec_2">{{$value['FlightSegments'][1]['IntArrivalAirportName']}}</span>
																					@break
																			@endif
																		@endforeach
		                            </td>
		                            <td>
																	@foreach($returnflight as $y => $value)
																		@if($key == $y)
																		<a href="#" class="btn pavan_button flight_type_2" data-key="{{$key}}" data-price="{{$value['FareDetails']['TotalFare']}}">
																				<strong>Rs.{{$value['FareDetails']['TotalFare'] }}</strong>
																		</a>
																		@endif
																	@endforeach
		                            </td>
																<td>
																	<a style="
																	@if($journey_info['tripType']==2)
																	font-size:11px;
																	@else
																	''
																	@endif
																	"data-toggle="modal" data-target="#flightInfo-return{{$key}}">Flight Details<img class="icon--small" src="/icons/013-luggage.png" /></a>
																</td>
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

                          <div id="flightInfo-return{{$key}}" class="modal fade" role="dialog">
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
																									{{$val['IntArrivalAirportName']}}
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
                                                    <li class=""><a href="#tab-1-return{{$key}}" role="tab" data-toggle="tab">Iternary</a></li>
                                                    <li><a href="#tab-2-return{{$key}}" role="tab" data-toggle="tab">Fare Details</a></li>
                                                </ul>
                                                <div class="tab-content clearfix">
                                                    <div class="tab-pane active" id="tab-1-return{{$key}}">
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
                                                    <div class="tab-pane" id="tab-2-return{{$key}}">
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
	<div class="row">
		<div class="col-md-12 col-sm-12 col-lg-12">
			<div class="sticky_flight">
				<div class="col_divider">
					<div class="col-md-2">
						<img class="img-responsive airline_img" src="/images/{{$value['FlightSegments'][0]['ImageFileName']}}.png">
							<span class="airline_name_type_1">
								Jet Airways
							</span>
							<span class="airline_code_type_1" style="left: 22px;top: 5px;position: relative;display:block;">
								4564
							</span>
					</div>
					<div class="col-md-2">
						<span class="air_time_type_1"></span><em>  </em><i class="fa fa-long-arrow-right" aria-hidden="true"></i>
						<span class="air_time_type_2"></span>
					</div>
					<div class="col-md-2" style="border-right: 1px solid;height: 75px;">
						<span class="duration_type_1"></span><br />
						<span class="stop_type_1"></span>
					</div>
				</div>
				<div class="col_divider_2">
					<div class="col-md-2">
						<img class="img-responsive airline_img" src="/images/{{$value['FlightSegments'][0]['ImageFileName']}}.png">
							<span class="airline_name_type_2">
							</span>
							<span class="airline_code_type_2" style="left: 22px;top: 5px;position: relative;display:block;">
							</span>
					</div>
					<div class="col-md-2">
						<span class="air_time_type_sec_1"></span><i class="fa fa-long-arrow-right" aria-hidden="true"></i>
						<span class="air_time_type_sec_2"></span>
					</div>
					<div class="col-md-2" style="
					height: inherit;">
					<span class="duration_type_2"></span><br />
					<span class="stop_type_2"></span>
						<span  class="label price_data_type" style="position: relative;left: 105px;top:-27px;background:#f91942;font-size:20px;"></span>
					</div>


					<center>
						<a href="#" class="btn pavan_button book_flight" style="position:relative;top:-68px;display:grid;">Book Now</a>
					</center>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
$(document).ready(function(){
	var now = moment();
	var departDate = $("#date").attr("date");
	var date = moment(departDate).format('MMM D, YYYY');
	$("#date").html(date);

	$('#type_1').DataTable( {
			 "paging":   false,
			 "info":     false,
			 "searching" :false,
	 } );

	 $('#type_2').DataTable( {
 			 "paging":   false,
 			 "info":     false,
 			 "searching" :false,
 	 } );

	 $('#depart-date-date').dateDropper();
	 $('#return-date-date').dateDropper();
});
</script>

@endsection
