<?php
foreach ($edit_data as $key =>$value){

}
?>
<div class="row">
                    <div class="col-md-12">
                     <h2>ثبت گدام </h2>   
                        <h5>از این قسمت میتوانید مشخصات گدام جدید را وارد نمایید. </h5>
                       
                    </div>
                </div>
                 <!-- /. ROW  -->
                 <hr />
                 <div class="row">
                <div class="col-md-12">
                    <!-- Form Elements -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            فورم ثبت گدام
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <form role="form" action="<?php echo site_url('stock/add'); ?>" method="post">

                                        <input type="hidden" value="<?php echo (isset($value->id)) ? $value->id : ''; ?>" name="id" class="form-control" data-trigger="hover"/>

                                        <div class="col-md-3 form-group">

                                            <label>نام گدام</label>
                                       
                                            <input type="text" value="<?php echo (isset($value->name)) ? $value->name : set_value('name'); ?>" name="name" class="form-control" data-trigger="hover"/>
                                            <span class="help-inline"><?php echo (form_error('name') ) ? form_error('name') : "<span class='red'>*</span>"; ?></span>
                                
                                        </div>


                                        <div class="col-md-3 form-group">

                                            <label>ولایت</label>
                                       
                                            <input type="text" value="<?php echo (isset($value->province)) ? $value->province : set_value('name'); ?>"
                                                  name="province" class="form-control" data-trigger="hover" />
                                            <span class="help-inline"><?php echo (form_error('province') ) ? form_error('province') : "<span class='red'>*</span>"; ?></span>
                                
                                        </div>


                                        <div class="col-md-3 form-group">
                                            <label>نوع گدام</label>
                                            <select class="form-control" name="oil_type">
                                                <?php

                                                foreach ($oil_type_rows as $key => $d_value) {?>

                                                    <option  <?php echo (isset($value->oil_type) && $value->oil_type==$d_value->oil_type) ? "selected" : ''; ?>
                                                        value="<?php echo $d_value->oil_type;?>"><?php echo $d_value->oil_type;?></option>

                                                <?php }?>

                                            </select>
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




                