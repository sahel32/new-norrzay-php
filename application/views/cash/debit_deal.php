
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
        $('#datepicker').datepicker({
            showButtonPanel: true
        });
        //-----------------------------------
        $('#datepicker2').datepicker({
            showButtonPanel: true
        });
    });
</script>
<div class="row">
    <div class="col-md-12">
        <h2></h2>
        <h5></h5>

    </div>
</div>
<!-- /. ROW  -->
<hr />
<div class="row">
    <div class="col-md-12">
        <!-- Form Elements -->
        <div class="panel panel-default">
            <div class="panel-heading">

            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
                        <form role="form" action="<?php echo site_url('oil/debit_deal'); ?>" method="post" >

                            <div class="col-md-3 form-group">
                                <label>تاریح</label>

                                <input type="text"  value="<?php echo set_value('f_date'); ?>" name="f_date" class="form-control"  id="datepicker"/>
                                <span class="help-inline"><?php echo (form_error('f_date') ) ? form_error('f_date') : "<span class='red'>*</span>"; ?></span>

                            </div>

                            <div class="col-md-3 form-group">
                                <label>راننده</label>
                                <select class="form-control" name="account_id">
                                    <?php

                                    foreach ($account_rows as $key => $value) {?>

                                        <option value="<?php echo $value->id;?>"><?php echo $value->name;?></option>

                                    <?php }?>

                                </select>
                            </div>
                            <div class="col-md-3 form-group">
                                <label>از گدام...</label>
                                <select class="form-control" name="stock">
                                    <?php

                                    foreach ($stock as $key => $bvalue) {?>


                                        <option value="<?php echo $bvalue->id;?>">
                                            <?php echo $bvalue->oil_type;
                                            ?></option>


                                    <?php }?>
                                </select>
                            </div>
                            <div class="col-md-3 form-group">
                                <label>به گدام...</label>
                                <select class="form-control" name="stock">
                                    <?php

                                    foreach ($stock as $key => $bvalue) {?>


                                        <option value="<?php echo $bvalue->id;?>">
                                            <?php echo $bvalue->oil_type;
                                            ?></option>


                                    <?php }?>
                                </select>
                            </div>
                            <div class="col-md-3 form-group">
                                <label id="car-ton">تعداد موتر</label>

                                <input type="text"  value="<?php echo set_value('amount'); ?>"name="amount" class="form-control" />
                                <span class="help-inline"><?php echo (form_error('amount') ) ? form_error('amount') : "<span class='red'>*</span>"; ?></span>

                            </div>
                            <div class="col-md-3 form-group">
                                <label >تناز</label>

                                <input type="text" id="car-count" value="<?php echo set_value('car_count'); ?>"name="car_count" class="form-control" />
                                <span class="help-inline"><?php echo (form_error('car_count') ) ? form_error('car_count') : "<span class='red'>*</span>"; ?></span>

                            </div>

                            <div class="col-md-3 form-group">
                                <label>فی تن</label>
                                <input type="text"  value="<?php echo set_value('unit_price'); ?>"name="unit_price" class="form-control"  id="car-number"/>
                                <span class="help-inline"><?php echo (form_error('unit_price') ) ? form_error('unit_price') : "<span class='red'>*</span>"; ?></span>

                            </div>
                            <div class="col-md-6 form-group">
                                <label>شرح و تفصیلات</label>
                                <textarea class="form-control" rows="3" name="desc" ></textarea>
                            </div>
                            <div class="col-md-offset-3 col-md-3 gap">
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

    <script>

        $(document).ready(function(){


            //alert("hi")
        })


        $("#measurement-type").change(function (){
            var value=$(this).val()
            if(value=="ton"){
                $("#car-ton").text('مقدار');
                $("#car-count").prop('disabled', true);
            }else{
                $("#car-ton").text('تعداد موتر')
                $("#car-count").prop('disabled', false);
            }
            /*if(value=="ton"){
             $("#car-number").attr('disabled','disabled');
             }else{
             $("#car-number").attr('enabled','enabled');
             }*/


        })

    </script>