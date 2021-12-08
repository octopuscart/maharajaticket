<!-- Footer Area Start Here -->
<div style="clear: both"></div>
<?php
$this->db->select("seo_keywords");
$queryconf = $this->db->get('configuration_site');
$seokeywords = $queryconf->row();
$keywordschat = $seokeywords->seo_keywords;
?>
<div class="container" style='text-align: center;'>
    <hr/>

    <table class="footertable" style='    display: inline'>



        <tr>
            <th style="width: 25%;text-align: center;" colspan="2">
                PAYMENT OPTIONS:
            </th>

        </tr>
        <tr>

            <td class="text-right" >
                <img src="<?php echo base_url(); ?>assets/paymentstatus/payme.jpg" style="height: 100px;">
            </td>
            <td class="text-left">
                <img src="<?php echo base_url(); ?>assets/paymentstatus/fps.png" style="height: 100px;">
            </td>
        </tr>
        <tr>

            <td class="text-center" colspan="2">
                <p>For other payment option connect us on WhatsApp: <span style='font-weight: 600;
                                                                          color: #0fc105;'>+(852)  6142 8189</span></p>

            </td>
        </tr>
        <tr>

            <td class="text-center" colspan="2">
                <p>
                    Join our official  #Telegram channel to get the latest updates<br/><br/>
                    <a href="https://t.me/cineworld_maharajamart" target="_blank" class="btn btn-primary"><i class="fa fa-paper-plane"></i>  Join Our Telegram channel</a>
                </p>

            </td>
        </tr>
    </table>


</div>

<footer>

    <div class="footer-area" style="background: #d92229">
        <div class="footer-area-top">
            <div class="container">
                <div class="row">

                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="footer-box">
                            <h3>Stay With Us!</h3>
                            <p>Connect with us via social media.</p>
                            <ul class="footer-social">
                                <li><a href=""><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                <li><a href=""><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                <li><a href=""><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                                <li><a href=""><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
                                <li><a href=""><i class="fa fa-youtube" aria-hidden="true"></i></a></li>
                            </ul>

                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        
                        <div class="footer-box">
                            <div class="newsletter-area">
                                <h3>NewsLetter Sign Up!</h3>
                                <div class="input-group stylish-input-group">
                                    <input type="text" class="form-control" placeholder="E-mail . . .">
                                    <span class="input-group-addon">
                                        <button type="submit">
                                            <i class="fa fa-chevron-right" aria-hidden="true"></i>
                                        </button>  
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div style="clear: both"></div>
        <div class="container">
            <div class="col-md-12 row " style="text-align: center;">
                <hr/>

                <span class="keywordfooter"><?php echo $keywordschat; ?> </span>

                <hr/>
            </div>
        </div>
        <div style="clear: both"></div>

        <div class="footer-area-bottom" style="background: #ffeb3b">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                        <p>Copyright © <?php echo date('Y') ?> by  Maharaja Tickets. All rights reserved.  </p>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


</footer>

<!-- Footer Area End Here -->

</div>









<!-- Bootstrap js -->
<script src="<?php echo base_url(); ?>assets/theme2/js/bootstrap.min.js" type="text/javascript"></script>
<!-- Owl Cauosel JS -->
<script src="<?php echo base_url(); ?>assets/theme2/js/owl.carousel.min.js" type="text/javascript"></script>
<!-- Nivo slider js -->
<script src="<?php echo base_url(); ?>assets/theme2/lib/custom-slider/js/jquery.nivo.slider.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/theme2/lib/custom-slider/home.js" type="text/javascript"></script>
<!-- Meanmenu Js -->
<script src="<?php echo base_url(); ?>assets/theme2/js/jquery.meanmenu.min.js" type="text/javascript"></script>
<!-- WOW JS -->
<script src="<?php echo base_url(); ?>assets/theme2/js/wow.min.js" type="text/javascript"></script>
<!-- Plugins js -->
<script src="<?php echo base_url(); ?>assets/theme2/js/plugins.js" type="text/javascript"></script>
<!-- Countdown js -->
<script src="<?php echo base_url(); ?>assets/theme2/js/jquery.countdown.min.js" type="text/javascript"></script>
<!-- Srollup js -->
<script src="<?php echo base_url(); ?>assets/theme2/js/jquery.scrollUp.min.js" type="text/javascript"></script>
<!-- Isotope js -->
<script src="<?php echo base_url(); ?>assets/theme2/js/isotope.pkgd.min.js" type="text/javascript"></script>
<!-- Select2 Js -->
<script src="<?php echo base_url(); ?>assets/theme2/js/select2.min.js" type="text/javascript"></script>
<!-- Custom Js -->

<!--wnum-->
<script src="<?php echo base_url(); ?>assets/theme2/js/wNumb.js" type="text/javascript"></script>

<!--no slider-->
<script src="<?php echo base_url(); ?>assets/theme2/js/vendor/nouislider.min.js" type="text/javascript"></script>


<script src="<?php echo base_url(); ?>assets/theme2/js/main.js" type="text/javascript"></script>

<!-- type ahead-->
<script src="<?php echo base_url(); ?>assets/handlebars.js" type="text/javascript"></script>

<!-- type ahead-->
<script src="<?php echo base_url(); ?>assets/typeahead.bundle.js" type="text/javascript"></script>


<!--angular controllers-->
<script src="<?php echo base_url(); ?>assets/theme2/angular/shopController.js"></script>




<script>
    $(window).on('load', function () {
        // Page Preloader




    });

    $('nav#dropdown').meanmenu({siteLogo: "<a href='/' class='logo-mobile-menu'><img src='<?php echo base_url() . 'assets/images/logo73.png'; ?>' style='    height: 35px;' /></a>"});
</script>


</body>

</html>