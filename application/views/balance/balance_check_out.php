
<div id="page-inner">
    <div class="row">
        <div class="col-md-12">
            <h2>پروفایل مشتری</h2>
            <h5>در این قسمت شما میتوانید تمام اطلاعات مربوط به خریدار و فروشنده مورد نظر را مشاهده کنید.</h5>
        </div>
    </div>
    <!-- /. ROW  -->
    <hr />
    <div class="row">
        <div class="col-md-12">
            <!-- Form Elements -->
            <div class="panel panel-default">

                <?php if($check_last_balance==0){ ?>
                    <div class="panel-heading">
                        بالانس گیری جید یا نمایش اخرین بالانس
                    </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">

                            <form role="form" action="<?php echo site_url('balance/balance_check_out/'.$id ); ?>" method="post">

                         
                                <?php

                                foreach ($single_balance_rows as $key => $value) {?>
                                <div class="col-md-3 form-group">
                                    <lable>بردگی</lable>
                                    <input type="text" value="<?php echo $value->debit;?>" name="debit" class="form-control">

                                </div>


                                <div class="col-md-3 form-group">
                                    <lable>رسیدگی</lable>
                                    <input type="text" value="<?php echo $value->credit;?>" name="credit" class="form-control">


                                </div>

                                <div class="col-md-3 form-group">
                                    <lable>طلب</lable>
                                    <input type="text" value="<?php echo $value->balance;?>" name="balance" class="form-control">

                                </div>

                                <div class="col-md-3 form-group">
                                    <lable>تاریخ</lable>
                                    <input type="text" id="datepicker " value="<?php echo $date_time;?>" name="date" class="form-control">

                                </div>
                                <?php } ?>
                                <div class="col-md-3 gaps">
                                    <button type="submit" class="btn btn-default pull-left">تائید</button>
                                    <button type="reset" class="btn btn-primary pull-left">تنظیم مجدد</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <?php }else{?>
                    <div class="panel-heading">
                       امروز یک باز بلاانس پرفته شده
                    </div>
               <?php }?>
            </div>

        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-12">
            <!-- Form Elements -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    بالانس گیری جید یا نمایش اخرین بالانس
                </div>

                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                <tr>
                                    <th>کد</th>
                                    <th>تاریخ</th>
                                    <th>بالانس</th>
                                    <th>بردگی  </th>
                                    <th>رسیدگی </th>

                                    <th>تغییرات</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                foreach ($last_balance as $key => $value) {?>
                                    <tr class="odd gradeX">
                                        <td><?php echo $value->id;?></td>
                                        <td><?php echo $value->date;?></td>
                                        <td><?php echo $value->balance;?></td>
                                        <td><?php echo $value->debit_buy;?></td>
                                        <td><?php echo $value->credit_sell;?></td>
                                        <td class="center">
                                            <a href="<?php echo site_url('account/delete/'.$value->id) ?>"><span class="glyphicon glyphicon-trash"></span></a>
                                            <a href="<?php echo site_url('account/edit/'.$value->id) ?>"><span class="glyphicon glyphicon-edit"></span></a>
                                        </td>
                                    </tr>
                                <?php }  ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
            </div>

        </div>
    </div>
</div>
<!-- /. PAGE INNER  -->

<script src="<?php echo asset_url('js/dataTables/jquery.dataTables.js'); ?>"></script>
<script src="<?php echo asset_url('js/dataTables/dataTables.bootstrap.js'); ?>"></script>

<script>
    $(document).ready(function () {
        $('#dataTables-example').dataTable();
    });
</script>
<!-- CUSTOM SCRIPTS -->

<link type="text/css" href="<?php echo asset_url('js/datepicker/styles/jquery-ui-1.8.14.css'); ?>" rel="stylesheet" />

<script type="text/javascript" src="<?php echo asset_url('js/datepicker/scripts/jquery-1.6.2.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo asset_url('js/datepicker/scripts/jquery.ui.core.js'); ?>"></script>
<script type="text/javascript" src="<?php echo asset_url('js/datepicker/scripts/jquery.ui.datepicker-cc.js'); ?>"></script>
<script type="text/javascript" src="<?php echo asset_url('js/datepicker/scripts/calendar.js'); ?>"></script>
<script type="text/javascript" src="<?php echo asset_url('js/datepicker/scripts/jquery.ui.datepicker-cc-ar.js'); ?>"></script>
<script type="text/javascript" src="<?php echo asset_url('js/datepicker/scripts/jquery.ui.datepicker-cc-fa.js'); ?>"></script>

<script type="text/javascript">
    $(function() {
        $('#datepicker').datepicker({
            showButtonPanel: true
        });

    });
</script>
