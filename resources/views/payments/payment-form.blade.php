@extends('layouts.app')


@section('styles')

@endsection
<link rel="stylesheet" href="{{URL::asset('css/snappysnippet.css')}}">
@section('content')
<div class="row">
  <div class="container">
    <div class="col-lg-9" style="min-height:300px;margin-top:50px;">
      <div class='flight-card'>
         <div class='flight-card--details'>
           <div class='bc-from'>
             <span class='detail-code'>
               {{$total_flight['FlightSegments'][0]['DepartureAirportCode']}}
             </span>
             <span class='detail-city'>
                {{$total_flight['FlightSegments'][0]['IntDepartureAirportName']}}
             </span>
           </div>
           <div class='bc-plane'>
             <img src='https://cdn.onlinewebfonts.com/svg/img_537856.svg'>
           </div>
           <div class='bc-to'>
             <span class='detail-code'>
               @foreach($total_flight['FlightSegments'] as $value)
                  @if ($loop->last)
                  {{$value['ArrivalAirportCode']}}
                  @endif
               @endforeach
             </span>
             <span class='detail-city'>
               @foreach($total_flight['FlightSegments'] as $value)
                  @if ($loop->last)
                  {{$value['IntArrivalAirportName']}}
                  @endif
               @endforeach
           </div>
           <div class='flight-card-details--text'>
             <div class='text-left'>
               <span class='text-hline'>
                 Operator
               </span>
               <span class='text-actual'>
                 @foreach($total_flight['FlightSegments'] as $value)
                     {{$value['AirLineName']}}
                     @break;
                 @endforeach
               </span>
             </div>
             <div class='text-middle'>
               <span class='text-hline'>
                 Flight
               </span>
               <span class='text-actual'>
                @foreach($total_flight['FlightSegments'] as $value)
                     {{$value['OperatingAirlineCode']}}-{{$value['OperatingAirlineFlightNumber']}}/
                @endforeach
               </span>
             </div>
             <div class='text-right'>
               <span data-departDate="{{$total_flight['RequestDetails']['DepartDate']}}" id="departDate"></span>
             </div>
           </div>
         </div>
      </div>
    </div>
      <span class="segments">Return</span>
    <div class="col-md-3">
      <h4 style="margin-top:55px;">Payment Details</h4>
      <div class="fare_block">
        <ul class="list-group">
          <li class="list-group-item"><span class="price-desc">Total Flight Price</span>&#8377;{{Session('totalfare')/100}}</li>
          <li class="list-group-item"><span class="price-desc">You Pay</span><span style="font-size:25px;display:inline">&#8377;{{Session('totalfare')/100}}</span></li>
       </ul>
      </div>
    </div>
    <div class="row">
      @if(Session('passengers')['tripType'] == 2)
      <div class="col-lg-9" style="min-height:300px;margin-top:50px;">
        <div class='flight-card--details'>
          <div class='bc-from'>
            <span class='detail-code'>
              {{$return_flight['FlightSegments'][0]['DepartureAirportCode']}}
            </span>
            <span class='detail-city'>
               {{$return_flight['FlightSegments'][0]['IntDepartureAirportName']}}
            </span>
          </div>
          <div class='bc-plane'>
            <img src='https://cdn.onlinewebfonts.com/svg/img_537856.svg'>
          </div>
          <div class='bc-to'>
            <span class='detail-code'>
              @foreach($return_flight['FlightSegments'] as $value)
                 @if ($loop->last)
                 {{$value['ArrivalAirportCode']}}
                 @endif
              @endforeach
            </span>
            <span class='detail-city'>
              @foreach($return_flight['FlightSegments'] as $value)
                 @if ($loop->last)
                 {{$value['IntArrivalAirportName']}}
                 @endif
              @endforeach
          </div>
          <div class='flight-card-details--text'>
            <div class='text-left'>
              <span class='text-hline'>
                Operator
              </span>
              <span class='text-actual'>
                @foreach($return_flight['FlightSegments'] as $value)
                    {{$value['AirLineName']}}
                    @break;
                @endforeach
              </span>
            </div>
            <div class='text-middle'>
              <span class='text-hline'>
                Flight
              </span>
              <span class='text-actual'>
               @foreach($return_flight['FlightSegments'] as $value)
                    {{$value['OperatingAirlineCode']}}-{{$value['OperatingAirlineFlightNumber']}}/
               @endforeach
              </span>
            </div>
            <div class='text-right'>
              <span data-departDateReturn="{{$return_flight['FlightSegments'][0]['DepartureDateTime']}}" id="departDateReturn"></span>
            </div>
          </div>
        </div>
      </div>
      @endif
      <div class="col-md-3">
        <h4 style="margin-top:55px;">Contact Details</h4>
        <div class="fare_block">
          <ul class="list-group">
            <li class="list-group-item"><i class="fa fa-envelope-o" aria-hidden="true"></i>{{Session('contact_details')[0]}}</li>
            <li class="list-group-item"><i class="fa fa-mobile" aria-hidden="true"></i>{{Session('contact_details')[1]}}</li>
         </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="container">
      <div class="col-lg-12">
        <form action="{{route('verify.payment.form',['id' => Request::segment(4),'return_id' => Request::segment(5),'ref_no' => Request::segment(6)])}}" method="POST">
        <!-- Note that the amount is in paise = 50 INR -->
        <script
            src="https://checkout.razorpay.com/v1/checkout.js"
            data-key="rzp_test_pKL2dR77Wf9ipw"
            data-amount="{{Session('totalfare',0)}}"
            data-buttontext="Pay Now"
            data-name="Pavan Yatra"
            data-description="Flight Booking"
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
</div>
@endsection

@section('scripts')
<script type="text/javascript">
  $(document).ready(function(){
    var now = moment();
    var departDate       = $("#departDate").attr("departDate");
    var departDateReturn = $("#departDateReturn").attr("departDateReturn");
    var date  = moment(departDate).format('MMM D, YYYY');
    var date2 = moment(departDateReturn).format('MMM D, YYYY');
    $("#departDate").html(date);
    $("#departDateReturn").html(date);
  });
</script>
@endsection
