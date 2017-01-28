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

                            </tr>
                            </thead>
                            <tbody>
                                <?php

                                foreach ($account_rows as $key => $value) {?>
                                    <tr class="odd gradeX">
                                        <td><?php echo $value->name;?></td>
                                        <td><?php echo $value->lname;?></td>
                                        <td><?php echo $value->phone;?></td>

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

                    اطلاعات عمومی

                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                            <tr>
                                <th>کد</th>

                                <th>نوع پول</th>
                                <!-- <th>رسیدگی</th>
                                 <th>بردگی</th>-->
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
                                    $all=$this->cash_model->get_balance_credit_debit_mylti_money_date(
                                        array(
                                            'account_id'=>$type_value->account_id,
                                            'type'=>$type_value->type,
                                            'firstdate'=>$firstdate,
                                            'seconddate'=>$seconddate
                                        ));
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

                                            <!--<td class="center"><?php /*echo $value->debit;*/?></td>
                                    <td class="center"><?php /*echo $value->credit;*/?></td>-->
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
                                foreach ($all_credit as $key => $cash_value) {
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
                                            $cash_value->desc;
                                            ?></td>
                                    </tr>
                                <?php }
                            ?>
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
                                foreach ($all_debit as $key => $cash_value) {
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
                                            $cash_value->desc; ?>
                                        </td>
                                    </tr>
                                <?php }
                            ?>
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
