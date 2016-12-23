<link type="text/css" href="<?php echo asset_url('js/datepicker/styles/jquery-ui-1.8.14.css'); ?>" rel="stylesheet" />
<script type="text/javascript" src="<?php echo asset_url('js/datepicker/scripts/jquery-1.6.2.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo asset_url('js/datepicker/scripts/jquery.ui.core.js'); ?>"></script>
<script type="text/javascript" src="<?php echo asset_url('js/datepicker/scripts/jquery.ui.datepicker-cc.js'); ?>"></script>
<script type="text/javascript" src="<?php echo asset_url('js/datepicker/scripts/calendar.js'); ?>"></script>
<script type="text/javascript" src="<?php echo asset_url('js/datepicker/scripts/jquery.ui.datepicker-cc-ar.js'); ?>"></script>
<script type="text/javascript" src="<?php echo asset_url('js/datepicker/scripts/jquery.ui.datepicker-cc-fa.js'); ?>"></script>

<script type="text/javascript">
    $(function() {
        // حالت پیشفرض
        $('#date-picker').datepicker({
            showButtonPanel: true
        });
        //-----------------------------------
    });
</script>
<div id="page-inner">
    <div class="row">
        <div class="col-md-12">
            <h2>فروش</h2>
            <h5>از این قسمت میتوانید تیل فروخته شده را وارد نمایید. </h5>

        </div>
    </div>
    <!-- /. ROW  -->
    <hr />
    <div class="row">
        <div class="col-md-12">
            <!-- Form Elements -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    فورم ثبت فروش
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form role="form">

                                <div class="col-md-3 form-group">
                                    <label>تاریخ</label>
                                    <input class="form-control" name="date" id="date-picker"/>
                                </div>
                                <div class="col-md-3 form-group">
                                    <label>تناژ (وزن سمیر)</label>
                                    <input class="form-control" name="amount"/>
                                </div>
                                <div class="col-md-3 form-group">
                                    <label>درایور (راننده)</label>
                                    <select class="form-control" name="account_id">
                                        <?php

                                        foreach ($driver_rows as $key => $d_value) {?>

                                            <option value="<?php echo $d_value->id;?>"><?php echo $d_value->name;?></option>

                                        <?php }?>

                                    </select>
                                </div>
                                <div class="col-md-3 form-group">
                                    <label>ترانزیت (نمبر موتر)</label>
                                    <input class="form-control" />
                                </div>
                                <div class="col-md-3 form-group">
                                    <label>ناحیه بارگیری</label>
                                    <select class="form-control" name="account_id">
                                        <?php

                                        foreach ($stock_rows as $key => $s_value) {?>

                                            <option value="<?php echo $a_value->id;?>"><?php echo $a_value->name;?></option>

                                        <?php }?>

                                    </select>
                                </div>
                                <div class="col-md-3 form-group">
                                    <label>ناحیه تخلیه</label>
                                    <select class="form-control" name="account_id">
                                        <?php

                                        foreach ($stock_rows as $key => $s2_value) {?>

                                            <option value="<?php echo $a_value->id;?>"><?php echo $a_value->name;?></option>

                                        <?php }?>

                                    </select>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label>شرح و تفصیلات</label>
                                    <textarea class="form-control" rows="1"></textarea>
                                </div>
                                <div class="col-md-offset-3 col-md-3 gaps">
                                    <button type="submit" class="btn btn-default pull-left">تائید</button>
                                    <button type="reset" class="btn btn-primary pull-left">تنظیم مجدد</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /. PAGE INNER  -->