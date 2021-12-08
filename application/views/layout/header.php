<!doctype html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <?php
        meta_tags();
        ?>
        <!-- Favicon -->
        <link rel="shortcut icon" href="<?php echo base_url() . 'assets/images/logof.png'; ?>" type="image/x-icon">
        <link rel="icon" href="<?php echo base_url() . 'assets/images/logof.png'; ?>" type="image/x-icon">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Favicon -->
        <!-- Normalize CSS -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/theme2/css/normalize.css">
        <!-- Main CSS -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/theme2/css/main.css">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/theme2/css/bootstrap.min.css">
        <!-- Animate CSS -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/theme2/css/animate.min.css">
        <!-- Font-awesome CSS-->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/theme2/css/font-awesome.min.css">
        <!-- Flaticon CSS-->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/theme2/css//font/flaticon.css">
        <!-- Owl Caousel CSS -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/theme2/css/owl.carousel.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/theme2/css/owl.theme.default.min.css">
        <!-- Main Menu CSS-->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/theme2/css/meanmenu.min.css">
        <!-- Nivo Slider CSS-->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/theme2/lib/custom-slider/css/nivo-slider.css" type="text/css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/theme2/lib/custom-slider/css/preview.css" type="text/css" media="screen" />
        <!-- Select2 CSS -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/theme2/css/select2.min.css">
        <!-- Custom CSS -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/theme2/css/style.css">

        <!-- no slider CSS -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/theme2/js/vendor/nouislider.min.css">

        <!--custom css style-->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/theme2/css/custom_style.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/theme2/css/style2.css">

        <!-- jquery-->
        <script src="<?php echo base_url(); ?>assets/theme2/js/vendor/jquery-2.2.4.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/theme2/js/jquery-ui.js"></script>
        <!-- Modernizr Js -->
        <script src="<?php echo base_url(); ?>assets/theme2/js/vendor/modernizr-2.8.3.min.js"></script>
        <!-- JavaScripts -->
        <script src="<?php echo base_url(); ?>assets/theme/js/vendors/modernizr.js"></script>

        <!--sweet alert-->
        <script src="<?php echo base_url(); ?>assets/theme2/sweetalert2/sweetalert2.min.js"></script>
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/theme2/sweetalert2/sweetalert2.min.css">

        <!--angular js-->
        <script src="<?php echo base_url(); ?>assets/theme2/angular/angular.min.js"></script>
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
            <![endif]-->

    </head>

    <?php
    $menucontainer = array();
    ?>
    <style>
        .preloadimage{
            background: black;
            top: 28%;
            position: absolute;
            height:100px; 

            margin-left: -90px;
        }
    </style>

    <!-- Modal Dialog Box End Here-->
    <!-- Preloader Start Here -->
    <!--    <div id="preloader">
            <center>
                <img class="preloadimage  " src="<?php echo base_url() . 'assets/theme2/img/preloader.gif' ?>" alt="logo" >
            </center>
        </div>-->
    <!-- Preloader End Here -->
    <body ng-app="App">
        <div class="wrapper-area" ng-controller="ShopController" id="ShopController">
            <!--[if lt IE 8]>
                <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
            <![endif]-->
            <!-- Add your site or application content here -->
            <!-- Header Area Start Here -->



            <script>


                        var App = angular.module('App', []).config(function ($interpolateProvider, $httpProvider) {
                            //$interpolateProvider.startSymbol('{$');
                            //$interpolateProvider.endSymbol('$}');
                            $httpProvider.defaults.headers.common = {};
                            $httpProvider.defaults.headers.post = {};
                        });
                        var baseurl = "<?php echo site_url(); ?>";
                        var imageurlg = "<?php echo PRODUCTIMAGELINK; ?>";
                        var globlecurrency = "<?php echo globle_currency; ?>";
                        var avaiblecredits = 0;</script>

            <style>
                .ownmenu .dropdown.megamenu .dropdown-menu li:last-child{
                    margin-bottom: 20px;
                }

                .ownmenu .dropdown.megamenu .dropdown-menu li a{
                    line-height: 25px;
                }
                .account-wishlist ul li a {
                    font-size: 12px;
                }
            </style>


            <!-- Header Area Start Here -->

            <!-- Header Area Start Here -->
            <header>




                <div class="header-area-style2" id="sticker">



                    <div class="header-top-inner-top">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                                    <div class="header-contact">
                                        <ul>
                                            <li><i class="fa fa-whatsapp" aria-hidden="true"></i><a href="https://api.whatsapp.com/send?phone=85261428189"> +(852) 6142 8189</a></li>
                                            <li><i class="fa fa-envelope" aria-hidden="true"></i><a href="mailto:Sales@Maharajatickets.com"> Sales@Maharajatickets.com</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                    <div class="account-wishlist">
                                        <ul>
                                            <li><a href=""><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                            <li><a href=""><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                            <li><a href=""><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                                            <li><a href=""><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
                                            <li><a href=""><i class="fa fa-youtube" aria-hidden="true"></i></a></li></ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="header-top" style=" ">
                        <div class="container" >
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-5 col-xs-12">
                                    <div class="account-wishlist" style="font-size: 12px;">

                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-2 hidden-xs">



                                    <div class="logo-area">
                                        <a href="<?php echo site_url("/"); ?>"><img class="img-responsive mainsitelogo" src="<?php echo base_url(); ?>assets/images/logo.png" alt="logo" ></a>

                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-5 col-xs-12">

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="header-bottom">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="logo-area" >
                                        <a href="<?php echo site_url("/"); ?>"><img class="img-responsive mainsitelogo" src="<?php echo base_url(); ?>assets/images/logo.png" alt="logo" ></a>

                                    </div>
                                    <div class="main-menu-area home2-sticky-area">
                                        <nav>
                                            <ul>
                                                <li class="active"><a href="<?php echo site_url("/") ?>">Home</a>        </li>
                                                <li><a href="<?php echo site_url("Movies/index"); ?>">Movies</a></li>
                                                <li><a href="<?php echo site_url("Movies/index"); ?>">Book Now</a></li>
                                                <!--<li><a href="<?php echo site_url("Movies/ticketPayment"); ?>">Pay For Tickets</a></li>-->
                                                <li><a href="<?php echo site_url("Movies/blog"); ?>">Blog</a></li>

                                                <li><a href="https://api.whatsapp.com/send/?phone=85256818131&text&app_absent=0">Contact</a></li>
                                            </ul>
                                        </nav>
                                    </div>
                                 
                                </div>
                            </div>
                        </div>
                        <!-- Mobile Menu Area Start Here -->
                        <div class="mobile-menu-area">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mobile-menu">
                                            <nav id="dropdown">
                                                <ul>
                                                    <li class="active"><a href="<?php echo site_url("/") ?>">Home</a>        </li>
                                                    <li><a href="<?php echo site_url("Movies/index"); ?>">Movies</a></li>
                                                    <li><a href="<?php echo site_url("Movies/index"); ?>">Book Now</a></li>
                                                    <!--<li><a href="<?php echo site_url("Movies/ticketPayment"); ?>">Pay For Tickets</a></li>-->
                                                    <li><a href="<?php echo site_url("Movies/blog"); ?>">Blog</a></li>

                                                    <li><a href="https://api.whatsapp.com/send/?phone=85256818131&text&app_absent=0">Contact</a></li>
                                                </ul>
                                            </nav>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Mobile Menu Area End Here -->
                    </div>
                </div>
            </header>




        </header>


        <!-- Getbutton.io widget -->
        <script type="text/javascript">
            (function () {
                var options = {
                    whatsapp: "85261428189", // WhatsApp number
                    call_to_action: "Contact Us", // Call to action
                    position: "right", // Position may be 'right' or 'left'
                };
                var proto = document.location.protocol, host = "getbutton.io", url = proto + "//static." + host;
                var s = document.createElement('script');
                s.type = 'text/javascript';
                s.async = true;
                s.src = url + '/widget-send-button/js/init.js';
                s.onload = function () {
                    WhWidgetSendButton.init(host, proto, options);
                };
                var x = document.getElementsByTagName('script')[0];
                x.parentNode.insertBefore(s, x);
            })();
        </script>
        <!-- /Getbutton.io widget -->



        <!--mobile model-->






