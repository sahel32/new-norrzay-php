<?php $this->load->view('check/ajax_get_check_info');

?>
<div id="page-inner">
    <div class="row">
        <div class="col-md-12">
            <h2>پروفایل مشتری ها </h2>
            <h5>در این قسمت شما میتوانید تمام اطلاعات مربوط به خریدار و فروشنده مورد نظر را مشاهده کنید.</h5>
        </div>
    </div>
    <!-- /. ROW  -->
<hr/>
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
                                <!--<th>بردگی</th>
                                <th>رسیدگی</th>-->
                                <th>بیلانس (الباقی)</th>
                                <th>تغییرات</th>
                                <th>وضعیت</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach ($account_rows as $key => $value) {
                                $this->load->model('cash_model');
                                $single_balance_rows=$this->cash_model->get_balance_credit_debit_single(array('account_id' => $value->id));
                                ?>
                                <tr class="odd gradeX">
                                    <td><?php echo $value->id;?></td>
                                    <td><?php echo $value->name;?></td>
                                    <td><?php echo $value->lname;?></td>
                                    <td><?php echo $value->phone;?></td>
                                    <?php    foreach ($single_balance_rows as $bkey => $bvalue) {?><?php }?>
                                   <!-- <td class="center"><?php /*echo (isset($bvalue->debit))? $bvalue->debit : "";*/?></td>
                                    <td class="center"><?php /*echo (isset($bvalue->credit))? $bvalue->credit : "";*/?></td>-->
                                    <td class="center"><?php echo (isset($bvalue->balance))? $bvalue->balance : "";?></td>
                                    <td class="center">
                                        <a href="<?php echo site_url('account/delete/'.$value->id) ?>"><span class="glyphicon glyphicon-trash"></span></a>
                                        <a href="<?php echo site_url('account/edit/'.$value->id) ?>"><span class="glyphicon glyphicon-edit"></span></a>
<!--                                        <a href="<?php /*echo site_url('balance/balance_check_out/'.$value->id); */?>"><span class="glyphicon glyphicon-asterisk"></span></a>
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
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example1">
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
                                        <a href="<?php echo site_url('account/delete_cash/'.$cash_value->id) ?>"><span class="glyphicon glyphicon-trash"></span></a>
                                        <a href="<?php echo site_url('account/edit/'.$value->id) ?>"><span class="glyphicon glyphicon-edit"></span></a>
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
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#buy" data-toggle="tab">خرید</a></li>
                        <li class=""><a href="#sell" data-toggle="tab">فروش</a></li>
                        <li class=""><a href="#prebuy" data-toggle="tab">پیش خرید</a></li>
                        <li class=""><a href="#presell" data-toggle="tab">پیش فروش</a></li>


                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane fade active in" id="buy">
                            <h4></h4>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example2">
                                    <thead>
                                    <tr>
                                        <th>کد</th>
                                        <th>تاریخ</th>
                                        <th>تاریخ تحویل</th>
                                        <th>تعداد موتر</th>
                                        <th>مقدار تیل (تناژ)</th>
                                        <th>نوع تیل</th>
                                        <th>فی تن</th>
                                        <th>موارد بیشتر</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    foreach ($buy_rows as $key => $value) {?>

                                        <tr class="odd gradeX">
                                            <td><?php echo $value->id; ?></td>
                                            <td><?php echo $value->f_date; ?></td>
                                            <td><?php echo $value->s_date; ?></td>
                                            <td class="center"><?php echo $value->car_count; ?></td>
                                            <td class="center"><?php echo $value->amount; ?></td>
                                            <td class="center"><?php echo $value->name; ?></td>
                                            <td class="center"><?php echo $value->unit_price; ?></td>
                                            <td class="center">
                                                <a href="<?php echo site_url('stock/fact_oil_delete/'.$value->id) ?>"><span class="glyphicon glyphicon-trash"></span></a>
                                                <a href="#"><span class="glyphicon glyphicon-edit"></span></a>
                                                <a href="<?php echo site_url('account/profile/'.$value->id); ?>"><span class="glyphicon glyphicon-asterisk"></span></a>
                                            </td>
                                        </tr>
                                    <?php  }?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade " id="sell">
                            <h4></h4>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example3">
                                    <thead>
                                    <tr>
                                        <th>کد</th>
                                        <th>تاریخ</th>
                                        <th>تاریخ تحویل</th>
                                        <th>تعداد موتر</th>
                                        <th>مقدار تیل (تناژ)</th>
                                        <th>نوع تیل</th>
                                        <th>فی تن</th>
                                        <th>موارد بیشتر</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    foreach ($sell_rows as $key => $value) {?>

                                        <tr class="odd gradeX">
                                            <td><?php echo $value->id; ?></td>
                                            <td><?php echo $value->f_date; ?></td>
                                            <td><?php echo $value->s_date; ?></td>
                                            <td class="center"><?php echo $value->car_count; ?></td>
                                            <td class="center"><?php echo $value->amount; ?></td>
                                            <td class="center"><?php echo $value->name; ?></td>
                                            <td class="center"><?php echo $value->unit_price; ?></td>
                                            <td class="center">
                                                <a href="<?php echo site_url('stock/fact_oil_delete/'.$value->id) ?>"><span class="glyphicon glyphicon-trash"></span></a>
                                                <a href="#"><span class="glyphicon glyphicon-edit"></span></a>
                                                <a href="<?php echo site_url('account/profile/'.$value->id); ?>"><span class="glyphicon glyphicon-asterisk"></span></a>
                                            </td>
                                        </tr>
                                    <?php  }?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade " id="prebuy">
                            <h4></h4>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example4">
                                    <thead>
                                    <tr>
                                        <th>کد</th>
                                        <th>تاریخ</th>
                                        <th>تاریخ تحویل</th>
                                        <th>تعداد موتر</th>
                                        <th>مقدار تیل (تناژ)</th>
                                        <th>نوع تیل</th>
                                        <th>فی تن</th>
                                        <th>موارد بیشتر</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    foreach ($pre_buy_rows as $key => $value) {?>

                                        <tr class="odd gradeX">
                                            <td><?php echo $value->id; ?></td>
                                            <td><?php echo $value->f_date; ?></td>
                                            <td><?php echo $value->s_date; ?></td>
                                            <td class="center"><?php echo $value->car_count; ?></td>
                                            <td class="center"><?php echo $value->amount; ?></td>
                                            <td class="center"><?php echo $value->name; ?></td>
                                            <td class="center"><?php echo $value->unit_price; ?></td>
                                            <td class="center">
                                                <a href="<?php echo site_url('stock/fact_oil_delete/'.$value->id) ?>"><span class="glyphicon glyphicon-trash"></span></a>
                                                <a href="#"><span class="glyphicon glyphicon-edit"></span></a>
                                                <a href="<?php echo site_url('oil/profile/'.$value->id.'/buy'); ?>"><span class="glyphicon glyphicon-asterisk"></span></a>
                                        </tr>
                                    <?php  }?>
                                    </tbody>
                                </table>
                            </div>

                            <div class="tab-pane fade" id="moreinfo2">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                        <thead>
                                        <tr>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr class="odd gradeX">
                                            <td class="center">4</td>
                                            <td>Trident</td>
                                            <td>Internet Explorer 4.0</td>
                                            <td>Win 95+</td>
                                            <td class="center">4</td>
                                            <td class="center">X</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                        <div class="tab-pane fade " id="presell">
                            <h4></h4>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example5">
                                    <thead>
                                    <tr>
                                        <th>کد</th>
                                        <th>تاریخ</th>
                                        <th>تاریخ تحویل</th>
                                        <th>تعداد موتر</th>
                                        <th>مقدار تیل (تناژ)</th>
                                        <th>نوع تیل</th>
                                        <th>فی تن</th>
                                        <th>موارد بیشتر</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    foreach ($pre_sell_rows as $key => $value) {?>

                                        <tr class="odd gradeX">
                                            <td><?php echo $value->id; ?></td>
                                            <td><?php echo $value->f_date; ?></td>
                                            <td><?php echo $value->s_date; ?></td>
                                            <td class="center"><?php echo $value->car_count; ?></td>
                                            <td class="center"><?php echo $value->amount; ?></td>
                                            <td class="center"><?php echo $value->name; ?></td>
                                            <td class="center"><?php echo $value->unit_price; ?></td>
                                            <td class="center">
                                                <a href="<?php echo site_url('account/delete/'.$value->id); ?>"><span class="glyphicon glyphicon-trash"></span></a>
                                                <a href="#"><span class="glyphicon glyphicon-edit"></span></a>
                                                <a href="<?php echo site_url('oil/profile/'.$value->id.'/sell'); ?>"><span class="glyphicon glyphicon-asterisk"></span></a>
                                            </td>
                                        </tr>
                                    <?php  }?>
                                    </tbody>
                                </table>
                            </div>

                            <div class="tab-pane fade" id="moreinfo2">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                        <thead>
                                        <tr>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr class="odd gradeX">
                                            <td class="center">4</td>
                                            <td>Trident</td>
                                            <td>Internet Explorer 4.0</td>
                                            <td>Win 95+</td>
                                            <td class="center">4</td>
                                            <td class="center">X</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

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
        $('#dataTables-example1').dataTable();
        $('#dataTables-example2').dataTable();
        $('#dataTables-example3').dataTable();
        $('#dataTables-example4').dataTable();
        $('#dataTables-example5').dataTable();

    });


    $('#filter2').change( function() {
        var filtervalue = this.value;
        var table2= $('#dataTables-example2').dataTable();
        table2.fnFilter(filtervalue );
    });
</script>