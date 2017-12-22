@extends('layouts.app')

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
                <p for="step-1">Check In<br /><span id="arrivedate" data-arrivedate="{{$requestDetails['arrivalDate']}}"></span></p>
                <p for="step-3">Check Out<br /><span id="departdate">{{$requestDetails['departureDate']}}</span></p>
              </div>
             </div>
            <div class="col-md-12" style="margin-top:60px;">
              <h4 style="padding:10px;">{{$roomDetails['RoomType']}}</h4>
              <span class="light-span">Inclusion</span>
              <ul>
                <li>
                  {{$roomDetails['Inclusions']}}
                </li>
              </ul>
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

           </div>
         </div>
       </div>
     </div>
   </div>
@endsection

@section('scripts')
<script type="text/javascript">
  $("document").ready(function(){
     var h = $("#arrivedate").attr("data-arrivedate");
     var date = moment().format('MMM D, YYYY');
     $("#arrivedate").html(date);

     var j = $("#departdate").attr("data-departdate");
     var dater = moment(j).format('MMM D, YYYY');
     $("#departdate").html(dater);
  });
</script>
@endsection
