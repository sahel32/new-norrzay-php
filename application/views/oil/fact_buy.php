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
            <h2>خرید</h2>
            <h5>از این قسمت میتوانید تیل خریداری شده را وارد نمایید. </h5>

        </div>
    </div>
    <!-- /. ROW  -->
    <hr />
    <div class="row">
        <div class="col-md-12">
            <!-- Form Elements -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    فورم ثبت خرید
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form role="form" action="<?php site_url('oil/buy'); ?>" method="post">

                               

                                <div class="col-md-3 form-group">
                                    <label>تاریخ</label>
                                    <input class="form-control" name="received_date" id="date-picker" />
                                </div>

                                <div class="col-md-3 form-group">
                                    <label>فروشنده دست اول</label>
                                    <select class="form-control" name="account_id">
                                        <?php

                                        foreach ($seller_rows as $key => $s_value) {?>

                                            <option value="<?php echo $s_value->id;?>"><?php echo $s_value->name;?></option>

                                        <?php }?>

                                    </select>
                                </div>
                                <div class="col-md-3 form-group">
                                    <label>درایور (راننده)</label>
                                    <select class="form-control" name="driver_id">
                                        <?php

                                        foreach ($driver_rows as $key => $d_value) {?>

                                            <option value="<?php echo $d_value->id;?>"><?php echo $d_value->name;?></option>

                                        <?php }?>

                                    </select>
                                </div>
                                <div class="col-md-3 form-group">
                                    <label>ترانزیت (نمبر موتر)</label>
                                    <input type="text"  value="<?php echo set_value('transit'); ?>" name="transit" class="form-control"  />
                                    <span class="help-inline"><?php echo (form_error('transit') ) ? form_error('transit') : "<span class='red'>*</span>"; ?></span>

                                </div>
                                <div class="col-md-3 form-group">
                                    <label>سمیر (آیدی بارنامه)</label>
                                    <input type="text"  value="<?php echo set_value('barcode'); ?>" name="barcode" class="form-control"  />
                                    <span class="help-inline"><?php echo (form_error('barcode') ) ? form_error('barcode') : "<span class='red'>*</span>"; ?></span>
                                </div>
                                <div class="col-md-3 form-group">
                                    <label>تناژ (وزن سمیر)</label>
                                    <input type="text"  value="<?php echo set_value('first_amount'); ?>" name="first_amount" class="form-control" id="first_amount"  />
                                    <span class="help-inline"><?php echo (form_error('first_amount') ) ? form_error('first_amount') : "<span class='red'>*</span>"; ?></span>
                                </div>
                                <div class="col-md-3 form-group">
                                    <label>وزن تخلیه</label>
                                    <input type="text"  value="<?php echo set_value('second_amount'); ?>" name="second_amount" class="form-control" id="second_amount"  />
                                    <span class="help-inline"><?php echo (form_error('second_amount') ) ? form_error('second_amount') : "<span class='red'>*</span>"; ?></span>
                                </div>
                                <div class="col-md-3 form-group">
                                    <label>اضافه بار</label>
                                    <input type="text"  value="<?php echo set_value('extra_amount'); ?>" name="extra_amount" class="form-control" id="extra_amount"  />
                                    <span class="help-inline"><?php echo (form_error('extra_amount') ) ? form_error('extra_amount') : "<span class='red'>*</span>"; ?></span>
                                </div>
                                <div class="col-md-3 form-group">
                                    <label>مبلغ اضافه بار</label>
                                    <input type="text"  value="<?php echo set_value('extra_money'); ?>" name="extra_money" class="form-control" id="extra_money"  />
                                    <span class="help-inline"><?php echo (form_error('extra_money') ) ? form_error('extra_money') : "<span class='red'>*</span>"; ?></span>
                                </div>
                                <div class="col-md-3 form-group">
                                    <label>ناحیه بارگیری</label>
                                    <input class="form-control" name="source" />
                                </div>
                                <div class="col-md-3 form-group">
                                    <label>ناحیه تخلیه</label>
                                    <select class="form-control" name="stock_id" >
                                        <?php

                                        foreach ($stock_rows as $key => $value) {?>

                                            <option value="<?php echo $value->id;?>"><?php echo $value->name;?></option>

                                        <?php }?>

                                    </select>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label>شرح و تفصیلات</label>
                                    <textarea name="desc" class="form-control" rows="1" data-toggle="tooltip" title="نکات بیشتر را میتوانید در این قسمت ذکر کنید." data-placement="top"></textarea>
                                </div>
                                <div class="col-md-3 gaps">
                                    <button type="submit" class="btn btn-default pull-left" id="submit">تائید</button>
                                    <button type="reset" class="btn btn-primary pull-left">تنظیم مجدد</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /. PAGE INNER  -->

        <script>
            $(document).ready(function() {

                $( "#submit" ).click( function( ) {
                    var first=$("#first_amount").val()
                    var remain=$("#remain").val()
                    alert(remain+'/'+first)
                    if(remain<first){
                        alert("مقدار وارده شما بیشتراز مفدار باقی مانده هست ")
                        return false;
                    }

                });

                $( "#second_amount" ).change( function( ) {
                    var first_amount=$("#first_amount").val()
                    var second_amount=this.value
                    var extra_amount=first_amount - second_amount

                    $("#extra_amount").val(extra_amount)

                });
            })
        </script>