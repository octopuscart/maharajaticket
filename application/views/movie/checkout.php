<?php
$this->load->view('layout/header');
?>
<style>


    .seaticon{
        background-image: url(<?php echo base_url(); ?>assets/movies/seat.png)!important;
        height: 20px;
        width: 26px!important;
        background-size: 30px;
        background-repeat: no-repeat;
        background-color: white;
        border: 1px solid #fff;
        background-position: center;
        padding: 0px;
    }


    .theaterblockseat.sitable{

    }

    .theaterblock tbody{
        margin: 5px;
    }

    .theaterblockblank{
        height: 50px;
    }
    .theaterblockprice{

        transform: rotate(90deg);
    }

    .paymentbutton.active{
        background: #d92229;
    }

    .modal{
        background: #0000003d;
    }
    .centerblockinput{
        float:inherit;
        display:inline-block;
    }

</style>

<!-- Inner Page Banner Area Start Here -->
<div class="inner-page-banner-area" style="   ">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="breadcrumb-area">
                    <h1>Checkout</h1>
                    <ul>
                        <li><a href="#"><?php echo $movie['title']; ?></a></li>

                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Inner Page Banner Area End Here -->
<!-- Contact Us Page Area Start Here -->
<!-- Single Blog Page Area Start Here -->


<div class="portfolio2-page-area1" style="padding: 30px" ng-controller="checkoutContoller">
    <div class="container">
        <div class="list-group" style="text-align: center">

            <div href="#" class="list-group-item ">
                <h4 class="list-group-item-heading">Screen: <?php echo $theater['title']; ?></h4>
                <p class="list-group-item-text"><?php echo $sdate; ?>, <?php echo $stime; ?></p>
            </div>
            <div href="#" class="list-group-item ">

                <h4 class="list-group-item-heading">Price: {{<?php echo $total; ?>|currency}}</h4>
                <p class="list-group-item-text" style="font-size: 12px;"><?php
                    foreach ($ticketlist as $key => $value) {
                        echo $key . '({{' . $value . '|currency}}), ';
                    }
                    ?></p>
            </div>
        </div>
        <div class="row">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs checkoutheader" role="tablist" style="text-align: center">
                <li role="presentation" class="active "><a href="#reserve" aria-controls="profile" role="tab" data-toggle="tab"><i class="fa fa-bookmark"></i> Reserve</a></li>
            </ul>


            <form action="#" id="bookingform" method="post" style="margin-top:10px;padding: 0px 50px;">
                <h4 style="" class=" text-center">Contact Information</h4>
                <div class="row text-center" >
                    <div class=" col-md-3 centerblockinput">
                        <div class="input-group ">
                            <span class="input-group-addon " id="sizing-addon2">Name</span>
                            <input type="text" class="form-control" name='name' placeholder="Name" aria-describedby="sizing-addon2" required="">
                        </div>
                    </div>
                    <div class=" col-md-3 centerblockinput">
                        <div class="input-group">
                            <span class="input-group-addon " id="sizing-addon2">Email</span>
                            <input type="email" class="form-control" name='email' placeholder="Enter Valid Email" aria-describedby="sizing-addon2" required="">
                        </div>
                    </div>    
                    <div class=" col-md-3 centerblockinput">    
                        <div class="input-group">
                            <span class="input-group-addon " id="sizing-addon2">Contact No.</span>
                            <input type="tel" class="form-control" name='contact_no' placeholder="WhatsApp Number" aria-describedby="sizing-addon2" required="">
                        </div>
                    </div>
                </div>
                <hr/>
                <div class="col-md-12  text-center">
                    <lable>
                        <input type='checkbox' name='agreecheck' required="" />&nbsp; I agree that tickets reserved cannot be cancelled. 
                    </lable>
                    <br/>

                    <br/>
                    <button class='btn btn-default' id="bookingbutton" style='background: #d92229;border-radius: 15px;color: white;margin-right: 30px;' type='submit' name='reserve'>Reserve Now  </button>
                </div>
                <hr/>
                <div class="col-md-12 margin-20   text-center" style="margin-top: 20px;">
                    <h4>                       

                        For Further Help: <a href="https://api.whatsapp.com/send?phone=85261428189&text=" target="_blank"> <img src="<?php echo base_url(); ?>assets/images/whatsapp.svg"/> +(852) 6142 8189</a> 
                    </h4>
                </div>
            </form>


        </div>
    </div>
</div>



<div class="modal fade" id="bookingModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Do You Want Book Again?</h4>
            </div>
            <div class="modal-body">
                You have already booked this movie at selected time and location with same email id.
                Do you want book this again?
            </div>
            <div class="modal-footer">
                <form action="<?php echo site_url('Movies/bookAgain') ?>">
                    <input type="hidden" name="booking_id" value="<?php echo $_GET['book_id']; ?>">
                    <input type="hidden" name="payment_type" value="<?php echo $_GET['paymenttype']; ?>">
                    <input type="hidden" name="booking_type" value="<?php echo $_GET['booking_type']; ?>">
                    <button type="submit" class="btn btn-danger">Yes Book Now</button>
                    <a href="<?php echo site_url('Movies/checkOut'); ?>" class="btn btn-default">Close</a>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo base_url(); ?>assets/theme2/angular/ng-movies.js"></script>

<?php
if ($checkpre == 'exist') {
    ?>
    <script>
    $(function () {
    $("#bookingModal").modal({
    "backdrop": false,
            "show": true
    })
    });
    </script>
    <?php
}
?>

<script>
    $(document).on('submit', "#bookingform", function () {
    $("#bookingbutton").hide();
    });
</script>

<?php
$this->load->view('layout/footer');
?>