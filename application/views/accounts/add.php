<?php
foreach ($account as $key => $edit_value) {
}?>

<div class="row">
                    <div class="col-md-12">
                     <h2>ثبت افراد</h2>
                        <h5>از این قسمت میتوانید خریدار، فروشنده، صراف، درایور، کمیشن کار و کارمند جدید را ثبت نمایید. </h5>

                    </div>
            </div>
                 <!-- /. ROW  -->
            <hr />
            <div class="row">
                <div class="col-md-12">
                    <!-- Form Elements -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            فورم ثبت افراد
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <form role="form" action="<?php echo site_url('account/add'); ?>" method="post">
                                        <input type="hidden" value="<?php echo (isset($edit_value->id)) ? $edit_value->id : ''; ?>" name="id"/>

                                        <div class="col-md-3 form-group">

                                            <label>نام</label>
                                            <input type="text"
                                                   value="<?php echo (isset($edit_value->name)) ? $edit_value->name : set_value('name'); ?>"
                                                   name="name" class="form-control" data-trigger="hover"/>
                                            <span class="help-inline"><?php echo (form_error('name') ) ? form_error('name') : "<span class='red'>*</span>"; ?></span>

                                        </div>


                                        <div class="col-md-3 form-group">

                                            <label>تخلص</label>

                                            <input type="text"
                                                   value="<?php echo (isset($edit_value->lname)) ? $edit_value->lname : set_value('lname'); ?>"
                                                   name="lname" class="form-control" data-trigger="hover" />
                                            <span class="help-inline"><?php echo (form_error('lname') ) ? form_error('lname') : "<span class='red'>*</span>"; ?></span>

                                        </div>

                                        <div class="col-md-3 form-group">

                                            <label>شماره تماس</label>

                                            <input type="text"
                                                   value="<?php echo (isset($edit_value->phone)) ? $edit_value->phone : set_value('phone'); ?>"
                                                   name="phone" class="form-control" data-trigger="hover"/>
                                            <span class="help-inline"><?php echo (form_error('phone') ) ? form_error('phone') :""; ?></span>

                                        </div>

                                        <div class="col-md-3 form-group">
                                            <label>مشخصه فرد</label>
                                            <select class="form-control" name="type">

                                                <option
                                                    <?php echo (isset($edit_value->type) && $edit_value->type=="seller") ? "selected" : ''; ?>
                                                    value="seller">فروشنده تیل</option>
                                                <option
                                                    <?php echo (isset($edit_value->type) && $edit_value->type=="customer") ? "selected" : ''; ?>
                                                    value="customer">خریدار و فروشنده تیل</option>
                                                <option
                                                    <?php echo (isset($edit_value->type) && $edit_value->type=="driver") ? "selected" : ''; ?>
                                                    value="driver">راننده</option>
                                                <option
                                                    <?php echo (isset($edit_value->type) && $edit_value->type=="stuff") ? "selected" : ''; ?>
                                                    value="stuff">کارمند</option>
                                                <option
                                                    <?php echo (isset($edit_value->type) && $edit_value->type=="exchanger") ? "selected" : ''; ?>
                                                    value="exchanger">صراف</option>
                                                <option
                                                    <?php echo (isset($edit_value->type) && $edit_value->type=="dealer") ? "selected" : ''; ?>
                                                    value="dealer">کمیشن کار</option>
                                            </select>

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
            </div>







                