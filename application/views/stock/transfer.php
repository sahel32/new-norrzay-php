<div class="row">
    <div class="col-md-12">
        <h2>انتقال تیل</h2>
        <h5>از این قسمت میتوانید تیل را از یک گدام به گدام دیگر انتقال دهید. </h5>

    </div>
</div>
<!-- /. ROW  -->
<hr />
<div class="row">
    <div class="col-md-12">
        <!-- Form Elements -->
        <div class="panel panel-default">
            <div class="panel-heading">

                فورم انتقال تیل
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
                        <form role="form" method="post" action="<?php echo site_url('stock/transfer');?>">

                            <div class="col-md-3 form-group">
                                <label>تاریخ</label>
                                <input type="text"  value="<?php echo set_value('date'); ?>" name="date" class="form-control"  id="datepicker"/>
                                <span class="help-inline"><?php echo (form_error('date') ) ? form_error('date') : "<span class='red'>*</span>"; ?></span>

                            </div>
                            <div class="col-md-3 form-group">
                                <label>نام درایور (راننده)</label>
                                <input class="form-control" name="driver_name">
                            </div>
                            <div class="col-md-3 form-group">
                                <label>نمبر موتر (ترانزیت)</label>
                                <input type="text"  value="<?php echo set_value('transit'); ?>" name="transit" class="form-control" />
                                <span class="help-inline"><?php echo (form_error('transit') ) ? form_error('transit') : "<span class='red'>*</span>"; ?></span>

                            </div>
                            <div class="col-md-3 form-group">
                                <label>تناژ</label>
                                <input type="text"  value="<?php echo set_value('amount'); ?>" name="amount" class="form-control" />
                                <span class="help-inline"><?php echo (form_error('amount') ) ? form_error('amount') : "<span class='red'>*</span>"; ?></span>

                            </div>
                            <div class="col-md-3 form-group">
                                <label>گدام مبدا</label>
                                <select class="form-control" name="stock_source">
                                    <?php

                                    foreach ($stocks as $key => $bvalue) {?>


                                        <option value="<?php echo $bvalue->id;?>">
                                            <?php echo $bvalue->name.' - '.$bvalue->oil_type;
                                            ?></option>


                                    <?php }?>
                                </select>
                            </div>
                            <div class="col-md-3 form-group">
                                <label>گدام مقصد</label>
                                <select class="form-control" name="stock_target">
                                    <?php

                                    foreach ($stocks as $key => $bvalue) {?>


                                        <option value="<?php echo $bvalue->id;?>">
                                            <?php echo $bvalue->name.' - '.$bvalue->oil_type;
                                            ?></option>


                                    <?php }?>
                                </select>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>شرح و تفصیلات</label>
                                <textarea class="form-control" rows="1" name="desc"></textarea>
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


        <script src="<?php echo asset_url('js/bootstrap-datepicker/bootstrap-datepicker.min.js'); ?>"></script>
<script src="<?php echo asset_url('js/bootstrap-datepicker/bootstrap-datepicker.fa.min.js'); ?>"></script>
<link href="<?php echo asset_url('js/bootstrap-datepicker/bootstrap-datepicker.min.css'); ?>" rel="stylesheet" type="text/css" >

        <script type="text/javascript">
            $(function(){
                $("#datepicker").datepicker({
                    dateFormat: "yy/mm/dd"
                });
            });
        </script>