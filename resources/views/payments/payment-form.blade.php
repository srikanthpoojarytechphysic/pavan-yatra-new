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
               {{$total_flight['RequestDetails']['Source']}}
             </span>
             <span class='detail-city'>
                {{ $airport_data[substr($search_details['source'],4)]->City.', '.$airport_data[substr($search_details['source'],4)]->Country.' - '.'('.substr($search_details['source'],0,3).')-'.$airport_data[substr($search_details['source'],4)]->AirportDesc}}
             </span>
           </div>
           <div class='bc-plane'>
             <img src='https://cdn.onlinewebfonts.com/svg/img_537856.svg'>
           </div>
           <div class='bc-to'>
             <span class='detail-code'>
              {{$total_flight['RequestDetails']['Destination']}}
             </span>
             <span class='detail-city'>
               {{$airport_data[substr($search_details['destination'],4)]->City.', '.$airport_data[substr($search_details['destination'],4)]->Country.' - '.'('.substr($search_details['destination'],0,3).')-'.$airport_data[substr($search_details['destination'],4)]->AirportDesc}}
             </span>
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
    <div class="col-md-3">
      <h4 style="margin-top:55px;">Fare Details</h4>
      <div class="fare_block">
        <ul class="list-group">
          <li style="height:100px;background: #fffcfc;border: none;top: 10px;" class="list-group-item">
            <center>
              Sub Total <span></span>
            </center><br />
            <span style="text-align:center"><strong>Rs.{{Session('totalfare')/100}}</strong></span></li>
        </ul>
      </div>
    </div>
    <div class="row">
      @if(Session('passengers')['tripType'] == 2)
      <div class="col-lg-9" style="min-height:300px;margin-top:50px;">
         <div class='flight-card--details'>
             <div class='bc-from'>
               <span class='detail-code'>
                 {{$return_flight['RequestDetails']['Source']}}
               </span>
               <span class='detail-city'>
                  {{ $airport_data[substr($search_details['source'],4)]->City.', '.$airport_data[substr($search_details['source'],4)]->Country.' - '.'('.substr($search_details['source'],0,3).')-'.$airport_data[substr($search_details['source'],4)]->AirportDesc}}
               </span>
             </div>
             <div class='bc-plane'>
               <img src='https://cdn.onlinewebfonts.com/svg/img_537856.svg'>
             </div>
             <div class='bc-to'>
               <span class='detail-code'>
                {{$return_flight['RequestDetails']['Destination']}}
               </span>
               <span class='detail-city'>
                 {{$airport_data[substr($search_details['destination'],4)]->City.', '.$airport_data[substr($search_details['destination'],4)]->Country.' - '.'('.substr($search_details['destination'],0,3).')-'.$airport_data[substr($search_details['destination'],4)]->AirportDesc}}
               </span>
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
                 <span data-departDate="{{$total_flight['RequestDetails']['DepartDate']}}" id="departDate"></span>
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
      <form action="{{route('verify.payment.form',['ref_no' => Request::segment(6)])}}" method="POST">
      <!-- Note that the amount is in paise = 50 INR -->
      <script
          src="https://checkout.razorpay.com/v1/checkout.js"
          data-key="rzp_test_pKL2dR77Wf9ipw"
          data-amount="{{Session('totalfare',0)}}"
          data-buttontext="Pay with Razorpay"
          data-name="Merchant Name"
          data-description="Purchase Description"
          data-image="https://your-awesome-site.com/your_logo.jpg"
          data-prefill.name="Harshil Mathur"
          data-prefill.email="support@razorpay.com"
          data-theme.color="#f91942"
      ></script>
      <input type="hidden" value="Hidden Element" name="hidden">
      {{csrf_field()}}
      </form>
    </div>
  </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
  $(document).ready(function(){
    var now = moment();
    var departDate = $("#departDate").attr("departDate");
    var date = moment(departDate).format('MMM D, YYYY');
    $("#departDate").html(date);
  });
</script>
@endsection
