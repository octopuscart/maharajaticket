<?php
$this->load->view('layout/header');
$this->load->view('layout/topmenu');
?>
<!-- ================== BEGIN PAGE CSS STYLE ================== -->
<link href="<?php echo base_url(); ?>assets/plugins/jquery-tag-it/css/jquery.tagit.css" rel="stylesheet" />
<script src="<?php echo base_url(); ?>assets/plugins/jquery-tag-it/js/tag-it.min.js"></script>

<link href="<?php echo base_url(); ?>assets/plugins/jquery-file-upload/css/jquery.fileupload.css" rel="stylesheet" />
<link href="<?php echo base_url(); ?>assets/plugins/jquery-file-upload/css/jquery.fileupload-ui.css" rel="stylesheet" />
<div class="page-wrapper">
    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Start Page Content -->
        <!-- ============================================================== -->

        <!-- begin #content -->
        <div id="content" class="content">
            <!-- begin #content -->
            <!-- begin #content -->
            <div id="content" class="content content-full-width">


                <div class="row el-element-overlay">
                    <?php
                    foreach ($eventlist as $key => $value) {
                        ?>
                        <div class="col-lg-3 col-md-6">
                            <div class="card">
                                <div class="el-card-item">
                                    <div class="el-card-avatar el-overlay-1"> <img src="<?php echo base_url(); ?>assets/movies/default.png" alt="user" style="background: url(<?php echo base_url(); ?>assets/movies/<?php echo $value["movie"]['image'];?>);background-size:cover;" />
                                        <div class="el-overlay">
                                            <ul class="list-style-none el-info">
                                                <li class="el-item"><a class="btn default btn-outline el-link" href="javascript:void(0);"><i class="sl-icon-link"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="el-card-content">
                                        <h4 class="m-b-0"><?php echo $value["movie"]['title'];?></h4> <span class="text-muted"><?php echo $value['attr'];?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    ?>

                </div>
                <!-- end #content -->
            </div>
        </div>
    </div>

    <?php
    $this->load->view('layout/footer');
    ?>
    <script>
        function changeCategory(cat_name, cat_id) {
            $("#category_name").text(cat_name);
            $("#category_id").val(cat_id);
        }

        $(function () {


            $('#tags').tagit({
                availableTags: <?php echo json_encode($tags); ?>
            });






<?php
$checklogin = $this->session->flashdata('checklogin');
if ($checklogin['show']) {
    ?>
                $.gritter.add({
                    title: "<?php echo $checklogin['title']; ?>",
                    text: "<?php echo $checklogin['text']; ?>",
                    image: '<?php echo base_url(); ?>assets/emoji/<?php echo $checklogin['icon']; ?>',
                                sticky: true,
                                time: '',
                                class_name: 'my-sticky-class '
                            });
    <?php
}
?>
                    })
    </script>