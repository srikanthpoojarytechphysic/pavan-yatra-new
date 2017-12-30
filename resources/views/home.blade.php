@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="clearfix"></div>
            <!-- Header Container / End -->

            <div class="main-search-container" data-background-image="images/main-search-background-01.jpg">
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
                        <a data-toggle="tab" href="/hotels" class="category-small-box">
                            <i class="im im-icon-Hotel"></i>
                            <h4>Hotels</h4>
                        </a>
                        </li>
                        <li class="active">
                        <!-- Box -->
                        <a data-toggle="" href="/flights" class="category-small-box">
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
                        <div id="bus" class="tab-pane fade in active">
                            <h3>Bus Booking</h3>
                          <div class="main-search-input">
                            <div class="main-search-input-item">
                                <select id='purpose' data-placeholder="" class="chosen-select" >
                                    <option></option>
                                    <option value="one">One Way</option>
                                    <option value="two">Two Way</option>
                                </select>
                            </div>
                            <div class="main-search-input-item location">
                                <a href="#"><i class="fa fa-map-marker"></i></a>
                                <input type="text" placeholder="Source City" value=""/>

                            </div>
                            <div class="main-search-input-item location">
                                <a href="#"><i class="fa fa-map-marker"></i></a>
                                <input type="text" placeholder="Destination City" value=""/>

                            </div>
                            <div class="main-search-input-item location date1">
                                <a href="#"><i class="fa fa-calendar"></i></a>
                                <input type="text" onfocus="(this.type='date')" class="datepicker" placeholder="Departure Date" value=""/>
                            </div>

                            <div id="return" class="main-search-input-item location date1">
                                <a href="#"><i class="fa fa-calendar"></i></a>
                                <input type="text" onfocus="(this.type='date')" class="datepicker" placeholder="Return Date" value=""/>
                            </div>


                            <button class="button" href="#.">Search</button>
                          </div>
                        </div>
                        <div id="vehicle" class="tab-pane fade">
                            <h3>Vehicle Booking</h3>
                          <div class="main-search-input">
                            <div class="main-search-input-item">
                                <select id='vehicle-purpose' data-placeholder="" class="chosen-select" >
                                    <option></option>
                                    <option value="one">One Way</option>
                                    <option value="two">Round Trip</option>
                                </select>
                            </div>
                            <div class="main-search-input-item location">
                                <a href="#"><i class="fa fa-map-marker"></i></a>
                                <input type="text" placeholder="Source City" value=""/>

                            </div>
                            <div class="main-search-input-item location date1">
                                <a href="#"><i class="fa fa-calendar"></i></a>
                                <input type="text" onfocus="(this.type='date')" class="datepicker" placeholder="Departure Date" value=""/>
                            </div>

                            <div id="vehicle-return" class="main-search-input-item location date1">
                                <a href="#"><i class="fa fa-calendar"></i></a>
                                <input type="text" onfocus="(this.type='date')" class="datepicker" placeholder="Return Date" value=""/>
                            </div>


                            <button class="button" href="#.">Search</button>
                          </div>
                        </div>
                        <div id="tour" class="tab-pane fade">
                            <h3>Tour Package Booking</h3>
                          <div class="main-search-input">
                            <div class="">
                                <select data-placeholder="Place of Interest?" class="" id="tour-select">
                                    <option></option>
                                    <option value="South India">South India</option>
                                                        <option value="North India">North India</option>
                                                        <option value="East India">East India</option>
                                                        <option value="West India">West India</option>
                                                        <option value="other">Other</option>

                                </select>
                            </div>
                            <div class="main-search-input-item location">
                                <a href="#"><i class="fa fa-map-marker"></i></a>
                                <input type="text" placeholder="Your City" value=""/>

                            </div>
                            <div class="main-search-input-item location date1">
                                <a href="#"><i class="fa fa-calendar"></i></a>
                                <input type="text" onfocus="(this.type='date')" class="datepicker" placeholder="Preferred Date" value=""/>
                            </div>

                            <div class="main-search-input-item">
                                <select  data-placeholder="No of Days" class="chosen-select" >
                                    <option>No of Days</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                    <option>More</option>
                                </select>

                            </div>
                            <button class="button" href="#.">Search</button>
                          </div>
                        </div>
                        <div id="hotel" class="tab-pane fade">
                            <h3>Hotel Booking</h3>
                          <div class="main-search-input">
                            <div class="main-search-input-item location">
                                <a href="#"><i class="fa fa-map-marker"></i></a>
                                <input type="text" placeholder="Travelling to" value=""/>
                            </div>
                            <div class="main-search-input-item location date1">
                                <a href="#"><i class="fa fa-calendar"></i></a>
                                <input type="text" onfocus="(this.type='date')" class="datepicker" placeholder="Check-in Date" value=""/>
                            </div>
                            <div class="main-search-input-item location date1">
                                <a href="#"><i class="fa fa-calendar"></i></a>
                                <input type="text" onfocus="(this.type='date')" class="datepicker" placeholder="Check-out Date" value=""/>
                            </div>
                            <div class="main-search-input-item location">
                                <a href="#"><i class="fa fa-user"></i></a>
                                <input type="text" placeholder="No of Adults" value=""/>
                            </div>
                            <div class="main-search-input-item location">
                                <a href="#"><i class="fa fa-user"></i></a>
                                <input type="text" placeholder="No of Children" value=""/>
                            </div>
                            <button class="button" href="#.">Search</button>
                          </div>
                        </div>
                        <div id="flight" class="tab-pane fade">
                            <h3>Flight Booking</h3>
                           <div class="main-search-input">
                            <div class="main-search-input-item">
                                <select id='flight-purpose' data-placeholder="" class="chosen-select">
                                    <option></option>
                                    <option value="one">One Way</option>
                                    <option value="two">Round Trip</option>
                                </select>
                            </div>
                            <div class="main-search-input-item">
                                <select id='purpose' data-placeholder="Cabin Class" class="chosen-select" >
                                    <option></option>
                                    <option>Business</option>
                                    <option>Economy</option>
                                    <option>Premium Economy</option>
                                    <option>First</option>
                                </select>
                            </div>
                            <div class="main-search-input-item location">
                                <a href="#"><i class="fa fa-user"></i></a>
                                <input type="text" placeholder="No of Adults" value=""/>

                            </div>
                            <div class="main-search-input-item location">
                                <a href="#"><i class="fa fa-user"></i></a>
                                <input type="text" placeholder="No of Childrens" value=""/>

                            </div>

                          </div>
                          <div class="main-search-input">
                                <select id="departure" data-placeholder="" class="" style="padding-left: 20px;width:200px;">
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                </select>
                            <div class="main-search-input-item location">
                                <a href="#"><i class="fa fa-map-marker"></i></a>
                                <input type="text" placeholder="Destination City" value=""/>

                            </div>
                            <div style="clear: both;"></div>
                            <div class="main-search-input-item location date1">
                                <i class="fa fa-calendar"></i>
                                <input type="text" onfocus="(this.type='date')" class="datepicker" placeholder="Departure Date" value=""/>
                            </div>

                            <div id="flight-return" class="main-search-input-item location date1">
                                <a href="#"><i class="fa fa-calendar"></i></a>
                                <input type="text" onfocus="(this.type='date')" class="datepicker" placeholder="Return Date" value=""/>
                            </div>


                            <button class="button" href="#.">Search</button>
                          </div>
                        </div>
                        <div id="recharge" class="tab-pane fade">
                            <h3>Recharge</h3>
                          <div class="main-search-input">
                            <div class="main-search-input-item">
                                <select id="recharge" data-placeholder="" class="chosen-select" >
                                    <option value="mobile">Mobile</option>

                                    <option value="dth">DTH</option>
                                    <option value="datacard">Datacard</option>
                                    <option value="postpaid">Postpaid</option>
                                </select>
                            </div>
                                <div class="main-search-input-item mobile location">
                                <a href="#"><i class="fa fa-mobile-phone"></i></a>
                                <input type="text" placeholder="Your Mobile Number" value=""/>

                                </div>
                                <div class="main-search-input-item mobile">
                                    <select id='vehicle-purpose' data-placeholder="Select Operator" class="chosen-select" >
                                        <option></option>
                                        <option value="one">Airtel</option>
                                        <option value="two">Vodafone</option>
                                        <option>BSNL</option>
                                        <option>Reliance</option>
                                        <option>Idea</option>
                                    </select>
                                </div>
                                <div class="main-search-input-item location mobile">
                                    <a href="#">&#8377;</a>
                                    <input type="text" placeholder="Enter Amount" value=""/>
                                </div>
                            </div>
                          <div class="down1">
                            <a href="#" class="button browse medium border"> Browse Plans</a>


                            <a class="button medium " href="#.">Recharge</button></a>
                          </div>
                        </div>
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
                <a href="#." class="category-box" data-background-image="images/category-box-01.jpg">
                    <div class="category-box-content">
                        <h3>Bus Booking</h3>
                        <span>One way & two way</span>
                    </div>
                    <span class="category-box-btn">Browse</span>
                </a>
            </div>

            <div class="category-box-container half">
                <a href="#." class="category-box" data-background-image="images/c2.jpg">
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
                <a href="#." class="category-box" data-background-image="images/c1.jpg">
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
                <a href="#." class="category-box" data-background-image="images/c3.jpg">
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
                <a href="listings-half-screen-map-grid-1.html" class="category-box" data-background-image="images/c4.jpg">
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
                <a href="listings-half-screen-map-list.html" class="category-box" data-background-image="images/c5.jpg">
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
                <a href="#." class="category-box" data-background-image="images/c6.jpg">
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
                            <img src="images/l1.jpg" alt="">

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
                            <img src="images/l2.jpg" alt="">
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
                            <img src="images/l3.jpg" alt="">
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
                            <img src="images/l4.jpg" alt="">

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
                            <img src="images/l5.jpg" alt="">
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
                            <img src="images/l6.jpg" alt="">

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
                        <img src="images/b1.jpg" alt="">
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
                        <img src="images/b2.jpg" alt="">
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
                        <img src="images/b3.jpg" alt="">
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
