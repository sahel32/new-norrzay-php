
<link href="<?php echo asset_url('js/bootstrap-datepicker/css/bootstrap.min.css'); ?>" rel="stylesheet" type="text/css" >
<link href="<?php echo asset_url('js/bootstrap-datepicker/bootstrap-datepicker.min.css'); ?>" rel="stylesheet" type="text/css" >

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<script src="<?php echo asset_url('js/bootstrap-datepicker/bootstrap-datepicker.min.js'); ?>"></script>
<script src="<?php echo asset_url('js/bootstrap-datepicker/bootstrap-datepicker.fa.min.js'); ?>"></script>

<script type="text/javascript">
    $(function(){
        $("#datepicker").datepicker({
            dateFormat: "yy/mm/dd",
            showOtherMonths: true,
            selectOtherMonths: true
        });
        $("#datepicker1").datepicker({
            dateFormat: "yy/mm/dd"
        });
    });
</script>
<?php $this->load->view('balance/ajax_account_report'); ?>
<div id="page-inner">
    <div class="row">
        <div class="col-md-12">
            <h2>گرفتن یک کلی </h2>
            <h5>در این قسمت شما میتوانید تمام اطلاعات مربوط به خریدار و فروشنده مورد نظر را مشاهده کنید.</h5>
        </div>
    </div>
    <!-- /. ROW  -->
    <hr/>
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
                            <form action="<?php echo site_url('balance/oil_report'); ?>" method="post">
                                <div class="col-md-3 form-group">
                                    <lable>از این تاریخ</lable>
                                    <input type="text" id="datepicker" name="firstdate" class="form-control">
                                </div>
                                <div class="col-md-3 form-group">
                                    <lable>الی تاریخ</lable>
                                    <input type="text" id="datepicker1" name="seconddate" class="form-control">
                                </div>
                                <div class="col-md-3 form-group">
                                    <label>گزراش از :</label>
                                    <select class="form-control" name="type" >

                                        <option value="prebuy">تیل های پیش خرید</option>
                                        <option value="presell">تیل های پیش فروش</option>
                                        <option value="sell">تیل های فروخته شده</option>
                                        <option value="buy">تیل های خریداری شده</option>
                                       
                                    </select>
                                </div>
                                <div class="col-md-4 gaps">
                                    <!--<button type="button" class="btn btn-default pull-left" id="get_total_balance"
                                            data-toggle="modal" data-target="#view-modal">جستجو
                                    </button>-->
                                    <button type="submit"  class="btn btn-default pull-left">جستجو</button>
                                    <button type="submit" name="print" class="btn btn-default pull-left">جستجو پرنت</button>

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


