<div id="page-inner">
    <div class="row">
        <div class="col-md-12">
            <h2>پروفایل تیل ها </h2>
            <h5>در این قسمت شما میتوانید تمام اطلاعات مربوط به خریدار و فروشنده مورد نظر را مشاهده کنید.</h5>
        </div>
    </div>
    <!-- /. ROW  -->
    <hr />
    <div class="row">
        <div class="col-md-12">
            <!-- Advanced Tables -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    لیست پیش فروش ها
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
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
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

                            foreach ($oil_row as $key => $value) {?>
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
                                        <a href="<?php echo site_url('account/delete/'.$value->id) ?>"><span class="glyphicon glyphicon-trash"></span></a>
                                        <a href="<?php echo site_url('account/edit/'.$value->id) ?>"><span class="glyphicon glyphicon-edit"></span></a>
                                        <a href="<?php echo site_url('oil/profile/'.$value->id); ?>"><span class="glyphicon glyphicon-asterisk"></span></a>
                                        <!--<span id="openpopup" style="cursor: pointer" onclick="popupp(<?php /*//echo $value->id.','.$remain.",'".$buy_sell."'"; */?>)" class="button">set to fact </span>
-->

                                        <button data-toggle="modal" data-target="#view-modal" data-remain="<?php echo $remain;?>" data-id="<?php echo $value->id;?>" id="getUser" class="btn btn-sm btn-info">
                                            <i class="glyphicon glyphicon-eye-open"></i> چک</button>
                                    </td>
                                </tr>

                            <?php  }?>

                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
            <!--End Advanced Tables -->
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
                                <th>مقدار تیل</th>
                                <th>مقدار پول</th>
                                <th>تغییرات</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach ($oil_details as $key => $cash_value) {
                                ?>
                                <tr class="odd gradeX">
                                    <td><?php  echo $cash_value->id;?></td>
                                    <td><?php  echo $cash_value->f_date;?></td>
                                    <td><?php  echo $cash_value->amount;?></td>

                                    <td class="center"><?php  echo $cash_value->cash;?></td>
                                    <td class="center">
                                        <a href="<?php echo site_url('account/delete/'.$cash_value->id) ?>"><span class="glyphicon glyphicon-trash"></span></a>
                                        <a href="<?php echo site_url('account/edit/'.$cash_value->id) ?>"><span class="glyphicon glyphicon-edit"></span></a>
                                        <a href="<?php echo site_url('account/profile/'.$cash_value->id); ?>"><span class="glyphicon glyphicon-asterisk"></span></a>
                                    </td>
                                </tr>
                            <?php  }?>
                            </tbody>
                            <thead>
                            <tr>
                                <th colspan="2"></th>
                                <th colspan="1">جمع کل تیل ها</th>
                                <th colspan="1">جمع کل پول ها</th>
                                <th colspan="1"></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach ($sum_details as $key => $value) {
                            ?>
                                <tr class="odd gradeX">
                                    <td colspan="2"></td>
                                    <td><?php  echo $value->sum_amount;?></td>
                                    <td><?php  echo $value->sum_cash;?></td>
                                    <td></td>
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
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example3">
                            <thead>
                            <tr>
                                <th>شماره فاکتور</th>
                                <th>تاریخ</th>
                                <th>مقدار پول</th>
                                <th>نوع پول</th>

                                <th>تغییرات</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach ($cash_details as $key => $cash_value) {
                                ?>
                                <tr class="odd gradeX">
                                    <td><?php  echo $cash_value->id;?></td>
                                    <td><?php  //echo $cash_value->f_date;?></td>
                                    <td><?php  echo $cash_value->cash;?></td>
                                    <td class="center"><?php  echo $cash_value->type;?></td>

                                    <td class="center">
                                        <a href="<?php echo site_url('account/delete/'.$cash_value->id) ?>"><span class="glyphicon glyphicon-trash"></span></a>
                                        <a href="<?php echo site_url('account/edit/'.$cash_value->id) ?>"><span class="glyphicon glyphicon-edit"></span></a>
                                        <a href="<?php echo site_url('account/profile/'.$cash_value->id); ?>"><span class="glyphicon glyphicon-asterisk"></span></a>
                                    </td>
                                </tr>
                            <?php  }?>
                            </tbody>
                            <thead>
                            <tr>
                                <th colspan="2"></th>
                                <th colspan="1">جمع کل پول ها</th>
                                <th colspan="1"></th>
                                <th colspan="1"></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach ($sum_cash as $key => $value) {
                                ?>
                                <tr class="odd gradeX">
                                    <td colspan="2"></td>
                                    <td><?php  echo $value->cash;?></td>
                                    <td></td>
                                    <td></td>
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

</div>
<!-- /. PAGE INNER  -->
<script src="<?php echo asset_url('js/dataTables/jquery.dataTables.js'); ?>"></script>
<script src="<?php echo asset_url('js/dataTables/dataTables.bootstrap.js'); ?>"></script>

<script>
    $(document).ready(function () {
        $('#dataTables-example2').dataTable();
        $('#dataTables-example3').dataTable();
    });


    $('#filter2').change( function() {
        var filtervalue = this.value;
        var table2= $('#dataTables-example2').dataTable();
        table2.fnFilter(filtervalue );
    });
</script>