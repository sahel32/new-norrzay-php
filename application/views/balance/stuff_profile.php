<?php $this->load->view('check/ajax_get_check_info'); ?>
<div id="page-inner">
    <div class="row">
        <div class="col-md-12">
            <h2>بردگی و رسیدگی کارکنان</h2>
            <h5>در این قسمت شما میتوانید تمام اطلاعات مربوط به بردگی و رسیدگی کارمند مورد نظر را مشاهده کنید.</h5>
        </div>
    </div>
    <!-- /. ROW  -->
    <hr />
    <div class="row">
        <div class="col-md-12 col-sm-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    اطلاعات عمومی
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th>نام</th>
                                    <th>تخلص</th>
                                    <th>شماره تماس</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php


                                    foreach ($account_rows as $key => $value) {
                                        $this->load->model('cash_model');
                                        $single_balance_rows=$this->cash_model->get_balance_credit_debit_single(array('account_id' => $value->id));
                                       
                                        ?>
                                        <tr class="odd gradeX">
                                            <td><?php echo $value->name;?></td>
                                            <td><?php echo $value->lname;?></td>
                                            <td><?php echo $value->phone;?></td>
                                        </tr>
                                    <?php }  ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /. ROW -->
    <hr />
    <div class="row">
        <div class="col-md-12 col-sm-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    لیست بردگی ها
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example2">
                            <thead>
                            <tr>
                                <th>تاریخ</th>
                                <th>مبلغ</th>
                                <th>شرح و تفصیلات</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach ($all_debit_credit as $key => $cash_value) {
                                ?>
                                <tr class="odd gradeX">
                                    <td><?php  echo $cash_value->date;?></td>
                                    <td><?php  echo $cash_value->cash;?></td>
                                    <td class="center"></td>
                                </tr>
                            <?php  }?>
                            </tbody>
                            <thead>
                                <tr>
                                    <th colspan="1"></th>
                                    <th>مبلغ کل</th>
                                    <th colspan="1"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="1"></td>
                                    <td> AFG </td>
                                    <td colspan="1"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /. ROW -->

</div>
<!-- /. PAGE INNER  -->
