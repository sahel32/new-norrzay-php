<?php $this->load->view('balance/ajax_get_total_balance'); ?>
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
                            <form action="<?php echo site_url('balance/get_total_balance_result'); ?>" method="post">
                                <!-- <div class="col-md-3 form-group">
                                     <lable>از این تاریخ</lable>
                                     <input type="text" id="datepicker" name="datepicker" class="form-control">
                                 </div>-->
                                <div class="col-md-4 gaps">
                                    <button type="button" class="btn btn-default pull-left" id="get_total_balance"
                                            data-toggle="modal" data-target="#view-modal">جستجو
                                    </button>
                                    <button type="submit" class="btn btn-default pull-left">جستجو پرنت</button>

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


