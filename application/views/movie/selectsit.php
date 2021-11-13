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

        background-position: center;
        padding: 0px;
    }


    .wheelchairseat{
        background-image: url(<?php echo base_url(); ?>assets/movies/wheelchair.png)!important;
        background-size: 20px;
        background-repeat: no-repeat;
        background-position: center;
        background-color:white;
        border-radius:5px;
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
                    <ul>
                        <li><a href="#"><?php echo $movie['title']; ?></a> - </li>
                        <li><a href="#"><?php echo $theater['title']; ?></a> - </li>
                        <li><?php echo $sdate; ?></li>
                        <li><?php echo $stime; ?></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Inner Page Banner Area End Here -->
<!-- Contact Us Page Area Start Here -->
<!-- Single Blog Page Area Start Here -->


<div class="portfolio2-page-area1" style="padding: 30px" ng-controller="sitSelectContoller">
    <div class="container-fluid">

        <div class="row">
            <form action='#' method="post">
                <div class="col-sm-10">
                    <div class="theaterblock" style="overflow-x: scroll;width: max-content;">
                        <table class=" table" >
                            <tbody>
                                <tr>
                                    <td colspan="{{theaterLayout.layout.totalinrow}}">
                                        <div class='theaterscreen'>SCREEN HERE</div>
                                    </td>
                                </tr>
                            </tbody>  
                            <tbody ng-repeat="(kclass, sclass) in theaterLayout.layout.sitclass">
                                <tr><td class="theaterblockblank" colspan="{{theaterLayout.layout.totalinrow}}"></td></tr>
                                <tr style="background: {{sclass.color}}"><td class="theaterblockblank" colspan="{{theaterLayout.layout.totalinrow}}">{{sclass.price|currency}}</td></tr>

                                <tr ng-repeat="(rt, rows) in sclass.row" style="background: {{sclass.color}}">
                                    <td>{{rt}}</td>
                                    <td class="theaterblockseat {{sit?'sitable':''}}" ng-repeat="(sit, chkatr) in rows">
                                        <div  ng-if="sit" ng-switch="chkatr">
                                            <div ng-switch-when="A">
                                                <button id="{{sit}}"  type="button" class="btn btn-link btn-sm seaticon {{sit == seatSelection.selected[sit].seat?'active':''}}" ng-click="selectSeat(sit, sclass.price)" ng-mouseenter="selectSeatSuggest(sit, kclass)" ng-mouseleave="selectRemoveClass(sit, kclass)"  title='{{sit}} ({{sclass.price|currency}}) {{chkatr}}'>
                                                    <h5 class="theaterblocktext">{{sit}}</h5>
                                                </button>
                                            </div>
                                            <div ng-switch-when="B">
                                                <button class="btn btn-link btn-sm seaticon seatbooked" type="button"  disabled="" title='{{sit}} ({{sclass.price|currency}})'>
                                                    <h5 class="theaterblocktext">{{sit}}</h5>
                                                </button>
                                            </div>
                                            <div ng-switch-when="R">
                                                <button class="btn btn-link btn-sm seaticon seatresurved" type="button" disabled=""  title='{{sit}} ({{sclass.price|currency}})'>
                                                    <h5 class="theaterblocktext">{{sit}}</h5>
                                                </button>
                                            </div>
                                        </div>
                                    </td>

                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
                <div class="col-sm-2" style='padding: 0px;'>

                    <div class='theaterpricetable pricescroll'>
                        <table class="theaterpricetable table">
                            <tr>
                                <th>Seat No.</th>
                                <th style='width:60%'>Price</th>
                            </tr>
                            <tr ng-repeat="(sps, spp) in seatSelection.selected">
                                <td class="seattext">{{sps}}</td>
                                <th>
                                    <input type='hidden' name='ticket[]' value='{{sps}}'/>
                                    <input type='hidden' name='price[]' value='{{spp.price}}'/>
                                    {{spp.price|currency}}
                                </th>
                            </tr>              
                        </table>
                    </div>
                    <table class="theaterpricetable table">

                        <tr class='pricetotal'>
                            <td>Total</td>
                            <th style='width:60%;'>{{seatSelection.total|currency}}</th>
                        </tr>
                    </table>

                </div>
                <div style="clear: both"></div>

                <nav aria-label="...">
                    <ul class="pager">
                        <li class="previous pull-left"><a href="<?php echo site_url('Movies/showTime/' . $movie['id']); ?>" style="    background: #d92229;
                                                          color: white;"><span aria-hidden="true">&larr;</span> Select Time/Date</a></li>
                        <li class="next pull-right">


                            <button class='btn btn-default' ng-if="seatSelection.total > 0" style='background: #d92229;    border-radius: 15px;
                                    color: white;' type='submit' name='proceed'>Proceed Checkout/Reserve  <span aria-hidden="true">&rarr;</span></button>

                            <button class='btn btn-default' ng-if="seatSelection.total == 0" disabled="" style='background: #d92229;    border-radius: 15px;
                                    color: white;' type='submit' name='proceed'>Proceed Checkout/Reserve  <span aria-hidden="true">&rarr;</span></button>

                        </li>
                    </ul>

                    </div>
            </form>
        </div>


    </div>
</div>

<script>
    var layoutgbl = '<?php echo $theater['layout']; ?>';
    var seatsgbl = '<?php echo $total_seats; ?>';
    var select_date_gbl = "<?php echo $sdate; ?>";
    var select_time_gbl = "<?php echo $stime; ?>";
    var movie_id_gbl = "<?php echo $movie['id']; ?>";
    var theater_id_gbl = "<?php echo $theater_id; ?>";
    var template_id = "<?php echo $theater_template_id; ?>"

</script>
<script src="<?php echo base_url(); ?>assets/theme2/angular/ng-movies.js"></script>

<?php
$this->load->view('layout/footer');
?>