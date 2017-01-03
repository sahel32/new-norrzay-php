<?php $this->load->view('accounts/ajax_delete_review');?>
<div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <h2>لیست افراد</h2>   
                        <h5>در جدول پایین شما میتوانید لیست راننده ها را مشاهده کنید.</h5>   
                    </div>
                </div>
                 <!-- /. ROW  -->
                 <hr />
                <div class="row">
                    <div class="col-md-12">
                        <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">


                             لیست راننده ها
                            <div class="btn-group pull-left">
                                <?php
                                if($this->uri->segment('3')=="seller" or $this->uri->segment('3')=="customer"){?>
                                    <a href="<?php echo site_url('cash/oil_credit_debit/').$this->uri->segment('3');?>">پرداخت/دریافت</a>
                               <?php  }else{
                                ?>
                                <a href="<?php echo site_url('cash/credit_debit/').$this->uri->segment('3');?>">پرداخت/دریافت</a>
                                <?php }?>

                                <select id="filter2">
                                    <option value="debit">debit</option>
                                    <option value="credit">credit</option>
                                </select>
                                <i class="fa fa-comments fa-filter" aria-hidden="true"> فیلتر </i>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>کد</th>
                                            <th>نام</th>
                                            <th>تخلص</th>
                                            <th>تلفن</th>

                                            <th>بیلانس (الباقی)</th>
                                            <th>تغییرات</th>
                                            <th>وضعیت</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    foreach ($account_rows as $key => $value) {
                                       // $this->load->model('cash_model');
                                        $this->load->model('balance_model');
                                       // $get_balance_date=$this->balance_model->get_balance_datetime(array('table_id'=>$value->id,'table_name'=>'account'));
                                        $single_balance_rows=$this->cash_model->get_balance_credit_debit_single(array('account_id' => $value->id));
                                       ?>
                                        <tr class="odd gradeX"  >
                                            <td><?php echo $value->id;?></td>
                                            <td><?php echo $value->name;?></td>
                                            <td><?php echo $value->lname;?></td>
                                            <td><?php echo $value->phone;?></td>
                                <?php    foreach ($single_balance_rows as $bkey => $bvalue) {?><?php }?>
                                     <!--       <td class="center"><?php /*echo (isset($bvalue->debit))? $bvalue->debit : "";*/?></td>
                                            <td class="center"><?php /*echo (isset($bvalue->credit))? $bvalue->credit : "";*/?></td>-->
                                            <td class="center"><?php echo (isset($bvalue->balance))? $bvalue->balance : "";?></td>

                                            <td class="center" >
                                                <div data-toggle="modal" data-id="<?php echo $value->id;?>" data-target="#view-modal" id="getUser" class="glyphicon glyphicon-trash">
                                                </div>
                                                <a href="<?php echo site_url('account/edit/'.$value->id) ?>"><span class="glyphicon glyphicon-edit"></span></a>
                                                <a href="<?php echo site_url('account/profile/'.$value->id.'/'.$value->type); ?>"><span class="glyphicon glyphicon-asterisk"></span></a>
<!--                                                <a href="<?php /*echo site_url('balance/get_single_balance/'.$value->id.'/'.$value->type); */?>"><span class="glyphicon glyphicon-asterisk"></span></a>
-->
                                            </td>
                                            <td class="center">
                                                <?php echo ($value->status)?  "<a href='".site_url('account/inactive/'.$value->id.'')."'> غیر فعال کردن </a>" : "<a href='".site_url('account/active/'.$value->id.'')."'> فعال کردن </a>"
                                                ; ?>
                                            </td>
                                        </tr>
                                    <?php }  ?>

                                    </tbody>
                                </table>
                            </div>
                            
                        </div>
                    </div>
                    <!--End Advanced Tables -->
                    </div>
                </div>
                 <!-- /. ROW  -->
            </div>
             <!-- /. PAGE INNER  -->


       <script src="<?php echo asset_url('js/dataTables/jquery.dataTables.js'); ?>"></script>
    <script src="<?php echo asset_url('js/dataTables/dataTables.bootstrap.js'); ?>"></script>

            <script>
            $(document).ready(function () {
                $('#dataTables-example').dataTable();
            });

            $('#list').change( function() {
                var filtervalue = this.value;
                var table2= $('#dataTables-example2').dataTable();
                table2.fnFilter(filtervalue );
            });
    </script>
      <!-- CUSTOM SCRIPTS -->
         