<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Pavan Yatra') }}</title>

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">
    <meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<!-- CSS
================================================== -->
<link rel="stylesheet" href="{{URL::asset('css/style4963.css?ver=1.1')}}">
<link rel="stylesheet" href="{{URL::asset('css/custom.css')}}">
<link rel="stylesheet" href="{{URL::asset('css/plugins/timedropper.css')}}">
<link rel="stylesheet" href="{{URL::asset('css/plugins/datedropper.css')}}">
<link rel="stylesheet" href="{{URL::asset('css/snappy.css')}}">
<link rel="stylesheet" href="{{URL::asset('css/selectize.css')}}">
<link rel="stylesheet" href="{{URL::asset('css/colors/main.css" id="colors')}}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.4/css/selectize.bootstrap3.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="{{URL::asset('css/plugins/custom_css.css')}}">
  @yield('styles')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script type="text/javascript">
    $(document).ready(function(){
    $('#purpose').on('change', function() {
      if ( this.value == 'two')
      //.....................^.......
      {
        $("#return").show();
      }
      else
      {
        $("#return").hide();
      }
    });
       $('#vehicle-purpose').on('change', function() {
      if ( this.value == 'two')
      //.....................^.......
      {
        $("#vehicle-return").show();
      }
      else
      {
        $("#vehicle-return").hide();
      }
    });
        $('#flight-purpose').on('change', function() {
      if ( this.value == 'two')
      //.....................^.......
      {
        $("#flight-return").show();
      }
      else
      {
        $("#flight-return").hide();
      }
    });

});
  </script>

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>
<header id="header-container">

    <!-- Header -->
    <div id="header">
        <div class="container">

            <!-- Left Side Content -->
            <div class="left-side">

                <!-- Logo -->
                <div id="logo">
                    <a href="/"><img src="{{URL::asset('images/logo.jpg')}}" alt=""></a>
                </div>

                <!-- Mobile Navigation -->
                <div class="menu-responsive">
                    <i class="fa fa-reorder menu-trigger"></i>
                </div>

                <!-- Main Navigation -->
                <nav id="navigation" class="style-1">
                    <ul id="responsive">

                        <li><a class="current" href="/">Home</a>
                        </li>

                        <li><a href="#">Booking</a>
                            <ul>
                                <li><a href="#.">Bus</a></li>
                                <li><a href="#.">Vehicle</a></li>
                                <li><a href="#.">Tour Packages</a></li>
                                <li><a href="#.">Hotels</a></li>
                                <li><a href="#.">Flight</a></li>
                                <li><a href="#."></a></li>

                            </ul>
                        </li>
                        <li><a href="#.">Recharge</a></li>

                        <li><a href="#">About us</a>
                            <ul>
                                <li><a href="#.">About us</a></li>
                                <li><a href="#.">Contact</a></li>
                                <li><a href="#.">Faqs</a></li>
                                <li><a href="#.">Terms and conditions</a></li>
                                <li><a href="#.">Privacy policy</a></li>
                                <li><a href="#.">User agreement</a></li>
                            </ul>
                        </li>

                    </ul>
                </nav>
                <div class="clearfix"></div>
                <!-- Main Navigation / End -->

            </div>
            <!-- Left Side Content / End -->


            <!-- Right Side Content / End -->
            <div class="right-side">
                <div class="header-widget">
                    <a href="#sign-in-dialog" class="sign-in popup-with-zoom-anim"><i class="sl sl-icon-login"></i> Sign In</a>
                    <a href="#." class="button border with-icon">REGISTER <i class="sl sl-icon-plus"></i></a>
                </div>
            </div>
            <!-- Right Side Content / End -->

            <!-- Sign In Popup -->
            <div id="sign-in-dialog" class="zoom-anim-dialog mfp-hide">

                <div class="small-dialog-header">
                    <h3>Sign In</h3>
                </div>

                <!--Tabs -->
                <div class="sign-in-form style-1">

                    <ul class="tabs-nav">
                        <li class=""><a href="#tab1">Log In</a></li>
                        <li><a href="#tab2">Register</a></li>
                    </ul>

                    <div class="tabs-container alt">

                        <!-- Login -->
                        <div class="tab-content" id="tab1" style="display: none;">
                            <form method="post" class="login">

                                <p class="form-row form-row-wide">
                                    <label for="username">Username:
                                        <i class="im im-icon-Male"></i>
                                        <input type="text" class="input-text" name="username" id="username" value="" />
                                    </label>
                                </p>

                                <p class="form-row form-row-wide">
                                    <label for="password">Password:
                                        <i class="im im-icon-Lock-2"></i>
                                        <input class="input-text" type="password" name="password" id="password"/>
                                    </label>
                                    <span class="lost_password">
                                        <a href="#" >Lost Your Password?</a>
                                    </span>
                                </p>

                                <div class="form-row">
                                    <input type="submit" class="button border margin-top-5" name="login" value="Login" />
                                    <div class="checkboxes margin-top-10">
                                        <input id="remember-me" type="checkbox" name="check">
                                        <label for="remember-me">Remember Me</label>
                                    </div>
                                </div>

                            </form>
                        </div>

                        <!-- Register -->
                        <div class="tab-content" id="tab2" style="display: none;">

                            <form method="post" class="register">

                            <p class="form-row form-row-wide">
                                <label for="username2">Username:
                                    <i class="im im-icon-Male"></i>
                                    <input type="text" class="input-text" name="username" id="username2" value="" />
                                </label>
                            </p>

                            <p class="form-row form-row-wide">
                                <label for="email2">Email Address:
                                    <i class="im im-icon-Mail"></i>
                                    <input type="text" class="input-text" name="email" id="email2" value="" />
                                </label>
                            </p>

                            <p class="form-row form-row-wide">
                                <label for="password1">Password:
                                    <i class="im im-icon-Lock-2"></i>
                                    <input class="input-text" type="password" name="password1" id="password1"/>
                                </label>
                            </p>

                            <p class="form-row form-row-wide">
                                <label for="password2">Repeat Password:
                                    <i class="im im-icon-Lock-2"></i>
                                    <input class="input-text" type="password" name="password2" id="password2"/>
                                </label>
                            </p>

                            <input type="submit" class="button border fw margin-top-10" name="register" value="Register" />

                            </form>
                        </div>

                    </div>
                </div>
            </div>
            <!-- Sign In Popup / End -->

        </div>
    </div>
    <!-- Header / End -->

</header>

        @yield('content');

<!-- Footer
================================================== -->
<div id="footer" class="sticky-footer">
    <!-- Main -->
    <div class="container">
        <div class="row">
            <div class="col-md-5 col-sm-6">
                <img class="footer-logo" src="{{URL::asset('images/logo.jpg')}}" alt="Pavan Yatra">
                <br><br>
                <p>We are the people from tourism business with more than 10 years experience in conducting package tours in more pleasant,relaxing and non chaotic way for our clients. Now we are intended to expand our service online.</p>
            </div>

            <div class="col-md-4 col-sm-6 ">
                <h4>Helpful Links</h4>
                <ul class="footer-links">
                    <li><a href="#">Login</a></li>
                    <li><a href="#">Sign Up</a></li>
                    <li><a href="#">Booking</a></li>
                    <li><a href="#.">Recharge</a></li>
                    <li><a href="#.">About us</a></li>

                </ul>

                <ul class="footer-links">
                    <li><a href="#.">Contact</a></li>
                    <li><a href="#.">Faqs</a></li>
                    <li><a href="#">TnC</a></li>
                    <li><a href="#">Privacy policy</a></li>
                    <li><a href="#">User agreement</a></li>
                </ul>
                <div class="clearfix"></div>
            </div>

            <div class="col-md-3  col-sm-12">
                <h4>Contact Us</h4>
                <div class="text-widget">
                    <span>Lorem ipsum street, Karnataka, India</span> <br>
                    Phone: <span>(123) 123-456 </span><br>
                    E-Mail:<span> <a href="#">info@pavanyatra.com</a> </span><br>
                </div>

                <ul class="social-icons margin-top-20">
                    <li><a class="facebook" href="#"><i class="icon-facebook"></i></a></li>
                    <li><a class="twitter" href="#"><i class="icon-twitter"></i></a></li>
                    <li><a class="gplus" href="#"><i class="icon-gplus"></i></a></li>
                    <li><a class="vimeo" href="#"><i class="icon-vimeo"></i></a></li>
                </ul>

            </div>

        </div>

        <!-- Copyright -->
        <div class="row">
            <div class="col-md-12">
                <div class="copyrights">© 2017 pavan yatra. All Rights Reserved.</div>
            </div>
        </div>

    </div>

</div>
<!-- Footer / End -->

    <!-- Scripts -->
    <script src="/js/app.js"></script>
<script defer type="text/javascript" src="/scripts/jquery-2.2.0.min.js"></script>
<script defer type="text/javascript" src="/scripts/jpanelmenu.min.js"></script>
<script defer type="text/javascript" src="/scripts/chosen.min.js"></script>
<script defer type="text/javascript" src="/scripts/slick.min.js"></script>
<script defer type="text/javascript" src="/scripts/rangeslider.min.js"></script>
<script defer type="text/javascript" src="/scripts/magnific-popup.min.js"></script>
<script defer type="text/javascript" src="/scripts/waypoints.min.js"></script>
<script defer type="text/javascript" src="/scripts/counterup.min.js"></script>
<script defer type="text/javascript" src="/scripts/jquery-ui.min.js"></script>
<script defer type="text/javascript" src="/scripts/tooltips.min.js"></script>
<script defer type="text/javascript" src="/js/selectize.min.js"></script>

<script defer type="text/javascript" src="/scripts/custom.js"></script>
<script defer type="text/javascript" src="/scripts/timedropper.js"></script>
<script defer type="text/javascript" src="/scripts/datedropper.js"></script>
<script defer type="text/javascript" src="/js/custom.js"></script>
</body>
</html>
