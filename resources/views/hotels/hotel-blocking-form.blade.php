@extends('layouts.app')

@section('styles')
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/overlay/css/normalize.css')}}"/>
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/overlay/css/demo.css')}}"/>
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/overlay/css/style1.css')}}"/>
@endsection

@section('content')
  <div class="row">
    <div class="container">
      <div class="col-lg-9">
        <div class="panel panel-default" style="margin-top:40px;padding:30px;">
         <div class="panel-heading">
           <h3 class="panel-title">Hotel Details</h3>
         </div>
         <div class="panel-body">
           <div class="col-md-6">
             <h3>{{$roomData['HotelName']}}</h3>
             <span class="light-span"><i class="fa fa-map-marker"></i>  {{$roomData['HotelAddress']}}</span>
             <div class="img-holder">
               <img src="{{$roomData['HotelImages'][0]['Imagepath']}}" />
             </div>
           </div>
           <div class="col-md-6">
             <ul class="room-details">
               <li>
                  Rooms<br />{{$requestDetails['rooms']}}
               </li>
               <li>
                 Adults<br />{{array_sum(explode("~",$requestDetails['adults']))}}
               </li>
               <li>
                 Child<br />{{array_sum(explode("~",$requestDetails['children']))}}
               </li>
             </ul>
             <div class="col-md-12">
               <div class="step" data-step="0">
                <p for="step-1">Check In<br /><span id="arrivedate" data-arrivedate="{{$requestDetails['arrivalDate']}}">{{$requestDetails['arrivalDate']}}</span></p>
                <p for="step-3">Check Out<br /><span id="departdate" data-departdate="{{$requestDetails['departureDate']}}">{{$requestDetails['departureDate']}}</span></p>
              </div>
             </div>
            <div class="col-md-12" style="margin-top:60px;">
              <h4 style="padding:10px;">{{$roomDetails['RoomType']}}</h4><span style="float:right"><a href="javascript:void(0)" data-target="#policy" data-toggle="modal">Policy</a></span>
              <span class="light-span">Inclusion</span>
              <ul>
                <li>
                  {{$roomDetails['Inclusions']}}
                </li>
              </ul>
              <div id="policy" class="modal fade" role="dialog">
                <div class="modal-dialog">

                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title">Hotel Policy</h4>
                    </div>
                    <div class="modal-body">
                      <p>{{$roomDetails['RoomCancellationPolicy']}}</p>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                  </div>

                </div>
              </div>
            </div>
           </div>
         </div>
       </div>
      </div>
      <div class="col-lg-3">
        <div class="panel panel-default" style="margin-top:40px;">
          <div class="panel-heading">
            <h3 class="panel-title">Fare Details</h3>
          </div>
          <div class="panel-body" style="padding:0px;">
            <ul class="list-group" style="margin-bottom:0px;">
               <li class="list-group-item">Hotel Price<span>&#8377; {{$roomDetails['RoomTotal']}}</span></li>
               <li class="list-group-item">ServicetaxTotal<span>&#8377; {{$roomDetails['ServicetaxTotal']}}</span></li>
               <li class="list-group-item">Extra Guest <span>&#8377; {{$roomDetails['ExtGuestTotal']}}</span></li>
               <li class="list-group-item"><span style="font-size:25px;">You Pay (&#8377;) {{(((int)$roomDetails['RoomTotal'] + (int)$roomDetails['ExtGuestTotal']) * (int)$requestDetails['NoOfDays']) + (int)$roomDetails['ServicetaxTotal']}}</span></li>
           </ul>
          </div>
        </div>
      </div>
    </div>
   </div>
   <div class="row">
     <div class="container">
       <div class="col-lg-12">
         <div class="panel panel-default" style="margin-top:20px;padding:30px;">
           <div class="panel-heading">
             <h3 class="panel-title">Travelers Info</h3>
           </div>
           <div class="panel-body" style="padding:0px;">
             <form class="form-horizontal" role="form" method="GET" action="{{route('hotel.blocked.true',['id' => Request::segment(4)])}}" style="margin-top:10px;">
                 {{ csrf_field() }}
                 <div class="form-group">
                   <h3>Booking Information</h3>
                   <div class="col-lg-12 col-sm-12 col-xs-12" style="margin-top:10px;">
                     <div class="col-md-4">
                       <div style="position:relative;left:100px;padding-right:100px;">
                         <input name="email" type="text" id="email" placeholder="E-mail"  class="error">
                       </div>
                     </div>
                     <div class="col-md-4">
                       <div style="position:relative;left:100px;padding-right:100px;">
                         <input name="mobile" type="text" id="mobile" placeholder="Mobile"  class="error">
                       </div>
                     </div>
                     <span style="display:inline-flex;height:3px;width:100%;background:#f5f5f5;"></span>
                   </div>
                 </div>
                 <div class="form-group">
                 <h3>Room 1</h3>
                  @for($i = 0;$i<$room_1_adults;$i++)
                   <div class="col-lg-12 col-sm-12 col-xs-12" style="margin-top:10px;">
                     <div class="col-md-4">
                       <div style="position:absolute;width:100px;">
                         <select style="font-size:21px;padding:0px;" name="room-1-adults-{{$i}}">
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
                         <input name="room-1-first-name-adult-{{$i}}" type="text" id="first-name" placeholder="First Name"  class="error">
                       </div>
                     </div>
                     <div class="col-md-4">
                       <div>
                         <input name="room-1-last-name-adult-{{$i}}" type="text" id="last-name" placeholder="Last Name"  class="error">
                       </div>
                     </div>
                     <div class="col-md-4 main-search-input-item location date1" style="width:26%;">
                      <div>
                        <input type="date" name="room-1-adult-age-{{$i}}" id="dob-adult" placeholder="age"  class="datepicker" style="font-size:16px;">
                      </div>
                    </div>
                     <span style="font-size:22px;font-weight:200">Guest</span>
                   </div>
                  @endfor

                  <!-- count for children -->
                  @for($i = 0;$i<$room_1_child;$i++)
                   <div class="col-lg-12 col-sm-12 col-xs-12" style="margin-top:10px;">
                     <div class="col-md-4">
                       <div style="position:absolute;width:100px;">
                         <select style="font-size:21px;padding:0px;" name="room-1-type-child-{{$i}}">
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
                         <input name="room-1-first-name-child-{{$i}}" type="text" id="first-name" placeholder="First Name"  class="error">
                       </div>
                     </div>
                     <div class="col-md-4">
                       <div>
                         <input name="room-1-last-name-child-{{$i}}" type="text" id="last-name" placeholder="Last Name"  class="error">
                       </div>
                     </div>
                     <div class="col-md-4 main-search-input-item location date1" style="width:26%;">
                      <div>
                        <input type="date" name="room-1-child-age-{{$i}}" id="dob-adult" placeholder="age"  class="datepicker" style="font-size:16px;">
                      </div>
                    </div>
                     <span style="font-size:22px;font-weight:200">Guest</span>
                   </div>
                  @endfor

                  <!-- room count 2 -->
                 <h3>Room 2</h3>
                  @for($i = 0;$i<$room_2_adults;$i++)
                  <div class="col-lg-12 col-sm-12 col-xs-12" style="margin-top:10px;">
                    <div class="col-md-4">
                      <div style="position:absolute;width:100px;">
                        <select style="font-size:21px;padding:0px;" name="room-2-adults-{{$i}}">
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
                        <input name="room-2-first-name-adult-{{$i}}" type="text" id="first-name" placeholder="First Name"  class="error">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div>
                        <input name="room-2-last-name-adult-{{$i}}" type="text" id="last-name" placeholder="Last Name"  class="error">
                      </div>
                    </div>
                    <div class="col-md-4 main-search-input-item location date1" style="width:26%;">
                     <div>
                       <input type="date" name="room-2-adult-age-{{$i}}" id="dob-adult" placeholder="age"  class="datepicker" style="font-size:16px;">
                     </div>
                   </div>
                    <span style="font-size:22px;font-weight:200">Guest</span>
                  </div>
                  @endfor

                  <!-- room count 2 children -->
                  @for($i = 0;$i<$room_2_child;$i++)
                  <div class="col-lg-12 col-sm-12 col-xs-12" style="margin-top:10px;">
                    <div class="col-md-4">
                      <div style="position:absolute;width:100px;">
                        <select style="font-size:21px;padding:0px;" name="room-2-type-child-{{$i}}">
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
                        <input name="room-2-first-name-child-{{$i}}" type="text" id="first-name" placeholder="First Name"  class="error">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div>
                        <input name="room-2-last-name-child-{{$i}}" type="text" id="last-name" placeholder="Last Name"  class="error">
                      </div>
                    </div>
                    <div class="col-md-4 main-search-input-item location date1" style="width:26%;">
                     <div>
                       <input type="date" name="room-2-child-age-{{$i}}" id="dob-adult" placeholder="age"  class="datepicker" style="font-size:16px;">
                     </div>
                   </div>
                    <span style="font-size:22px;font-weight:200">Guest</span>
                  </div>
                  @endfor

                  <h3>Room 3</h3>
                  @for($i = 0;$i<$room_3_adults;$i++)
                  <div class="col-lg-12 col-sm-12 col-xs-12" style="margin-top:10px;">
                    <div class="col-md-4">
                      <div style="position:absolute;width:100px;">
                        <select style="font-size:21px;padding:0px;" name="room-3-adults-{{$i}}">
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
                        <input name="room-3-first-name-adult-{{$i}}" type="text" id="first-name" placeholder="First Name"  class="error">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div>
                        <input name="room-3-last-name-adult-{{$i}}" type="text" id="last-name" placeholder="Last Name"  class="error">
                      </div>
                    </div>
                    <div class="col-md-4 main-search-input-item location date1" style="width:26%;">
                     <div>
                       <input type="date" name="room-3-adult-age-{{$i}}" id="dob-adult" placeholder="age"  class="datepicker" style="font-size:16px;">
                     </div>
                   </div>
                    <span style="font-size:22px;font-weight:200">Guest</span>
                  </div>
                  @endfor

                  <!-- count for children -->
                  @for($i = 0;$i<$room_3_child;$i++)
                  <div class="col-lg-12 col-sm-12 col-xs-12" style="margin-top:10px;">
                    <div class="col-md-4">
                      <div style="position:absolute;width:100px;">
                        <select style="font-size:21px;padding:0px;" name="room-3-type-child-{{$i}}">
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
                        <input name="room-3-first-name-child-{{$i}}" type="text" id="first-name" placeholder="First Name"  class="error">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div>
                        <input name="room-3-last-name-child-{{$i}}" type="text" id="last-name" placeholder="Last Name"  class="error">
                      </div>
                    </div>
                    <div class="col-md-4 main-search-input-item location date1" style="width:26%;">
                     <div>
                       <input type="date" name="room-3-child-age-{{$i}}" id="dob-adult" placeholder="age"  class="datepicker" style="font-size:16px;">
                     </div>
                   </div>
                    <span style="font-size:22px;font-weight:200">Guest</span>
                  </div>
                  @endfor

                  <h3>Room 4</h3>
                  @for($i = 0;$i<$room_4_adults;$i++)
                  <div class="col-lg-12 col-sm-12 col-xs-12" style="margin-top:10px;">
                    <div class="col-md-4">
                      <div style="position:absolute;width:100px;">
                        <select style="font-size:21px;padding:0px;" name="room-4-adults-{{$i}}">
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
                        <input name="room-4-first-name-adult-{{$i}}" type="text" id="first-name" placeholder="First Name"  class="error">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div>
                        <input name="room-4-last-name-adult-{{$i}}" type="text" id="last-name" placeholder="Last Name"  class="error">
                      </div>
                    </div>
                    <div class="col-md-4 main-search-input-item location date1" style="width:26%;">
                     <div>
                       <input type="date" name="room-4-adult-age-{{$i}}" id="dob-adult" placeholder="age"  class="datepicker" style="font-size:16px;">
                     </div>
                   </div>
                    <span style="font-size:22px;font-weight:200">Guest</span>
                  </div>
                  @endfor

                  <!-- count for children -->
                  @for($i = 0;$i<$room_4_child;$i++)
                  <div class="col-lg-12 col-sm-12 col-xs-12" style="margin-top:10px;">
                    <div class="col-md-4">
                      <div style="position:absolute;width:100px;">
                        <select style="font-size:21px;padding:0px;" name="room-4-type-child-{{$i}}">
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
                        <input name="room-4-first-name-child-{{$i}}" type="text" id="first-name" placeholder="First Name"  class="error">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div>
                        <input name="room-4-last-name-child-{{$i}}" type="text" id="last-name" placeholder="Last Name"  class="error">
                      </div>
                    </div>
                    <div class="col-md-4 main-search-input-item location date1" style="width:26%;">
                     <div>
                       <input type="date" name="room-4-child-age-{{$i}}" id="dob-adult" placeholder="age"  class="datepicker" style="font-size:16px;">
                     </div>
                   </div>
                    <span style="font-size:22px;font-weight:200">Guest</span>
                  </div>
                  @endfor
                 </div>
                 <button type="submit" class="btn pavan_button">Save</button>
              </form>
           </div>
         </div>
       </div>
     </div>
   </div>
   <div class="row">
     <div class="container">
       <div class="col-lg-12">
         @if(Session('status'))

         <div class="overlay overlay-hugeinc open" style="z-index:65785687 !important;">
           <center>
             <h1 style="color:white;margin-top:50px;display:block;">Confirm Your Payment To Book This Hotel !</h1>
           </center>
           <div>
             <div class="panel-body" style="padding:0px;">
               <center>

               <ul class="list-group" style="margin-bottom:0px;margin:50px;">
                  <li class="list-group-item">Hotel Price<span>&#8377; {{$roomDetails['RoomTotal']}}</span></li>
                  <li class="list-group-item">ServicetaxTotal<span>&#8377; {{$roomDetails['ServicetaxTotal']}}</span></li>
                  <li class="list-group-item">Extra Guest <span>&#8377; {{$roomDetails['ExtGuestTotal']}}</span></li>
                  <li class="list-group-item"><span style="font-size:25px;">You Pay (&#8377;) {{(((int)$roomDetails['RoomTotal'] + (int)$roomDetails['ExtGuestTotal']) * (int)$requestDetails['NoOfDays']) + (int)$roomDetails['ServicetaxTotal']}}</span></li>
              </ul>
            </center>
             </div>
           </div>
           <div style="text-align:auto;">
             <div style="margin-right:auto;margin-left:auto;">
             <form action="{{route('verify.payment.hotel',['id' => Request::segment(4)])}}" method="POST">
             <!-- Note that the amount is in paise = 50 INR -->
             <script
                 src="https://checkout.razorpay.com/v1/checkout.js"
                 data-key="rzp_test_pKL2dR77Wf9ipw"
                 data-amount="{{Session('hotel_total_fare',0)}}"
                 data-buttontext="Pay Now"
                 data-name="Pavan Yatra"
                 data-description="Hotel Booking"
                 data-image="/images/logo.jpg"
                 data-prefill.name=""
                 data-prefill.email=""
                 data-theme.color="#f91942"
             ></script>
             <input type="hidden" value="Hidden Element" name="hidden">
             {{csrf_field()}}
             </form>
           </div>
           </div>
         </div>

         @endif
       </div>
     </div>
   </div>
@endsection

@section('scripts')
<script type="text/javascript">
  // $("document").ready(function(){
  //    var h = $("#arrivedate").attr("data-arrivedate");
  //    var date = moment(h).format('MMM D, YYYY');
  //    console.log(h);
  //    $("#arrivedate").html(date);
  //
  //    var j = $("#departdate").attr("data-departdate");
  //    console.log(j);
  //    var dater = moment("24-12-2017").format('MMM D, YYYY');
  //    $("#departdate").html(dater);
  // });
</script>

@endsection
