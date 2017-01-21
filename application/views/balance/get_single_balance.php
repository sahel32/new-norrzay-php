
<?php $this->load->view('balance/ajax_get_single_balance'); ?>
<div id="page-inner">
    <div class="row">
        <div class="col-md-12">
            <h2>گرفتن یک نفر</h2>
            <h5>در این قسمت شما میتوانید تمام اطلاعات مربوط به خریدار و فروشنده مورد نظر را مشاهده کنید.</h5>
        </div>
    </div>
    <!-- /. ROW  -->
    <hr />
    <div class="row">
        <div class="col-md-12">
            <!-- Form Elements -->
            <div class="panel panel-default">


                <div class="panel-heading">
                    بالانس گیری جید یا نمایش اخرین بالانس
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form action="<?php echo site_url('balance/get_single_balance_result');?>" method="post">
                                <div class="col-md-3 form-group">
                                    <lable>از این تاریخ</lable>
                                    <input type="text" id="datepicker" name="datepicker" class="form-control">
                                </div>
                                <div class="col-md-3 form-group">
                                    <lable>الی این تاریخ</lable>
                                    <input type="text" id="datepicker1"  name="datepicker1" class="form-control">


                                </div>

                                <div class="col-md-2 form-group">

                                    <label>اسم و تخلص</label><br>
                                    <?php
                                    foreach ($account_rows as $key => $value) {
                                        echo $value->name." ".$value->lname;
                                        ?>
                                        <input type="hidden" id="account_id"  value="<?php echo $value->id; ?>" id="account_id" name="account_id" class="form-control">

                                        <?php
                                    }  ?>

                                </div>
                                <div class="col-md-4 gaps">
                                    <button type="button" class="btn btn-default pull-left" id="get_singel_balance" data-toggle="modal" data-target="#view-modal" >جستجو</button>
                                    <button type="submit" class="btn btn-default pull-left"  >جستجو پرنت</button>

                                    <button type="reset" class="btn btn-primary pull-left">تنظیم مجدد</button>
                                </div>
</form>
                        </div>
                    </div>
                    <hr>

                </div>
            </div>

        </div>
    </div>
</div>
<link href="<?php echo asset_url('js/bootstrap-datepicker/bootstrap-datepicker.min.css'); ?>" rel="stylesheet" type="text/css" >
<script src="<?php echo asset_url('js/bootstrap-datepicker/bootstrap.min.js'); ?>" ></link>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<script src="<?php echo asset_url('js/bootstrap-datepicker/bootstrap-datepicker.min.js'); ?>"></script>
<script src="<?php echo asset_url('js/bootstrap-datepicker/bootstrap-datepicker.fa.min.js'); ?>"></script>
<script>
    $(document).ready(function() {
        $("#datepicker").datepicker({
            dateFormat: "yy/mm/dd"
        });
        $("#datepicker1").datepicker({
            dateFormat: "yy/mm/dd"
        });

    });
</script>

