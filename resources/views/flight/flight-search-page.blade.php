@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="loader">
            <img src="{{URL::asset('/images/loader.gif')}}">
        </div>
        <div class="clearfix"></div>
            <!-- Header Container / End -->

            <div class="main-search-container" data-background-image="/images/main-search-background-01.jpg">
    <div class="main-search-inner">

        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>Booking Made Easier</h2>
                    <h4>Expolore top-rated attractions, activities and more</h4>
                    <div class="categories-boxes-container margin-top-5  ">
                    <ul class="nav nav-tabs search1">
                        <li>
                        <!-- Box -->
                        <a data-toggle="tab" href="#bus" class="category-small-box">
                            <i class="im im-icon-Bus"></i>
                            <h4>Bus</h4>
                        </a>
                        </li>
                        <li>
                        <!-- Box -->
                        <a data-toggle="tab" href="#vehicle" class="category-small-box">
                            <i class="im  im-icon-Car-3"></i>
                            <h4>Vehicle</h4>
                        </a>
                        </li>
                        <li>
                        <!-- Box -->
                        <a  data-toggle="tab" href="#tour" class="category-small-box">
                            <i class="im im-icon-Shopping-Bag"></i>
                            <h4>Tour Packages</h4>
                        </a>
                        </li>
                        <li>
                        <!-- Box -->
                        <a data-toggle="tab" href="#hotel" class="category-small-box">
                            <i class="im im-icon-Hotel"></i>
                            <h4>Hotels</h4>
                        </a>
                        </li>
                        <li class="active">
                        <!-- Box -->
                        <a data-toggle="tab" href="#flight" class="category-small-box">
                            <i class="im im-icon-On-Air"></i>
                            <h4>Flight</h4>
                        </a>
                        </li>
                        <li>
                        <!-- Box -->
                        <a data-toggle="tab" href="#recharge" class="category-small-box">
                            <i class="im im-icon-Hand-TouchSmartphone"></i>
                            <h4>Recharge</h4>
                        </a>
                        </li>
                    </ul>
                    
                </div>  
                      <div class="tab-content">
                        <div id="flight" class="tab-pane fade active in">
                            <h3>Flight Booking</h3>
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
                                    @foreach($response as $items)
                                        <option value="{{$items->AirportCode}}">{{$items->City}}<em>    </em>{{$items->AirportCode}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="main-search-input-item">
                               <select name="destination" id="destination" data-placeholder="Destination" class="chosen-select" style="padding-left: 20px;width:200px;">
                                    @foreach($response as $items)
                                        <option value="{{$items->AirportCode}}">{{$items->City}}<em>    </em>{{$items->AirportCode}}</option>
                                    @endforeach
                                </select>     
                            </div>
                            <div id="depart-date" class="main-search-input-item location date1">
                                <a href="#"><i class="fa fa-calendar"></i></a>
                                <input type="text" name="depart-date" onfocus="(this.type='date')" class="datepicker" placeholder="Depart Date" name="return-date" value=""/>                                                         
                            </div>

                            <div id="flight-return" class="main-search-input-item location date1">
                                <a href="#"><i class="fa fa-calendar"></i></a>
                                <input type="text" name="return-date" onfocus="(this.type='date')" class="datepicker" placeholder="Return Date" value=""/>                                                         
                            </div>

                            
                            <button class="button flightloader" type="submit">Search</button>
                          </div>
                        </div>
                </form> 
                    </div>                  
                                                
                </div>
            </div>
        </div>

    </div>
</div>

<div class="container">
    <div class="row">

        <div class="col-md-12">
            <h3 class="headline centered margin-top-75">
                Unwind | Relax | Breathe
                <span>All your travel <i> bookings </i> are available here</span>
            </h3>
        </div>

    </div>
</div>


<!-- Categories Carousel -->
<div class="fullwidth-carousel-container margin-top-25">
    <div class="fullwidth-slick-carousel category-carousel">

        <!-- Item -->
        <div class="fw-carousel-item">

            <!-- this (first) box will be hidden under 1680px resolution -->
            <div class="category-box-container half">
                <a href="#." class="category-box" data-background-image="/images/category-box-01.jpg">
                    <div class="category-box-content">
                        <h3>Bus Booking</h3>
                        <span>One way & two way</span>
                    </div>
                    <span class="category-box-btn">Browse</span>
                </a>
            </div>

            <div class="category-box-container half">
                <a href="#." class="category-box" data-background-image="/images/c2.jpg">
                    <div class="category-box-content">
                        <h3>Vehicle Booking</h3>
                        <span>Local & Outsations</span>
                    </div>
                    <span class="category-box-btn">Browse</span>
                </a>
            </div>
        </div>

        <!-- Item -->
        <div class="fw-carousel-item">
            <div class="category-box-container">
                <a href="#." class="category-box" data-background-image="/images/c1.jpg">
                    <div class="category-box-content">
                        <h3>Bus Booking</h3>
                        <span>One way & two way</span>
                    </div>
                    <span class="category-box-btn">Browse</span>
                </a>
            </div>
        </div>

        <!-- Item -->
        <div class="fw-carousel-item">
            <div class="category-box-container">
                <a href="#." class="category-box" data-background-image="/images/c3.jpg">
                    <div class="category-box-content">
                        <h3>Tour Packages</h3>
                        <span>Memorable & full of fun</span>
                    </div>
                    <span class="category-box-btn">Browse</span>
                </a>
            </div>
        </div>

        <!-- Item -->
        <div class="fw-carousel-item">
            <div class="category-box-container">
                <a href="listings-half-screen-map-grid-1.html" class="category-box" data-background-image="/images/c4.jpg">
                    <div class="category-box-content">
                        <h3>Recharge</h3>
                        <span>Mobile, Postpaid, DTH & Datacards</span>
                    </div>
                    <span class="category-box-btn">Browse</span>
                </a>
            </div>
        </div>

        <!-- Item -->
        <div class="fw-carousel-item">
            <div class="category-box-container">
                <a href="listings-half-screen-map-list.html" class="category-box" data-background-image="/images/c5.jpg">
                    <div class="category-box-content">
                        <h3>Hotels</h3>
                        <span>Resonable pricings</span>
                    </div>
                    <span class="category-box-btn">Browse</span>
                </a>
            </div>
        </div>

        <!-- Item -->
        <div class="fw-carousel-item">
            <div class="category-box-container">
                <a href="#." class="category-box" data-background-image="/images/c6.jpg">
                    <div class="category-box-content">
                        <h3>Flight</h3>
                        <span>One way & two way</span>
                    </div>
                    <span class="category-box-btn">Browse</span>
                </a>
            </div>
        </div>

    </div>
</div>
<!-- Categories Carousel / End -->



<!-- Fullwidth Section -->
<section class="fullwidth margin-top-65 padding-top-75 padding-bottom-70" data-background-color="#f8f8f8">

    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <h3 class="headline centered margin-bottom-45">
                    Most Visited Places
                    <span>Discover top-rated package tours</span>
                </h3>
            </div>

            <div class="col-md-12">
                <div class="simple-slick-carousel dots-nav">

                <!-- Listing Item -->
                <div class="carousel-item">
                    <a href="#." class="listing-item-container">
                        <div class="listing-item">
                            <img src="/images/l1.jpg" alt="">

                            <div class="listing-badge now-open">Most Popular</div>
                            
                            <div class="listing-item-content">
                                <span class="tag">Group Tours</span>
                                <h3>DUBAI DELIGHT</h3>
                                <span>5 Days/ 4 Nights</span>
                            </div>
                            <span class="like-icon"></span>
                        </div>
                        <div class="star-rating" data-rating="3.5">
                            <div class="rating-counter">(12 reviews)</div>
                        </div>
                    </a>
                </div>
                <!-- Listing Item / End -->

                <!-- Listing Item -->
                <div class="carousel-item">
                    <a href="#." class="listing-item-container">
                        <div class="listing-item">
                            <img src="/images/l2.jpg" alt="">
                            <div class="listing-item-details">
                                <ul>
                                    <li>Friday, September 1st</li>
                                </ul>
                            </div>
                            <div class="listing-item-content">
                                <span class="tag">Group Tours</span>
                                <h3>Kashmir Special</h3>
                                <span>5 Days / 4 Nights</span>
                            </div>
                            <span class="like-icon"></span>
                        </div>
                        <div class="star-rating" data-rating="5.0">
                            <div class="rating-counter">(23 reviews)</div>
                        </div>
                    </a>
                </div>
                <!-- Listing Item / End -->     

                <!-- Listing Item -->
                <div class="carousel-item">
                    <a href="#." class="listing-item-container">
                        <div class="listing-item">
                            <img src="/images/l3.jpg" alt="">
                            <div class="listing-item-details">
                                <ul>
                                    <li>Monday, September 4th </li>
                                </ul>
                            </div>
                            <div class="listing-item-content">
                                <span class="tag">Group Tours</span>
                                <h3>South India Tours</h3>
                                <span>3 Days / 2 Nights</span>
                            </div>
                            <span class="like-icon"></span>
                        </div>
                        <div class="star-rating" data-rating="2.0">
                            <div class="rating-counter">(17 reviews)</div>
                        </div>
                    </a>
                </div>
                <!-- Listing Item / End -->

                <!-- Listing Item -->
                <div class="carousel-item">
                    <a href="#." class="listing-item-container">
                        <div class="listing-item">
                            <img src="/images/l4.jpg" alt="">

                            <div class="listing-badge now-open">Bookings open</div>

                            <div class="listing-item-content">
                                <span class="tag">Wed, September 6th </span>
                                <h3>Amazing Kerala</h3>
                                <span>3 Days / 2 Nights</span>
                            </div>
                            <span class="like-icon"></span>
                        </div>
                        <div class="star-rating" data-rating="5.0">
                            <div class="rating-counter">(31 reviews)</div>
                        </div>
                    </a>
                </div>
                <!-- Listing Item / End -->

                <!-- Listing Item -->
                <div class="carousel-item">
                    <a href="#." class="listing-item-container">
                        <div class="listing-item">
                            <img src="/images/l5.jpg" alt="">
                            <div class="listing-item-content">
                                <span class="tag">Group Tours</span>
                                <h3>Go Goa</h3>
                                <span>Friday, 5th September</span>
                            </div>
                            <span class="like-icon"></span>
                        </div>
                        <div class="star-rating" data-rating="3.5">
                            <div class="rating-counter">(46 reviews)</div>
                        </div>
                    </a>
                </div>
                <!-- Listing Item / End -->

                <!-- Listing Item -->
                <div class="carousel-item">
                    <a href="#." class="listing-item-container">
                        <div class="listing-item">
                            <img src="/images/l6.jpg" alt="">

                            <div class="listing-badge now-closed">Now Closed</div>

                            <div class="listing-item-content">
                                <span class="tag">Group Tours</span>
                                <h3>Thailand</h3>
                                <span>Tuesday, 15th sep</span>
                            </div>
                            <span class="like-icon"></span>
                        </div>
                        <div class="star-rating" data-rating="4.5">
                            <div class="rating-counter">(15 reviews)</div>
                        </div>
                    </a>
                </div>
                <!-- Listing Item / End -->
                </div>
                
            </div>

        </div>
    </div>

</section>
<!-- Fullwidth Section / End -->


<!-- Info Section -->
<div class="container">

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h2 class="headline centered margin-top-80">
                Easy Booking
                <span class="margin-top-25">Explore some of the best services from around the world from our wide range of facilities.  </span>
            </h2>
        </div>
    </div>

    <div class="row icons-container">
        <!-- Stage -->
        <div class="col-md-4">
            <div class="icon-box-2 with-line">
                <i class="im im-icon-Map2"></i>
                <h3>Choose your destination</h3>
                <p>Proin dapibus nisl ornare diam varius tempus. Aenean a quam luctus, finibus tellus ut, convallis eros sollicitudin turpis.</p>
            </div>
        </div>

        <!-- Stage -->
        <div class="col-md-4">
            <div class="icon-box-2 with-line">
                <i class="im im-icon-Address-Book2"></i>
                <h3>Send in your schedule</h3>
                <p>Maecenas pulvinar, risus in facilisis dignissim, quam nisi hendrerit nulla, id vestibulum metus nullam viverra porta purus.</p>
            </div>
        </div>

        <!-- Stage -->
        <div class="col-md-4">
            <div class="icon-box-2">
                <i class="im im-icon-Checked-User"></i>
                <h3>Make a Reservation</h3>
                <p>Faucibus ante, in porttitor tellus blandit et. Phasellus tincidunt metus lectus sollicitudin feugiat pharetra consectetur.</p>
            </div>
        </div>
    </div>

</div>
<!-- Info Section / End -->


<!-- Recent Blog Posts -->
<section class="fullwidth border-top margin-top-70 padding-top-75 padding-bottom-75" data-background-color="#fff">
    <div class="container">

        <div class="row">
            <div class="col-md-12">
                <h3 class="headline centered margin-bottom-45">
                    Our Services
                </h3>
            </div>
        </div>

        <div class="row">
            <!-- Blog Post Item -->
            <div class="col-md-4">
                <a href="#." class="blog-compact-item-container">
                    <div class="blog-compact-item">
                        <img src="/images/b1.jpg" alt="">
                        <span class="blog-item-tag">Fast & Easy</span>
                        <div class="blog-compact-item-content">
                            <ul class="blog-post-tags">
                                <li> </li>
                            </ul>
                            <h3>Online Real-Time Booking</h3>
                            <p>Sed sed tristique nibh iam porta volutpat finibus. Donec in aliquet urneget mattis lorem. Pellentesque pellentesque.</p>
                        </div>
                    </div>
                </a>
            </div>
            <!-- Blog post Item / End -->

            <!-- Blog Post Item -->
            <div class="col-md-4">
                <a href="#." class="blog-compact-item-container">
                    <div class="blog-compact-item">
                        <img src="/images/b2.jpg" alt="">
                        <span class="blog-item-tag">Just one click</span>
                        <div class="blog-compact-item-content">
                            <ul class="blog-post-tags">
                                <li></li>
                            </ul>
                            <h3>Print or View Tickets</h3>
                            <p>Sed sed tristique nibh iam porta volutpat finibus. Donec in aliquet urneget mattis lorem. Pellentesque pellentesque.</p>
                        </div>
                    </div>
                </a>
            </div>
            <!-- Blog post Item / End -->

            <!-- Blog Post Item -->
            <div class="col-md-4">
                <a href="#." class="blog-compact-item-container">
                    <div class="blog-compact-item">
                        <img src="/images/b3.jpg" alt="">
                        <span class="blog-item-tag">Get Tickets</span>
                        <div class="blog-compact-item-content">
                            <ul class="blog-post-tags">
                                <li></li>
                            </ul>
                            <h3>To your Mobile</h3>
                            <p>Sed sed tristique nibh iam porta volutpat finibus. Donec in aliquet urneget mattis lorem. Pellentesque pellentesque.</p>
                        </div>
                    </div>
                </a>
            </div>
            <!-- Blog post Item / End -->

            <div class="col-md-12 centered-content">
                <a href="#." class="button border margin-top-10">View All</a>
            </div>

        </div>

    </div>
</section>
    </div>
    </div>
@endsection
