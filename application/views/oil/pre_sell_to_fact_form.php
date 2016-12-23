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
                            <form role="form" action="<?php echo site_url('oil/pre_sell_to_fact_form'); ?>" method="post">

                                <div class="col-md-3 form-group">
                                   
                                    <label>کد پیش فروش</label>
                                    <?php if ($popupp_pre_buy_sell_id==""){ ?>
                                        <input type="text"  value="<?php echo set_value('pre_buy_sell_id'); ?>" name="pre_buy_sell_id" class="form-control"  />
                                        <span class="help-inline"><?php echo (form_error('pre_buy_sell_id') ) ? form_error('pre_buy_sell_id') : "<span class='red'>*</span>"; ?></span>
                                    <?php  }else{
                                        echo $popupp_pre_buy_sell_id;
                                        echo "<input type='hidden'  value='$popupp_pre_buy_sell_id' name='pre_buy_sell_id' >";
                                    }?>
                                </div>
                                <div class="col-md-3 form-group">
                                    <label>مقدار موجود</label>
                                    <?php
                                    echo $remain;
                                    echo "<input type='hidden'  value='$remain' name='remain' id='remain' >";
                                    ?>
                                </div>
                                <div class="col-md-3 form-group">
                                    <label>تاریخ</label>
                                    <input class="form-control" name="received_date" id="date-picker" />
                                </div>
                                <div class="col-md-3 form-group">
                                    <label>تاریخ</label>
                                    <input type="text" class="form-control" name="account_id" value="<?php
                                    $this->load->model('oil_model');
                                    echo $this->oil_model->get_where_column(array('id'=>$popupp_pre_buy_sell_id),
                                        'buyer_seller_id')
                                    ?>" />
                                </div>


                                <div class="col-md-3 form-group">
                                    <label>درایور (راننده)</label>
                                    <input type="text"  value="<?php echo set_value('name'); ?>" name="name" class="form-control"  />
                                    <span class="help-inline"><?php echo (form_error('name') ) ? form_error('transit') : "<span class='red'>*</span>"; ?></span>

                                </div>
                                <div class="col-md-3 form-group">
                                    <label>ترانزیت (نمبر موتر)</label>
                                    <input type="text"  value="<?php echo set_value('transit'); ?>" name="transit" class="form-control"  />
                                    <span class="help-inline"><?php echo (form_error('transit') ) ? form_error('transit') : "<span class='red'>*</span>"; ?></span>

                                </div>
                                <div class="col-md-3 form-group">
                                    <label>تناژ (وزن سمیر)</label>
                                    <input type="text"  value="<?php echo set_value('amount'); ?>" name="amount" class="form-control" id="amount"  />
                                    <span class="help-inline"><?php echo (form_error('amount') ) ? form_error('amount') : "<span class='red'>*</span>"; ?></span>
                                </div>


                                <div class="col-md-3 form-group">
                                    <label>نمبر گمرک فروش</label>
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

                /*  $( "#submit" ).click( function( ) {
                 var first=$("#first_amount").val()
                 var remain=$("#remain").val()

                 if(remain<first){
                 alert(remain+'/'+first)
                 alert("مقدار وارده شما بیشتراز مفدار باقی مانده هست ")
                 return false;
                 }

                 });*/

                $( "#second_amount" ).change( function( ) {
                    var first_amount=$("#first_amount").val()
                    var second_amount=this.value
                    var extra_amount= second_amount - first_amount

                    $("#extra_amount").val(extra_amount)

                });
            })
        </script><?php
/**
 * Created by PhpStorm.
 * User: Miss You A
 * Date: 12/2/2016
 * Time: 7:45 PM
 */