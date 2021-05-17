<?php
$this->load->view('layout/header');

$bktype = $booking['booking_type'];
$statusarray = array(
    "Purchase" => array("status" => "Confirmed", "payment" => "Awaiting Payment Confirmation"),
    "Reserve" => array("status" => "Reserved", "payment" => "Unpaid"),
    "Cancel" => array("status" => "Cancelled", "payment" => "Cancelled"),
);
$bookingtype = $statusarray[$bktype]["status"];
$paymenttype = $statusarray[$bktype]["payment"];
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


<div class="portfolio2-page-area1" style="padding: 30px" ng-controller="checkoutContoller">
    <div class="container">
        <style>
            .carttable{
                border-color: #fff;
            }

            .carttable td{
                padding: 5px 10px;
                border-color: #9E9E9E;
                text-align: left;
            }
            .carttable tr{
                /*padding: 0 10px;*/
                border-color: #9E9E9E;

            }

            .detailstable td{
                padding:10px 20px;
            }

            .gn_table td{
                padding:3px 0px;
            }
            .gn_table th{
                padding:3px 0px;
                text-align: left;

            }
            .style_block{
                float: left;
                padding: 1px 1px;
                margin: 2.5px;
                /* background: #000; */
                color: white;
                border: 1px solid #e4e4e4;
                width: 47%;
                font-size: 10px;
            }

            .style_block span {
                background: #fff;
                margin-left: 5px;
                color: #000;
                padding: 0px 5px;
                width: 50%;
            }
            .style_block b {
                width: 46%;
                float: left;
                background: #dedede;
                color: black;
            }
            .ticketview{
                text-align: center;
                /* float: left; */
                font-size: 12px;
                border: 1px solid #685d5d;
                border-radius: 5px;
                background: #fff;
                color: #000;
                margin-right: 10px;
                margin-top: 10px;
                padding: 0px 5px;
                display: inline-block;
            }

            .ticketview img{
                height: 23px;
            }
            .ticketblock{

            }

            .ticketmainblock{
                text-align: center;
                /* border: 3px solid #000; */
                width: 700px;
                display: inline-block;
                background: #fff;
                padding: 13px 0px;
            }
            .ticketmainblock table{
                border: 1px solid #000;
                background: #fff;
                border-radius: 15px;
                border-style: dashed;

            }
            .ticketmainblock tr{

            }

            .ticketmainblock p{
                margin:0;
                margin-bottom: 5px;

            }
            .ticketmainblock h3{
                margin:0;
                margin-bottom: 5px;
                font-size: 14px;
            }
            .totalprice td{
                border-bottom: 1px solid #e1e1e1;
            }
            .ticketsmallview{
                padding: 5px 10px;
                margin: 5px;
            }
        </style>



        <div class="" style="padding:50px 0px;text-align: center">


            <table class="carttable"  border-color= "#fff" align="center" border="0" cellpadding="0" cellspacing="0" width="700" style="background: #fff;padding:20px">
                <tr>
                    <td style='width: 70%;'>
                        <p>Hi <?php echo $booking['name']; ?>,</p>
                        <p>Your Ticket(s) Has Been <?php echo $bookingtype; ?></p>
                    </td>
                    <td>
                        <b>Booking No.:</b><br/>
                        <p><?php echo $booking['booking_no']; ?></p>
                    </td>
                </tr>
            </table>
            <div class='ticketmainblock'>
                <table class="carttable"  border-color= "#fff" align="center" border="0" cellpadding="0" cellspacing="0" style="padding:10px;width:650px;">
                    <tbody>
                        <tr>
                            <td style='width: 40%'></td>
                            <td style='width: 60%'></td>


                        </tr>
                        <tr>
                            <td>
                                <p>Movie</p>
                                <h3><?php echo $movieobj['title']; ?></h3>
                                <?php echo $movieobj['attr']; ?>
                            </td>
                            <td>
                                <p>Location/Date & Time</p>
                                <h3><?php echo $theater['title']; ?></h3>
                                <p><?php echo $booking['select_date']; ?>, <?php echo $booking['select_time']; ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: center;
                                border-top: 1px solid #d9a30e;
                                padding-top: 9px;" colspan="2">
                                <p>Seat(s)</p>
                                <div class='ticketblock' >
                                    <?php
                                    foreach ($seats as $skey => $sobj) {
                                        ?>
                                        <div class='ticketview' >
                                            <img src='<?php echo base_url(); ?>assets/movies/seat.png' /><br/>
                                            <?php echo $sobj['seat']; ?>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div> 
                            </td>
                        </tr>
                    </tbody>

                </table>
            </div>
            <div class='ticketmainblock' >
                <table class="carttable totalprice"  border-color= "#fff" align="center" border="0" cellpadding="0" cellspacing="0" width="700" style="background: #fff;padding:20px;border:none">
                    <tr>
                        <th colspan="2"><h2 style='font-size: 15px;'>Payment Summary</h2> </th>
                    </tr>
                    <tr style='    background: #e1e1e1;
                        padding: 12px;
                        height: 30px;'>
                        <th style='width: 60%;text-align: left;padding: 0px 5px;'>Description</th><th style='text-align: right;padding: 0px 5px;'>Price</th>
                    </tr>


                    <tr style='' class=''>
                        <td style="font-size: 12px;text-align: left">
                            <b>Seat(s)</b>
                            <div class='ticketblock' >
                                <?php
                                foreach ($seats as $skey => $sobj) {
                                    ?>
                                    <div class='ticketview'><?php echo $sobj['seat']; ?> <span>($HK<?php echo $sobj['seat_price']; ?>)</span> </div>
                                    <?php
                                }
                                ?>
                            </div>
                        </td>
                        <td style="font-size: 15px;text-align: right">
                            $HK<?php echo $booking['total_price']; ?>
                        </td>
                    </tr>
                    <tr style='font-size: 18px;height: 50px;'>
                        <th style='width: 60%;text-align: right;    border-bottom: 1px solid #000;'>Total:</th><th style='text-align: right;    border-bottom: 1px solid #000;'> $HK<?php echo $booking['total_price']; ?>.00</th>
                    </tr>
                    <tr style='font-size: 15px;height: 50px;'>
                        <th style='width: 60%;text-align: right;    border-bottom: 1px solid #000;'>Status:</th><th style='text-align: right;    border-bottom: 1px solid #000;'> <?php echo $paymenttype; ?></th>
                    </tr>

                    <?php
                    if ($booking['booking_type'] == 'Reserve') {
                        ?>

                        <tr>
                            <td colspan="2">
                                <p>Click here to make the payment. <a href='<?php echo site_url('Movies/ticketPayment/' . $booking['booking_id']) ?>'>Proceed Payment</a></p>
                            </td>
                        </tr>

                        <?php
                    } else {
                        
                    }
                    ?>


                </table>



            </div>




        </div>
    </div>
</div>
<?php
$this->load->view('layout/footer');
?>
  