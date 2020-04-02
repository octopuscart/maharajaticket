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

</style>

<!-- Inner Page Banner Area Start Here -->
<div class="inner-page-banner-area" style="   ">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="breadcrumb-area">
                    <h1>Your Booking</h1>
                    <ul>
                        <li><a href="#">Booking No: #<?php echo $booking['booking_no']; ?></a></li>

                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Inner Page Banner Area End Here -->
<!-- Contact Us Page Area Start Here -->
<!-- Single Blog Page Area Start Here -->


<div class="portfolio2-page-area1" style="padding: 30px" ng-controller="ticketPaymentController">
    <div class="container">


        <div class="list-group" style="text-align: center">
            <div href="#" class="list-group-item ">
                <h4 class="list-group-item-heading"><i class="fa fa-user"></i> <?php echo $booking['name']; ?></h4>
                <p class="list-group-item-text">Email: <?php echo $booking['email']; ?>, Contact No.: <?php echo $booking['contact_no']; ?></p>
            </div>
            <div href="#" class="list-group-item ">

                <h4 class="list-group-item-heading"><i class="fa fa-film"></i> <?php echo $movieobj['title']; ?> | <?php echo $movieobj['attr']; ?></h4>
                <p class="list-group-item-text"><?php echo $theater['title']; ?></p><br/>
                <p class="list-group-item-text"><i class="fa fa-calendar"></i> <?php echo $booking['select_date']; ?>,&nbsp; <i class="fa fa-clock-o"></i><?php echo $booking['select_time']; ?></p>
            </div>
            <div href="#" class="list-group-item ">
                <h4 class="list-group-item-heading">Price: {{<?php echo $booking['total_price']; ?>|currency:'HK$ '}}</h4>
                <p class="list-group-item-text" style="font-size: 12px;"><?php
                    foreach ($seats as $key => $sobj) {
                        echo $sobj['seat'] . '({{' . $sobj['seat_price'] . '|currency}}), ';
                    }
                    ?></p>
            </div>

        </div>






        <div class="" style="padding:0px 50px;text-align: center">

            <form action="#" method="post" style="margin-top:10px;padding: 0px 50px;">
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
                <button class='btn btn-default' style='background: #d92229;border-radius: 15px;color: white;' type='submit' name='payment'>Proceed For Payment</button>
                <input type="hidden" name="paymenttype" value="{{selectPaymenttype.ptype}}">
            </form>




        </div>
    </div>
</div>
<script src="<?php echo base_url(); ?>assets/theme2/angular/ng-movies.js"></script>

<?php
$this->load->view('layout/footer');
?>
  