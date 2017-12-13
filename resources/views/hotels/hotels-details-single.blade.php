@extends('layouts.app')

@section('content')
  <div class="row">
    <div class="hotel_booking_info">
        <div class="clearfix"></div>
     </div>
   </div>


    <!-- Slider
    ================================================== -->
    <div class="listing-slider mfp-gallery-container margin-bottom-0">
      @foreach($hotelDetails['HotelImages'] as $items)
      <a href="{{$items['Imagepath']}}" data-background-image="{{$items['Imagepath']}}" class="item mfp-gallery"></a>

      @endforeach
    </div>
    <div class="container">
    	<div class="row sticky-wrapper">
    		<div class="col-lg-8 col-md-8 padding-right-30">

    			<!-- Titlebar -->
    			<div id="titlebar" class="listing-titlebar">
    				<div class="listing-titlebar-title">
    					<h2>{{$hotelDetails['HotelName']}}</h2>
                <div class="listing-badge now-open">Rs.{{$hotelDetails['RoomDetails'][0]['RoomTotal']}}</div>
    						<a href="#listing-location" class="listing-address">
    							<i class="fa fa-map-marker"></i>
    							{{$hotelDetails['HotelAddress']}}
    						</a>
    					</span>
    					<div class="star-rating" data-rating="{{$hotelDetails['StarRating']}}">
    						<div class="rating-counter"></div>
    					</div>
    				</div>
    			</div>

    			<!-- Listing Nav -->
    			<div id="listing-nav" class="listing-nav-container">
    				<ul class="listing-nav">
    					<li><a href="#listing-overview" class="active">Overview</a></li>
    					<li><a href="#listing-location">Location</a></li>
    					<li><a href="#rooms">Rooms</a></li>
    				</ul>
    			</div>

    			<!-- Overview -->
    			<div id="listing-overview" class="listing-section">

    				<!-- Description -->

    				<p>
    					{{$hotelDetails['Description']}}
    				</p>

    				<!-- Amenities -->
    				<h3 class="listing-desc-headline">Amenities</h3>
    				<ul class="listing-features checkboxes margin-top-0">
    					@foreach($facilities as $items)
                <li>
                  {{$items}}
                </li>
              @endforeach
    				</ul>
    			</div>
          <!-- room details -->
          <h3 class="listing-desc-headline">Room Details</h3>
          <div class="boxed-widget margin-top-35 room_style" id="rooms">
            @foreach($hotelDetails['RoomDetails'] as $key =>  $items)
            <div class="room_block">
              <div class="col-lg-12">
                <ul class="listing-details-sidebar">
         					<li>{{$items['RoomType']}}</li>
         					<li></li>
         					<li></li>
     				   </ul>
              </div>
              <div class="col-lg-4">
                <span class="text_center">{{$items['RefundRule']}}</span>
                <span class="color-camrine text_center" style="font-size:25px;"> &#8377;{{$items['RoomNetTotal']}}</span>
              </div>
              <div class="col-lg-4">
                <span class="small-text"><a href="#" style="margin-bottom:5px;display:block;"data-toggle="modal" data-target="#cancelpolicy-{{$key}}">Cancelation Policy</a></span>

                <button class="btn pavan_button">Book Now</button>
              </div>

            </div>
          @endforeach
          </div>
          <!-- Modal -->
          @foreach($hotelDetails['RoomDetails'] as $k => $val)

          <div id="cancelpolicy-{{$k}}" class="modal fade" role="dialog">
            <div class="modal-dialog">

              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Cancelation Policy</h4>
                </div>
                <div class="modal-body">
                  <p>{{$val['RoomCancellationPolicy']}}</p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
              </div>

            </div>
          </div>

          @endforeach
          <!-- end of room details -->
    			<!-- Location -->
    			<div id="listing-location" class="listing-section">
    				<h3 class="listing-desc-headline margin-top-60 margin-bottom-30">Location</h3>

    				<div id="singleListingMap-container">
    					<div id="singleListingMap" data-latitude="{{$hotelDetails['Latitude']}}" data-longitude="{{$hotelDetails['Longitude']}}" data-map-icon="im im-icon-Hamburger"></div>
    					<a href="#" id="streetView">Street View</a>
    				</div>
    			</div>
    		</div>

    		<!-- Sidebar
    		================================================== -->
    		<div class="col-lg-4 col-md-4 margin-top-75 sticky">

    			<!-- Contact -->
    			<div class="boxed-widget margin-top-35">
    				<h3><i class="sl sl-icon-pin"></i> Contact</h3>
    				<ul class="listing-details-sidebar">
    					<li><i class="sl sl-icon-phone"></i> (123) 123-456</li>
    					<li><i class="sl sl-icon-globe"></i> <a href="#">http://example.com</a></li>
    					<li><i class="fa fa-envelope-o"></i> <a href="#"><span class="__cf_email__" data-cfemail="721b1c141d32170a131f021e175c111d1f">[email&#160;protected]</span><script data-cfhash='f9e31' type="text/javascript">/* <![CDATA[ */!function(t,e,r,n,c,a,p){try{t=document.currentScript||function(){for(t=document.getElementsByTagName('script'),e=t.length;e--;)if(t[e].getAttribute('data-cfhash'))return t[e]}();if(t&&(c=t.previousSibling)){p=t.parentNode;if(a=c.getAttribute('data-cfemail')){for(e='',r='0x'+a.substr(0,2)|0,n=2;a.length-n;n+=2)e+='%'+('0'+('0x'+a.substr(n,2)^r).toString(16)).slice(-2);p.replaceChild(document.createTextNode(decodeURIComponent(e)),c)}p.removeChild(t)}}catch(u){}}()/* ]]> */</script></a></li>
    				</ul>

    				<ul class="listing-details-sidebar social-profiles">
    					<li><a href="#" class="facebook-profile"><i class="fa fa-facebook-square"></i> Facebook</a></li>
    					<li><a href="#" class="twitter-profile"><i class="fa fa-twitter"></i> Twitter</a></li>
    					<!-- <li><a href="#" class="gplus-profile"><i class="fa fa-google-plus"></i> Google Plus</a></li> -->
    				</ul>

    				<!-- Reply to review popup -->
    				<div id="small-dialog" class="zoom-anim-dialog mfp-hide">
    					<div class="small-dialog-header">
    						<h3>Send Message</h3>
    					</div>
    					<div class="message-reply margin-top-0">
    						<textarea cols="40" rows="3" placeholder="Your message to Burger House"></textarea>
    						<button class="button">Send Message</button>
    					</div>
    				</div>

    				<a href="#small-dialog" class="send-message-to-owner button popup-with-zoom-anim"><i class="sl sl-icon-envelope-open"></i> Send Message</a>
    			</div>
    			<!-- Contact / End-->

    			<!-- Share / Like -->
    			<div class="listing-share margin-top-40 margin-bottom-40 no-border">
    				<button class="like-button"><span class="like-icon"></span> Bookmark this listing</button>
    				<span>159 people bookmarked this place</span>

    					<!-- Share Buttons -->
    					<ul class="share-buttons margin-top-40 margin-bottom-0">
    						<li><a class="fb-share" href="#"><i class="fa fa-facebook"></i> Share</a></li>
    						<li><a class="twitter-share" href="#"><i class="fa fa-twitter"></i> Tweet</a></li>
    						<li><a class="gplus-share" href="#"><i class="fa fa-google-plus"></i> Share</a></li>
    						<!-- <li><a class="pinterest-share" href="#"><i class="fa fa-pinterest-p"></i> Pin</a></li> -->
    					</ul>
    					<div class="clearfix"></div>
    			</div>

    		</div>
    		<!-- Sidebar / End -->

    	</div>
 </div>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyDlBj1qOh8C5xXSmQwpJ08wx_dHHLPqlFc"></script>
@endsection
