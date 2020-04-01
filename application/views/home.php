<?php
$this->load->view('layout/header');
?>
<!-- Slider Area Start Here -->
<!--<div class="main-slider2">
    <div class="bend niceties preview-1">
        <div id="ensign-nivoslider-3" class="slides">
<?php
foreach ($sliders as $key => $value) {
    ?>
                                                                                                                                                                        <img src="<?php echo imageserverslider . $value->file_name; ?>" alt="" title="#slider-direction-<?php echo $key; ?>" />
    <?php
}
?>        
        </div>


<?php
foreach ($sliders as $key => $value) {
    ?>
                                                                                                                                                                    <div id="slider-direction-<?php echo $key; ?>" class="t-cn slider-direction">
                                                                                                                                                                        <div class="slider-content t-lfl s-tb slider-1">
                                                                                                                                                                            <div class="title-container s-tb-c">
                                                                                                                                                                                <h2 class="title<?php echo $key; ?>" style="color:<?php echo $value->title_color; ?>">
    <?php echo $value->title; ?>
                                                                                                                                                                                </h2>
                                                                                                                                                                                <p style="color:<?php echo $value->line1_color; ?>"><?php echo $value->line1; ?></p>
                                                                                                                                                                                <p style="color:<?php echo $value->line2_color; ?>"><?php echo $value->line2; ?></p>
                                                                                                                                                                                <a href="<?php echo $value->link; ?>" class="btn-shop-now-fill-slider"><?php echo $value->link_text; ?></a>
                                                                                                                                                                            </div>
                                                                                                                                                                        </div>
                                                                                                                                                                    </div>
    <?php
}
?>

    </div>
</div>-->
<!-- Slider Area End Here -->
<div ng-controller="HomeController">

    <!-- Slider Area Start Here -->
    <div class="main-slider2">
        <div class="bend niceties preview-1">
            <div id="ensign-nivoslider-3" class="slides">
                <img src="<?php echo base_url(); ?>assets/sliders/cinema-ticket-banner.jpg" alt="" title="#slider-direction-2" />
                <img src="<?php echo base_url(); ?>assets/sliders/home-banner-4.jpg" alt="" title="#slider-direction-4" />

            </div>
          

            <div id="slider-direction-2" class="t-cn slider-direction">
                <div class="slider-content t-lfr s-tb slider-3">
                    <div class="title-container s-tb-c">
                        <h2 class="title1" style="font-size: 23px;"><span style="font-size: 40px;">Bollywood Movie Tickets
                            </span> <br>For Bookings Call / Whatsapp - +(852) 6142 8189
                        </h2>
                        <a href="#" class="btn-shop-now-fill-slider">Contact Us</a>
                    </div>
                </div>
            </div>


            <div id="slider-direction-4" class="t-cn slider-direction">
                <div class="slider-content t-lfr s-tb slider-3">
                    <div class="title-container s-tb-c">
                        <h2 class="title1" style="font-size: 23px;">
                            <span style="font-size: 40px;">
                            </span> 
                        </h2>
                    </div>
                </div>
            </div>

         


        </div>
    </div>
    <!-- Slider Area End Here -->



    <div class="product2-area">
        <div class="container-fluid" >
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="section-title">
                        <span class="title-bar-left"></span>
                        <h2>Book Now</h2>
                        <span class="title-bar-right"></span>
                    </div>
                </div>
            </div>

            <div class="row featuredContainer">
               <?php
            foreach ($moves as $key => $catv) {
                ?>
                
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-6">
                    <div class="portfolio2-box">
                        <div class="portfolio2-img-holder">
                            <div class="portfolio2-content-holder">
                                <h3><a href="#"><?php echo $catv['title']?></a></h3>
                                <ul>
                                    <li><?php echo $catv['attr']?></li>
                                </ul>
                                <a href="<?php echo site_url('Movies/showTime/'.$catv['id'])?>" style="margin-top: 10px;" class="button btn btn-default">Book Now</a>
                            </div>
                            <a href="#">
                                <img class="img-responsive" src="<?php echo base_url(); ?>assets/movies/<?php echo $catv['image'];?>" alt="portfolio">
                            </a>
                        </div>
                    </div>
                </div>

                <?php
            }
            ?>

            </div>
        </div>
    </div>
    <img src="<?php echo base_url(); ?>assets/movies/moviebanner.jpg" alt="offer" style="width:100%">

    <div class="offer-area1 hidden-after-desk movieblockhome">

        <div class="" style="padding: 0px 50px;">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="brand-area-box-l" style="padding-top: 24px;">
                        <span>Movie Ticket Price From </span>
                        <h1>HK$ 180 Only</h1>
                        <p>Choose your Ticket Price<br/> $220 (J-O) - $200 (E-I) - $180 (C-D)</p>
                        <a href="<?php echo site_url("Movies/index");?>" class="btn-shop-now-fill">Book Now</a>
                    </div>
                </div>
                <div id="countdown2">
                   
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="brand-area-box-r">
                        <a href="#"><img src="<?php echo base_url(); ?>assets/movies/movieposter1.jpg" alt="offer"></a>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <video autoplay loop muted poster="screenshot.jpg" id="background">
        <source src="<?php echo base_url(); ?>assets/sliders/maharajaticket.mp4" type="video/mp4">
    </video>


    <!-- Brand Area End Here -->


    <div class="container">
         <div class="section-title">
                <span class="title-bar-left"></span>
                <h2>Our  Partner</h2>
                <span class="title-bar-right"></span>
            </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="banner-bottom-left col-lg-6 col-md-6 col-sm-6 col-xs-12"><a href="http://maharajamart.com"><img src="<?php echo base_url(); ?>assets/images/maharajamart.jpeg" alt=""></a></div>
            <div class="banner-bottom-right col-lg-6 col-md-6 col-sm-6 col-xs-12"><a href="https://www.woodlandshk.com/"><img class="img-responsive" src="<?php echo base_url(); ?>assets/images/woodlandrest.jpeg" alt=""></a></div>
        </div>
    </div>

</div>
<?php
$this->load->view('layout/footer');
?>