<?php $this->load->view('check/ajax_get_check_info'); ?>
<div id="page-inner">
    <div class="row">
        <div class="col-md-12">
            <h2>پروفایل فروشنده ها </h2>
            <h5>در این قسمت شما میتوانید تمام اطلاعات مربوط به خریدار و فروشنده مورد نظر را مشاهده کنید.</h5>
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
                        <a href="<?php echo site_url('cash/profile_oil_credit_debit/').$this->uri->segment('3')."/".$this->uri->segment('4');?>">
                            پرداخت/دریافت</a>
                        <button href="#new-customer" data-toggle="modal" >پرداخت
                            <i class="fa fa-plus-circle" data-toggle="tooltip" title="ثبت مشتری جدید" data-placement="top"></i></button><button>رسید</button>

                        <i class="fa fa-comments fa-button" aria-hidden="true"></i>
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
                                <th>بردگی</th>
                                <th>رسیدگی</th>
                                <th>بیلانس (الباقی)</th>
                                <th>تغییرات</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach ($account_rows as $key => $value) {
                                $this->load->model('cash_model');
                                $single_balance_rows=$this->cash_model->get_balance_credit_debit_single(array('account_id' => $value->id),$get_balance_date);

                                ?>
                                <tr class="odd gradeX">
                                    <td><?php echo $value->id;?></td>
                                    <td><?php echo $value->name;?></td>
                                    <td><?php echo $value->lname;?></td>
                                    <td><?php echo $value->phone;?></td>
                                    <?php    foreach ($single_balance_rows as $bkey => $bvalue) {?><?php }?>
                                    <td class="center"><?php echo (isset($bvalue->debit))? $bvalue->debit : "";?></td>
                                    <td class="center"><?php echo (isset($bvalue->credit))? $bvalue->credit : "";?></td>
                                    <td class="center"><?php echo (isset($bvalue->balance))? $bvalue->balance : "";?></td>
                                    <td class="center">
                                        <a href="<?php echo site_url('account/delete/'.$value->id) ?>"><span class="glyphicon glyphicon-trash"></span></a>
                                        <a href="<?php echo site_url('account/edit/'.$value->id) ?>"><span class="glyphicon glyphicon-edit"></span></a>
                                        <a href="<?php echo site_url('balance/balance_check_out/'.$value->id); ?>"><span class="glyphicon glyphicon-asterisk"></span></a>
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




    <!-- /. ROW -->
    <hr />
    <div class="row">
        <div class="col-md-12 col-sm-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    اطلاعات مالی
                    <div class="btn-group pull-left">
                        <select id="filter2">
                            <option value="debit">debit</option>
                            <option value="credit">credit</option>
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

                                <th>تغییرات</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach ($all_debit_credit as $key => $cash_value) {
                                ?>
                                <tr class="odd gradeX">
                                    <td><?php  echo $cash_value->id;?></td>
                                    <td><?php  echo $cash_value->date;?></td>
                                    <td><?php  echo $cash_value->cash;?></td>
                                    <td class="center"><?php
                                        if($cash_value->type=="check"){
                                            ?>
                                            <button data-toggle="modal" data-target="#view-modal" data-id="<?php echo $cash_value->id; ?>" id="getUser" class="btn btn-sm btn-info">
                                                <i class="glyphicon glyphicon-eye-open"></i> چک</button>
                                            <?php
                                            // echo "<span style='cursor: pointer' onclick='get_check_info(".$cash_value->id.")'>".$cash_value->type."</span>";
                                        }else{
                                           // echo $cash_value->type;
                                            echo "پول نقد";
                                        }
                                        ?></td>
                                    <td class="center"><?php
                                        switch ($cash_value->transaction_type){
                                            case "credit";
                                                echo "رسیدگی";
                                                break;
                                            case "debit";
                                                echo "بردگی";
                                                break;
                                        }
                                        ;?></td>

                                    <td class="center">
                                        <a href="<?php echo site_url('account/delete/'.$value->id) ?>"><span class="glyphicon glyphicon-trash"></span></a>
                                        <a href="<?php echo site_url('account/edit/'.$value->id) ?>"><span class="glyphicon glyphicon-edit"></span></a>
                                        <a href="<?php echo site_url('balance/balance_check_out/'.$value->id); ?>"><span class="glyphicon glyphicon-asterisk"></span></a>
                                    </td>
                                </tr>
                            <?php  }?>
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
                    اطلاعات خرید و فروش تیل
                </div>
                <div class="panel-body">
                        <div class="tab-pane fade active in" id="prebuy">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example1">
                                    <thead>
                                    <tr>
                                        <th>کد</th>
                                        <th>تاریخ پیش فروش</th>
                                        <th>تاریخ تقریبی تحویل</th>
                                        <th>نام مشتری</th>
                                        <th>نوغ تیل</th>
                                        <th>تناژ</th>
                                        <th>تعداد موتر</th>
                                        <th>فی</th>
                                        <th>تغییرات</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    foreach ($buy_rows as $key => $value) {?>

                                        <tr class="odd gradeX">
                                            <td><?php echo $value->id;?></td>
                                            <td><?php echo $value->f_date;?></td>
                                            <td><?php echo $value->s_date;?></td>
                                            <td class="center"><?php
                                                $this->load->model('account_model');
                                                echo $this->account_model->get_where_column(array('id'=>$value->buyer_seller_id),'name');
                                                echo " - ";
                                                echo $this->account_model->get_where_column(array('id'=>$value->buyer_seller_id),'lname');
                                                ?></td>
                                            <td class="center"><?php
                                                $this->load->model('stock_model');
                                                echo $this->stock_model->get_where_column(array('id'=>$value->stock_id),'oil_type');
                                                ?></td>
                                            <td class="center">
                                                <?php

                                                if($value->car_count!='0') {
                                                    echo $value->car_count*$value->amount;
                                                }else{
                                                    echo $remain=$value->amount;
                                                }
                                                ?>
                                            </td>
                                            <td class="center"><?php echo $value->car_count;?></td>
                                            <td class="center"><?php echo $value->unit_price;?></td>
                                            <td class="center">
                                                <a href="<?php echo site_url('account/delete/'.$value->id); ?>"><span class="glyphicon glyphicon-trash"></span></a>
                                                <a href="#"><span class="glyphicon glyphicon-edit"></span></a>
                                                <a href="<?php echo site_url('account/profile/'.$value->id); ?>"><span class="glyphicon glyphicon-asterisk"></span></a>
                                            </td>
                                        </tr>
                                    <?php  }?>
                                    </tbody>
                                </table>
                            </div>

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
        $('#dataTables-example1').dataTable();

    });


    $('#filter2').change( function() {
        var filtervalue = this.value;
        var table2= $('#dataTables-example2').dataTable();
        table2.fnFilter(filtervalue );
    });
</script>