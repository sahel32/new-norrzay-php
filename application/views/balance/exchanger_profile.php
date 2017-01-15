<?php $this->load->view('check/ajax_get_check_info'); ?>
<div id="page-inner">
    <div class="row">
        <div class="col-md-12">
            <h2>بردگی و رسیدگی صرافی ها</h2>
            <h5>در این قسمت شما میتوانید تمام اطلاعات مربوط به بردگی و رسیدگی صراف مورد نظر را مشاهده کنید.</h5>
        </div>
    </div>
    <!-- /. ROW  -->
    <hr/>
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
                                <th>بیلانس</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php

                                foreach ($account_rows as $key => $value) {?>
                                    <tr class="odd gradeX">
                                        <td><?php echo $value->name;?></td>
                                        <td><?php echo $value->lname;?></td>
                                        <td><?php echo $value->phone;?></td>
                                        <td><span class="glyphicon glyphicon-usd"></span></td>
                                    </tr>
                                    <tr>
                                        <td colspan="3"></td>
                                        <td><span class="glyphicon glyphicon-euro"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="3"></td>
                                        <td> AFG </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3"></td>
                                        <td> IRN </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3"></td>
                                        <td> KLP </td>
                                    </tr>
                                <?php }?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr/>
    <!-- /. ROW -->
    <div class="row">
        <div class="col-md-12 col-sm-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    لیست رسیدگی ها
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example2">
                            <thead>
                            <tr>
                                <th>تاریخ</th>
                                <th>مبلغ</th>
                                <th>نوعیت پول</th>
                                <th>نوعیت دریافت / پرداخت</th>
                                <th>شرح و تفصیلات</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach ($type_rows as $key => $type_value) {
                                $this->load->model('balance_model');
                                $get_balance_date=$this->balance_model->get_balance_datetime(array('table_id'=>$type_value->account_id,'table_name'=>'account','balance_type'=>$type_value->type));
                                $this->load->model('cash_model');
                                $all_debit_credit=$this->cash_model->get_where(array('account_id' => $type_value->account_id,'date>='=>$get_balance_date,'type'=>$type_value->type));
                                foreach ($all_debit_credit as $key => $cash_value) {
                                    ?>
                                    <tr class="odd gradeX">
                                        <td><?php echo $cash_value->id; ?></td>
                                        <td><?php echo $cash_value->date; ?></td>
                                        <td><?php echo $cash_value->cash; ?></td>
                                        <td class="center"><?php
                                            if ($cash_value->type == "check") {
                                                ?>
                                                <button data-toggle="modal" data-target="#view-modal"
                                                        data-id="<?php echo $cash_value->id; ?>" id="getUser"
                                                        class="btn btn-sm btn-info">
                                                    <i class="glyphicon glyphicon-eye-open"></i> چک
                                                </button>
                                                <?php
                                                // echo "<span style='cursor: pointer' onclick='get_check_info(".$cash_value->id.")'>".$cash_value->type."</span>";
                                            } else {
                                                switch ($cash_value->type) {
                                                    case "usa";
                                                        echo "دالر";
                                                        break;
                                                    case "af";
                                                        echo "افغانی";
                                                        break;
                                                    case "ir";
                                                        echo "تومان";
                                                        break;
                                                    case "eur";
                                                        echo "یرو";
                                                        break;
                                                    default:
                                                        echo "عرض های دیکه ";
                                                }
                                            }
                                            ?></td>
                                        <td class="center"><?php
                                            switch ($cash_value->transaction_type) {
                                                case "credit";
                                                    echo "رسیدگی";
                                                    break;
                                                case "debit";
                                                    echo "بردگی";
                                                    break;
                                            }; ?></td>
                                    </tr>
                                <?php }
                            }?>
                            </tbody>
                            <thead>
                            <tr>
                                <th colspan="1"></th>
                                <th>مبلغ کل</th>
                                <th colspan="3"></th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>دالر</td>
                                    <td><span class="glyphicon glyphicon-usd"></span></td>
                                    <td colspan="3"></td>
                                </tr>
                                <tr>
                                    <td>یورو</td>
                                    <td><span class="glyphicon glyphicon-euro"></span></td>
                                    <td colspan="3"></td>
                                </tr>
                                <tr>
                                    <td>افغانی</td>
                                    <td> AFG </td>
                                    <td colspan="3"></td>
                                </tr>
                                <tr>
                                    <td>تومان</td>
                                    <td> IRN </td>
                                    <td colspan="3"></td>
                                </tr>
                                <tr>
                                    <td>کلدار</td>
                                    <td> KLP </td>
                                    <td colspan="3"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr/>
    <!-- /. ROW -->
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
                                <th>نوعیت پول</th>
                                <th>نوعیت دریافت / پرداخت</th>
                                <th>شرح و تفصیلات</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach ($type_rows as $key => $type_value) {
                                $this->load->model('balance_model');
                                $get_balance_date=$this->balance_model->get_balance_datetime(array('table_id'=>$type_value->account_id,'table_name'=>'account','balance_type'=>$type_value->type));
                                $this->load->model('cash_model');
                                $all_debit_credit=$this->cash_model->get_where(array('account_id' => $type_value->account_id,'date>='=>$get_balance_date,'type'=>$type_value->type));
                                foreach ($all_debit_credit as $key => $cash_value) {
                                    ?>
                                    <tr class="odd gradeX">
                                        <td><?php echo $cash_value->id; ?></td>
                                        <td><?php echo $cash_value->date; ?></td>
                                        <td><?php echo $cash_value->cash; ?></td>
                                        <td class="center"><?php
                                            if ($cash_value->type == "check") {
                                                ?>
                                                <button data-toggle="modal" data-target="#view-modal"
                                                        data-id="<?php echo $cash_value->id; ?>" id="getUser"
                                                        class="btn btn-sm btn-info">
                                                    <i class="glyphicon glyphicon-eye-open"></i> چک
                                                </button>
                                                <?php
                                                // echo "<span style='cursor: pointer' onclick='get_check_info(".$cash_value->id.")'>".$cash_value->type."</span>";
                                            } else {
                                                switch ($cash_value->type) {
                                                    case "usa";
                                                        echo "دالر";
                                                        break;
                                                    case "af";
                                                        echo "افغانی";
                                                        break;
                                                    case "ir";
                                                        echo "تومان";
                                                        break;
                                                    case "eur";
                                                        echo "یرو";
                                                        break;
                                                    default:
                                                        echo "عرض های دیکه ";
                                                }
                                            }
                                            ?></td>
                                        <td class="center"><?php
                                            switch ($cash_value->transaction_type) {
                                                case "credit";
                                                    echo "رسیدگی";
                                                    break;
                                                case "debit";
                                                    echo "بردگی";
                                                    break;
                                            }; ?></td>
                                    </tr>
                                <?php }
                            }?>
                            </tbody>
                            <thead>
                            <tr>
                                <th colspan="1"></th>
                                <th>مبلغ کل</th>
                                <th colspan="3"></th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>دالر</td>
                                    <td><span class="glyphicon glyphicon-usd"></span></td>
                                    <td colspan="3"></td>
                                </tr>
                                <tr>
                                    <td>یورو</td>
                                    <td><span class="glyphicon glyphicon-euro"></span></td>
                                    <td colspan="3"></td>
                                </tr>
                                <tr>
                                    <td>افغانی</td>
                                    <td> AFG </td>
                                    <td colspan="3"></td>
                                </tr>
                                <tr>
                                    <td>تومان</td>
                                    <td> IRN </td>
                                    <td colspan="3"></td>
                                </tr>
                                <tr>
                                    <td>کلدار</td>
                                    <td> KLP </td>
                                    <td colspan="3"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr/>
    <!-- /. ROW -->

</div>
<!-- /. PAGE INNER  -->
<script src="<?php echo asset_url('js/dataTables/jquery.dataTables.js'); ?>"></script>
<script src="<?php echo asset_url('js/dataTables/dataTables.bootstrap.js'); ?>"></script>

<script>
    $(document).ready(function () {
        $('#dataTables-example2').dataTable();

    });


    $('#filter2').change( function() {
        var filtervalue = this.value;
        var table2= $('#dataTables-example2').dataTable();
        table2.fnFilter(filtervalue );
    });
</script>