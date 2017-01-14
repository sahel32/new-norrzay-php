

<!--<script src="<?php /*echo asset_url('js/bootstrap-datepicker/bootstrap-datepicker.min.js'); */?>"></script>
<script src="<?php /*echo asset_url('js/bootstrap-datepicker/bootstrap-datepicker.fa.min.js'); */?>"></script>
<link href="<?php /*echo asset_url('js/bootstrap-datepicker/bootstrap-datepicker.min.css'); */?>" rel="stylesheet" type="text/css" >
-->
<!--<script type="text/javascript">
    $(function(){
        $("#datepicker").datepicker({
            dateFormat: "yy/mm/dd"
        });
    });
</script>-->

<style>
    .ui-autocomplete-loading {
        background: white url("<?php echo asset_url('jquery-ui-1.10.4/ui-anim_basic_16x16.gif');?>") right center no-repeat;
    }

</style>
<link href="<?php echo asset_url('jquery-ui-1.10.4/jquery-ui.css'); ?>" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.1/jquery-ui.js"></script>

<script type="text/javascript">
    $(function(){
        $("#get_real_oil_id").autocomplete({
            source: "<?php echo site_url('cash/get_real_oil_id_json');?>" // path to the get_birds method
        });
    });
</script>
<div id="page-inner">
    <div class="row">
        <div class="col-md-12">
            <h2>رسیدگی کمیشن کار</h2>
            <h5>در این قسمت شما میتوانید اطلاعات مربوط به رسیدگی کمیشن کار مورد نظر را ثبت نمایید.</h5>
        </div>
    </div>
    <!-- /. ROW  -->
    <hr />
    <div class="row">
    <div class="col-md-12">
        <!-- Form Elements -->
        <div class="panel panel-default">
            <div class="panel-heading">
            فورم ثبت رسیدگی کمیشن کار
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
                        <form role="form" action="<?php echo site_url('cash/debit_deal/'.$id.'/'.$type); ?>" method="post" >


                            <div class="col-md-3 form-group">
                                <label>تاریخ</label>

                                <input type="text"  value="<?php echo set_value('date'); ?>" name="date" class="form-control"  id="datepicker"/>
                                <span class="help-inline"><?php echo (form_error('date') ) ? form_error('date') : "<span class='red'>*</span>"; ?></span>

                            </div>

                            <div class="col-md-3 form-group">
                                <label id="car-ton">کد موتر</label>

                                <input type="text" id="get_real_oil_id"  value="<?php echo set_value('st_id'); ?>"name="st_id" class="form-control" data-trigger="hover"/>
                                <span class="help-inline"><?php echo (form_error('st_id') ) ? form_error('st_id') : "<span class='red'>*</span>"; ?></span>

                            </div>
                            <div class="col-md-3 form-group">

                                <label>نوعیت پول</label>


                                <select class="form-control" name="type" id="type">

                                    <?php
                                    foreach ($money_type as $anotherkey => $val) {
                                        echo "<option value='".$anotherkey."'>".$val."</option>";
                                    }
                                    ?>
                                    <option value="check" >check</option>


                                </select>

                            </div>

                            <div class="col-md-3 form-group">
                                <label>فی تن</label>
                                <input type="text"  value="<?php echo set_value('unit_price'); ?>"name="unit_price" class="form-control"  id="car-number"/>
                                <span class="help-inline"><?php echo (form_error('unit_price') ) ? form_error('unit_price') : "<span class='red'>*</span>"; ?></span>

                            </div>

                            <div class="col-md-offset-9 col-md-3 gaps">
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
</div>

