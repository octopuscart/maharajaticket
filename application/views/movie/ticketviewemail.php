<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Order No#</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <style>
            .carttable{
                border-color: #fff;
            }

            .carttable td{
                padding: 5px 10px;
                border-color: #9E9E9E;
            }
            .carttable tr{
                /*padding: 0 10px;*/
                border-color: #9E9E9E;
                font-size: 12px;
                text-align: left;
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
                float: left;
                font-size: 12px;
                border: 1px solid #fff;
                border-radius: 5px;
                background: #fff;
                color: #000;
                margin-right: 10px;
                margin-top: 10px;
                padding: 0px 5px;
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

            .ticketmainblock p, .ticketmainblock h3{
                margin:0;
                margin-bottom: 5px;
            }
            .totalprice td{
                border-bottom: 1px solid #e1e1e1;
            }
            .ticketsmallview{
                padding: 5px 10px;
                margin: 5px;
            }
        </style>
    </head>

    <body style="margin: 0;
          padding: 0;
          background: rgb(225, 225, 225);
          font-family: sans-serif;">
        <div class="" style="padding:50px 0px;text-align: center">
            <table align="center" border="0" cellpadding="0" cellspacing="0" width="700" style="background: #FFEB3B;padding: 0 20px">
                <tr>
                    <td >
                        <center><img src="<?php echo base_url(); ?>assets/images/logo.png" style="margin: 10px;
                                     height: 50px;
                                     width: auto;"/><br/>
                            <h4 style=""><small> Your Movie Tickets for</small> <br/> <?php echo $movieobj['title'] . ' | ' . $movieobj['attr']; ?></h4>
                        </center>
                    </td>

                </tr>

            </table>

            <table class="carttable"  border-color= "#fff" align="center" border="0" cellpadding="0" cellspacing="0" width="700" style="background: #fff;padding:20px">
                <tr>
                    <td style='width: 70%;'>
                        <p>Hi <?php echo $booking['name']; ?>,</p>
                        <p>Your Ticket(s) Has Been <?php echo $booking['booking_type'] == 'Reserve' ? 'Reserved' : 'Confirmed'; ?></p>
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
                            <td style='width: 30%'></td>
                            <td style='width: 40%'></td>
                            <td style='width: 30%;    text-align: center;
                                background: white;
                                border-radius: 12px;' rowspan="3">
                                <img src="<?php echo site_url('Movies/getMovieQR/' . $booking['booking_id']); ?>"><br/>

                            </td>

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
                            <td></td>
                        </tr>
                        <tr>
                            <td style="font-size: 12px;
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
                            <td></td>
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
                        <th style='width: 60%;text-align: right;    border-bottom: 1px solid #000;'>Status:</th><th style='text-align: right;    border-bottom: 1px solid #000;'> <?php echo $booking['booking_type'] == 'Reserve' ? 'Unpaid' : 'Pending'; ?></th>
                    </tr>

                    <?php
                    if ($booking['booking_type'] == 'Reserve') {
                        ?>
                        <tr>
                            <td  colspan="2" style="text-align: center;">

                                <img src="<?php echo base_url(); ?>assets/paymentstatus/payment.jpg" style="height: 75px;">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <p>Click here to make the payment. <a href='<?php echo site_url('Movies/payticket/' . $booking['booking_id']) ?>'>Proceed Payment</a></p>
                            </td>
                        </tr>
                        <tr style='height: 50px;'>
                            <td colspan="2">
                                <p>For other payment option connect us on WhatsApp: <span style='font-weight: 600;
                                                                                          color: #0fc105;
                                                                                          font-size: 14px;'>+(852)  6142 8189</span></p>
                            </td>
                        </tr>
                        <?php
                    } else {
                        ?>

                        <tr style='font-size: 15px;height: 50px;'>
                            <th style='width: 60%;text-align: right;    border-bottom: 1px solid #000;'>Payment Mode:</th><th style='text-align: right;    border-bottom: 1px solid #000;'> <?php echo $booking['payment_type']; ?></th>
                        </tr>
                        <?php
                    }
                    ?>


                </table>



            </div>


            <table class="carttable"  border-color= "#fff" align="center" border="0" cellpadding="0" cellspacing="0" width="700" style="background: #FFEB3B;padding: 0 20px">
                <tr>
                    <td colspan="2" style='font-size: 11px;'>
                        <p><b>Important Notes:</b></p>
                        <p>Please collect your ticket from Box office.</p>
                        <p>Tickets once booked cannot be exchanged, cancelled or refunded.</p>
                        <p>Unpaid reserved Tickets automatic cancelled within 24 hours.</p>
                    </td>

                </tr>
                <tr style='font-size: 15px;height: 5px;'>
                </tr>

            </table>

        </div>
    </body>
</html>