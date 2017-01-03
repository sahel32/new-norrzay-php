<div class="row">
                    <div class="col-md-12">
                     <h2>ثبت درایور</h2>   
                        <h5>از این قسمت میتوانید مشخصات درایور را ثبت نمایید. </h5>
                       
                    </div>
                </div>
                 <!-- /. ROW  -->
                 <hr />
                 <div class="row">
                <div class="col-md-12">
                    <!-- Form Elements -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            فورم ثبت درایور
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <form role="form" action="<?php echo site_url('stock/add'); ?>" method="post">

                                        <div class="col-md-3 form-group">

                                            <label>name :</label>
                                       
                                            <input type="text"  value="<?php echo set_value('name'); ?>"name="name" class="form-control" data-trigger="hover"/>
                                            <span class="help-inline"><?php echo (form_error('name') ) ? form_error('name') : "<span class='red'>*</span>"; ?></span>
                                
                                        </div>


                                        <div class="col-md-3 form-group">

                                            <label>provionce :</label>
                                       
                                            <input type="text"  value="<?php echo set_value('province'); ?>"name="province" class="form-control" data-trigger="hover" />
                                            <span class="help-inline"><?php echo (form_error('province') ) ? form_error('province') : "<span class='red'>*</span>"; ?></span>
                                
                                        </div>


                                        <div class="col-md-3 form-group">
                                            <label>نوع گدام</label>
                                            <select class="form-control" name="oil_type">
                                                <?php

                                                foreach ($oil_type_rows as $key => $d_value) {?>

                                                    <option value="<?php echo $d_value->oil_type;?>"><?php echo $d_value->oil_type;?></option>

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




                