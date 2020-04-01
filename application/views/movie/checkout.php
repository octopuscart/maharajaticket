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
                <li role="presentation" class="active "><a class="" href="#purchase" aria-controls="home" role="tab" data-toggle="tab"><i class="fa fa-money"></i> Purchase</a></li>
                <li role="presentation"><a href="#reserve" aria-controls="profile" role="tab" data-toggle="tab"><i class="fa fa-bookmark"></i> Reserve</a></li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="purchase">

                    <form action="#" method="post" style="margin-top:10px;padding: 0px 50px;">
                        <h4 style="margin-bottom: 2px;">Contact Information</h4>

                        <div class="row" >
                            <div class=" col-md-3">
                                <div class="input-group">
                                    <span class="input-group-addon " id="sizing-addon2">Name</span>
                                    <input type="text" class="form-control" name='name' placeholder="Name" aria-describedby="sizing-addon2">
                                </div>
                            </div>
                            <div class=" col-md-3">
                                <div class="input-group">
                                    <span class="input-group-addon " id="sizing-addon2">Email</span>
                                    <input type="email" class="form-control" name='email' placeholder="Email" aria-describedby="sizing-addon2">
                                </div>
                            </div>    
                            <div class=" col-md-3">    
                                <div class="input-group">
                                    <span class="input-group-addon " id="sizing-addon2">Contact No.</span>
                                    <input type="tel" class="form-control" name='contact_no' placeholder="Contact No." aria-describedby="sizing-addon2">
                                </div>
                            </div>
                        </div>
                        <hr/>
                        <h4 style="margin-bottom: 2px;">Payment Option</h4>

                        <div class="row" >
                            <button class="btn btn-default paymentbutton" type="button" disabled="">
                                <img src="<?php echo base_url(); ?>assets/paymentstatus/payme.jpg" style="height: 50px;border-radius: 10px;">

                            </button>
                            <button class="btn btn-default paymentbutton" type="button" disabled="">
                                <img src="<?php echo base_url(); ?>assets/paymentstatus/wechat.jpg" style="height: 50px;border-radius: 10px;">

                            </button>
                            <button class="btn btn-default paymentbutton" type="button" disabled="">
                                <img src="<?php echo base_url(); ?>assets/paymentstatus/alipay.jpg" style="height: 50px;border-radius: 10px;">

                            </button>
                            <button class="btn btn-default paymentbutton {{selectPaymenttype.ptype == 'Cash On Delivery'?'active':''}}"  type="button" ng-click="selectPayment('Cash On Delivery')">
                                <img src="<?php echo base_url(); ?>assets/paymentstatus/cod.png" style="height: 50px;border-radius: 10px;">

                            </button>
                            <button class="btn btn-default paymentbutton {{selectPaymenttype.ptype == 'Bank Transfer'?'active':''}}" type="button" ng-click="selectPayment('Bank Transfer')">
                                <img src="<?php echo base_url(); ?>assets/paymentstatus/bank.png" style="height: 50px;border-radius: 10px;">

                            </button>

                        </div>
                        <hr/>
                        <button class='btn btn-default' style='background: #d92229;border-radius: 15px;color: white;' type='submit' name='payment'>Proceed Payment  <span aria-hidden="true">&rarr;</span></button>
                        <input type="hidden" name="paymenttype" value="{{selectPaymenttype.ptype}}">
                    </form>
                </div>
                <div role="tabpanel" class="tab-pane" id="reserve">
                    <form action="#" method="post" style="margin-top:10px;padding: 0px 50px;">
                        <h4 style="margin-bottom: 2px;">Contact Information</h4>
                        <div class="row" >
                            <div class=" col-md-3">
                                <div class="input-group">
                                    <span class="input-group-addon " id="sizing-addon2">Name</span>
                                    <input type="text" class="form-control" name='name' placeholder="Name" aria-describedby="sizing-addon2">
                                </div>
                            </div>
                            <div class=" col-md-3">
                                <div class="input-group">
                                    <span class="input-group-addon " id="sizing-addon2">Email</span>
                                    <input type="email" class="form-control" name='email' placeholder="Email" aria-describedby="sizing-addon2">
                                </div>
                            </div>    
                            <div class=" col-md-3">    
                                <div class="input-group">
                                    <span class="input-group-addon " id="sizing-addon2">Contact No.</span>
                                    <input type="tel" class="form-control" name='contact_no' placeholder="Contact No." aria-describedby="sizing-addon2">
                                </div>
                            </div>
                        </div>
                        <hr/>
                        <button class='btn btn-default' style='background: #d92229;border-radius: 15px;color: white;' type='submit' name='reserve'>Reserve Now  <span aria-hidden="true">&rarr;</span></button>
                    </form>
                </div>
            </div>

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
                    <a href="<?php echo site_url('Movies/checkOut');?>" class="btn btn-default">Close</a>
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
                            $(function(){
                            $("#bookingModal").modal({
                            "backdrop":false,
                                    "show":true
                            })
                            })

    </script>
    <?php
}
?>

<?php
$this->load->view('layout/footer');
?>