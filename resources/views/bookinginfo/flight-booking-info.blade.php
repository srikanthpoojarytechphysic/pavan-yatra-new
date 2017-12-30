@extends('layouts.app')


@section('content')
<div class="container">
  <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">

    @if(Session('status'))
    <div class="notification error closeable" style="margin-top:30px;">
				<p><span>{{Session('status')}}</span></p>
				<a class="close"></a>
    @endif
		</div>
    <div class="panel panel-default" style="margin-top:50px;">
      <div class="panel-heading">Booking Info</div>
        <div class="panel-content">
          <form class="form-horizontal" role="form" method="get" action="{{route('cancel_ticket')}}">
             <div class="form-group" style="margin-top:30px;">
               <label for="inputEmail3" class="col-sm-2 control-label">Email Address</label>
               <div class="col-sm-6">
                 <input type="email" class="form-control" id="inputEmail3" name="email" placeholder="Email" required>
               </div>
             </div>
             <div class="form-group">
               <label for="inputPassword3" class="col-sm-2 control-label">Booking Reference Number</label>
               <div class="col-sm-6">
                 <input type="text" class="form-control" id="ref_no" name="ref_no" placeholder="Booking Reference Number" required>
               </div>
             </div>
             <div class="form-group">
               <div class="col-sm-offset-2 col-sm-10">
                 <button type="submit" class="btn btn-default">Submit</button>
               </div>
             </div>
           </form>
       </div>
  </div>
  <div class="row">
    <div class="col-lg-12">
      <!-- <div class="panel panel-default" style="margin-top:50px;">
        <div class="panel-heading">Booking Info</div>
          <div class="panel-content">
            <div class='flight-card'>
               <div class='flight-card--details'>
                 <div class='bc-from'>
                   <span class='detail-code'>
                     IXE
                   </span>
                   <span class='detail-city'>

                   </span>
                 </div>
                 <div class='bc-plane'>
                   <img src='https://cdn.onlinewebfonts.com/svg/img_537856.svg'>
                 </div>
                 <div class='bc-to'>
                   <span class='detail-code'>
                     BLR
                   </span>
                   <span class='detail-city'>
                     Banglore
                   </span>

                 </div>
                 <div class='flight-card-details--text'>
                   <div class='text-left'>
                     <span class='text-hline'>
                       Operator
                     </span>
                     <span class='text-actual'>

                     </span>
                   </div>
                   <div class='text-middle'>
                     <span class='text-hline'>
                       Flight
                     </span>
                     <span class='text-actual'>

                     </span>
                   </div>
                   <div class='text-right'>
                     <span data-departDate="" id="departDate"></span>
                   </div>
                 </div>
               </div>
            <!-- </div> -->
          </div>
       </div>
    </div> -->
  </div>
</div>
@endsection
