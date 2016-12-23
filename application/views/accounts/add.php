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
                                    <form role="form" action="<?php echo site_url('account/add'); ?>" method="post">

                                        <div class="col-md-3 form-group">

                                            <label>name :</label>
                                            <a href="#new-customer" data-toggle="modal">
                                                <i class="fa fa-plus-circle" data-toggle="tooltip" title="ثبت مشتری جدید" data-placement="top"></i>
                                            </a>
                                            <input type="text"  value="<?php echo set_value('name'); ?>"name="name" class="form-control" data-trigger="hover"/>
                                            <span class="help-inline"><?php echo (form_error('name') ) ? form_error('name') : "<span class='red'>*</span>"; ?></span>
                                
                                        </div>


                                        <div class="col-md-3 form-group">

                                            <label>last name :</label>
                                       
                                            <input type="text"  value="<?php echo set_value('lname'); ?>"name="lname" class="form-control" data-trigger="hover" />
                                            <span class="help-inline"><?php echo (form_error('lname') ) ? form_error('lname') : "<span class='red'>*</span>"; ?></span>
                                
                                        </div>

                                        <div class="col-md-3 form-group">

                                            <label>phone :</label>
                                       
                                            <input type="text"  value="<?php echo set_value('phone'); ?>"name="phone" class="form-control" data-trigger="hover"/>
                                            <span class="help-inline"><?php echo (form_error('phone') ) ? form_error('phone') :""; ?></span>
                                
                                        </div>

                                        <div class="col-md-3 form-group">
                                            <label>type</label>
                                            <select class="form-control" name="type">

                                                <option value="seller">seller</option>
                                                <option value="customer">costumer</option>
                                                <option value="driver">driver</option>
                                                <option value="stuff">stuff</option>
                                                <option value="exchanger">exchanger</option>
                                                <option value="dealer">dealer</option>
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

                </div>
            </div>





                