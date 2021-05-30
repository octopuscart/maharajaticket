<?php
$this->load->view('layout/header');
?>


<!-- Inner Page Banner Area Start Here -->
<div class="inner-page-banner-area" style="    background: url(<?php echo base_url(); ?>assets/images/shop2.jpg);
     background-size: cover;
     background-position: 459px -1031px;">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="breadcrumb-area">
                    <h1>Movies </h1>
                    <ul>
                        <li><a href="#">Home</a> /</li>
                        <li>Select Movie</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Inner Page Banner Area End Here -->
<!-- Contact Us Page Area Start Here -->
<!-- Single Blog Page Area Start Here -->


<div class="portfolio2-page-area1" style="padding: 30px">
    <div class="container-fluid">
        <div class="row text-center">

            <?php
            foreach ($moves as $key => $catv) {
                ?>

                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-6" style="
    display: inline-block;
    float: inherit;">
                    <div class="portfolio2-box">
                        <div class="portfolio2-img-holder">

                            <a href="#">
                                <img class="img-responsive" src="<?php echo $catv['image']; ?>" alt="portfolio">
                            </a>
                        </div>
                        <div class="portfolio2-content-holder" style="border: 1px solid #000;
                             padding: 5px 5px 10px;">
                            <h3 style="margin-bottom: 0;font-size: 15px;"><a href="#"><?php echo $catv['title'] ?></a></h3>
                            <ul>
                                <li style="font-size: 12px;"><?php echo $catv['attr'] ?></li>
                            </ul>
                            <a href="<?php echo site_url('Movies/showTime/' . $catv['id']) ?>" style="margin-top: 10px;    background: #d92229;" class="button btn btn-danger">Book Now</a>
                        </div>
                    </div>
                </div>

                <?php
            }
            ?>

        </div>
    </div>
</div>


<div class="offer-area1 hidden-after-desk movieblockhome">

    <div class="" style="padding: 0px 50px;">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="brand-area-box-l" style="padding-top: 24px;">
                    <span>Movie Ticket Price From </span>
                    <h1>HK$ 180 Only</h1>
                    <p>Choose your Ticket Price<br/> $220 (J-O) - $200 (E-I) - $180 (C-D)</p>
                    <a href="#" class="btn-shop-now-fill">Book Now</a>
                </div>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="brand-area-box-r">
                    <a href="#"><img src="<?php echo base_url(); ?>assets/movies/movieposter1.jpg" alt="offer"></a>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo base_url(); ?>assets/theme2/angular/ng-movies.js"></script>

<?php
$this->load->view('layout/footer');
?>