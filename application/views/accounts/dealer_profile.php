<?php $this->load->view('check/ajax_get_check_info'); ?>
<div id="page-inner">
    <div class="row">
        <div class="col-md-12">
            <h2>پروفایل کمیشن کارها</h2>
            <h5>در این قسمت شما میتوانید تمام اطلاعات مربوط به کمیشن کار مورد نظر را مشاهده کنید.</h5>
        </div>
    </div>
    <!-- /. ROW  -->
    <hr />
    <div class="row">
        <div class="col-md-12 col-sm-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    اطلاعات عمومی
                    <div class="btn-group pull-left">
                        <a href="<?php echo site_url('cash/profile_credit_debit/').$this->uri->segment('3')."/".$this->uri->segment('4');?>">
                            بردگی</a> / 

                        <a href="<?php echo site_url('cash/debit_deal/').$this->uri->segment('3')."/".$this->uri->segment('4');?>">
                             رسیدگی </a>
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
                                <th>شماره تماس</th>
                                <th>تغییرات</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php

                            foreach ($account_rows as $key => $value) {?>
                                <tr class="odd gradeX">
                                    <td><?php echo $value->id;?></td>
                                    <td><?php echo $value->name;?></td>
                                    <td><?php echo $value->lname;?></td>
                                    <td><?php echo $value->phone;?></td>


                                    <td class="center">
                                        <a data-toggle="modal" data-target="#1myModal<?php echo $value->id; ?>" href="#"><span class="glyphicon glyphicon-trash" data-toggle='tooltip' title='حذف' data-placement='top'></span></a>
                                        <!-- Modal -->
                                        <div class="modal fade" id="1myModal<?php echo $value->id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                        <h4 class="modal-title" id="myModalLabel">هشدار برای حذف داده</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        ایا مطمن هستید که میخواهید حذف کنید؟
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">لغو</button>
                                                        <a type="button" class="btn btn-primary"   href="<?php echo site_url('account/delete/'.$value->id) ?>" " >تایید</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <a href="<?php echo site_url('account/edit/'.$value->id) ?>"><span class="glyphicon glyphicon-edit" data-toggle='tooltip' title='ویرایش' data-placement='top'></span></a>
                                        <?php echo ($value->status)?  "<a href='".site_url('account/inactive/'.$value->id.'')."'><span style='color:blue;' class='glyphicon glyphicon-ok-circle' data-toggle='tooltip' title='غیر فعال کردن کمیشن کار' data-placement='top'></span></a>" : "<a href='".site_url('account/active/'.$value->id.'')."'><span style='color: #f90c05;' class='glyphicon glyphicon-ban-circle' data-toggle='tooltip' title='فعال کردن کمیشن کار' data-placement='top'></span></a>"
                                        ; ?>
                                    </td>
                                </tr>
                            <?php }?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /. ROW -->
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
                                <th>کد</th>
                                <th>نوع پول</th>
                                <th>بیلانس (الباقی)</th>

                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach ($type_rows as $key => $type_value) {
                                $this->load->model('cash_model');
                                //$this->load->model('balance_model');

                                if($type_value->type!="check"){
                                    // $get_balance_date=$this->balance_model->get_balance_datetime(array('table_id'=>$type_value->account_id,'table_name'=>'account','balance_type'=>$type_value->type));
                                    $all=$this->cash_model->get_balance_credit_debit_mylty_money(
                                        $type_value);

                                    foreach ($all as $key => $value) {
                                        ?>

                                        <tr class="odd gradeX">
                                            <td><?php echo $value->id;?></td>

                                            <td>
                                                <?php
                                                if($type_value->type=="check"){
                                                    ?>
                                                    <button data-toggle="modal" data-target="#view-modal" data-id="<?php echo $type_value->id; ?>" id="getUser" class="btn btn-sm btn-info">
                                                        <i class="glyphicon glyphicon-eye-open"></i> چک</button>
                                                    <?php
                                                    // echo "<span style='cursor: pointer' onclick='get_check_info(".$cash_value->id.")'>".$cash_value->type."</span>";
                                                }else{
                                                    switch ($type_value->type){
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
                                                        case "klp";
                                                            echo "کلدار";
                                                            break;
                                                        default:
                                                            echo "عرض های دیکه ";
                                                    }

                                                }
                                                ?></td>
                                            </td>
                                            <td class="center"><?php echo $value->balance;?></td>
                                        </tr>
                                    <?php }}}?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr />
    <div class="row">
        <div class="col-md-12 col-sm-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    اطلاعات مالی
                    <div class="btn-group pull-left">

                        <select id="filter2">
                            <option value="بردگی">بردگی</option>
                            <option value="رسیدگی">رسیدگی</option>
                        </select>
                        <i class="fa fa-comments fa-filter" aria-hidden="true"> فیلتر </i>

                    </div>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example2">
                            <thead>
                            <tr>
                                <th>شماره فاکتور</th>
                                <th>تاریخ</th>
                                <th>مقدار پول</th>
                                <th>نوع پول</th>
                                <th>نوع دریافت / پرداخت پول</th>
                                <th>توضیحات</th>
                                <th>تغییرات</th>

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
                                                    case "klp";
                                                        echo "کلدار";
                                                        break;
                                                    default:
                                                        echo "عرض های دیکه ";
                                                }
                                            }
                                            ?></td>
                                        <td class="center"><?php
                                            switch ($cash_value->transaction_type) {
                                                case "debit";
                                                    echo "رسیدگی";
                                                    break;
                                                case "credit";
                                                    echo "بردگی";
                                                    break;
                                            }; ?></td>
                                        <td><?php echo $cash_value->desc; ?></td>
                                        <td class="center">
                                            <a data-toggle="modal" data-target="#2myModal<?php echo $cash_value->id; ?>" href="#"><span class="glyphicon glyphicon-trash"></span></a>
                                            <!-- Modal -->
                                            <div class="modal fade" id="2myModal<?php echo $cash_value->id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                            <h4 class="modal-title" id="myModalLabel">هشدار برای حذف داده</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            ایا مطمن هستید که میخواهید حذف کنید؟
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">لغو</button>
                                                            <a type="button" class="btn btn-primary"    href="<?php echo site_url('account/delete_cash/'.$cash_value->id) ?>"" >تایید</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <a href="<?php echo site_url('account/edit/' . $cash_value->id) ?>"><span
                                                    class="glyphicon glyphicon-edit"></span></a>

                                        </td>
                                    </tr>
                                <?php }
                            }?>
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