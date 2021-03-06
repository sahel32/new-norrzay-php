
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
        $("#datepicker2").datepicker({
            dateFormat: "yy/mm/dd"
        });

    });
</script>
 <div class="row">
                    <div class="col-md-12">
                     <h2>پیش خرید</h2>   
                        <h5>در این قسمت میتوانید با استفاده از فورم ذیل پیش خرید خود را ثبت نمایید.</h5>
                       
                    </div>
                </div>
                 <!-- /. ROW  -->
                 <hr />
                 <div class="row">
                <div class="col-md-12">
                    <!-- Form Elements -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           فورم ثبت پیش خرید
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <form role="form" action="<?php echo site_url('oil/pre_buy/'.$buy_sell); ?>" method="post" >

                                        <div class="col-md-3 form-group">
                                            <label>تاریخ پیش خرید</label>

                                            <input type="text"  value="<?php echo set_value('f_date'); ?>" name="f_date" class="form-control"  id="datepicker"/>
                                            <span class="help-inline"><?php echo (form_error('f_date') ) ? form_error('f_date') : "<span class='red'>*</span>"; ?></span>

                                        </div>
                                        <div class="col-md-3 form-group">
                                            <label>تاریخ تقریبی دریافت</label>

                                            <input type="text"  value="<?php echo set_value('s_date'); ?>" name="s_date" class="form-control"  id="datepicker2"/>
                                            <span class="help-inline"><?php echo (form_error('s_date') ) ? form_error('s_date') : "<span class='red'>*</span>"; ?></span>

                                        </div>

                                        <div class="col-md-3 form-group">
                                            <label>فروشنده دست اول</label>

                                            <input type="text"   name="first_hand" class="form-control"/>
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <label>خرید از </label>
                                            <select class="form-control" name="account_id">
                                            <?php 

									  	foreach ($account_rows as $key => $value) {?>
											
											<option value="<?php echo $value->id;?>"><?php echo $value->name;?></option>
											
											<?php }?>
                                            
                                            </select>
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="col-md-3 form-group">
                                            <label>نوع تیل</label>
                                            <select class="form-control" name="stock">
                                        <?php

                                        foreach ($stock_buy as $key => $bvalue) {?>


                                            <option value="<?php echo $bvalue->id;?>">
                                            <?php echo $bvalue->oil_type;
                                            ?></option>


                                        <?php }?>
                                        </select>
                                            </div>
                                        <div class="col-md-3 form-group">
                                            <label>نوع فروش</label>
                                            <select class="form-control" id="measurement-type" name="unit" >
                                            <option value="car">بر اساس موتر</option>
                                                <option value="ton">بر اساس تن</option>
                                                
                                            </select>
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <label id="car-ton">تعداد موتر</label>

                                            <input type="text"  value="<?php echo set_value('amount'); ?>"name="amount" class="form-control" />
                                            <span class="help-inline"><?php echo (form_error('amount') ) ? form_error('amount') : "<span class='red'>*</span>"; ?></span>

                                        </div>
                                        <div class="col-md-3 form-group">
                                            <label >فی موتر</label>

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
                                            <textarea class="form-control" rows="1" name="desc" ></textarea>
                                        </div>
                                        <div class="col-md-3 gaps">
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
             	$("#measurement-type").change(function (){
             		var value=$(this).val()
                    if(value=="ton"){
                        $("#car-ton").text('مقدار');
                        $("#car-count").prop('disabled', true);
                    }else{
                        $("#car-ton").text('تعداد موتر')
                        $("#car-count").prop('disabled', false);
                    }
             	})

             </script>