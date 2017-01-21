<div id="page-inner">
    <div class="row">
        <div class="col-md-12">
            <h2>فاکتور تیل</h2>
            <h5>در این قسمت شما میتوانید تمام اطلاعات مربوط به فاکتور تیل مورد نظر را مشاهده کنید.</h5>
        </div>
    </div>
    <!-- /. ROW  -->
    <hr />
    <div class="row">
        <div class="col-md-12">
            <!-- Advanced Tables -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    اطلاعات عمومی فاکتور
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                            <tr>
                                <th>کد</th>
                                <th>تاریخ</th>
                                <th>نام مشتری</th>
                                <th>نوع تیل</th>
                                <th>نوع فاکتور</th>
                                <th>تناژ</th>
                                <th>الباقی (تناژ)</th>
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
                                    <td></td>
                                    <td class="center">
                                        <?php

                                        if($value->car_count!='0') {
                                            echo $value->car_count*$value->amount;
                                        }else{
                                            echo $remain=$value->amount;
                                        }
                                        ?> تن 
                                    </td>
                                    <td class="center"><?php echo $value->car_count;?> تن </td>
                                    <td class="center"><?php echo $value->unit_price;?>
                                        <span class="glyphicon glyphicon-usd"></span>
                                    </td>
                                    <td class="center">
                                        <a href="<?php echo site_url('account/delete/'.$value->id) ?>"><span class="glyphicon glyphicon-trash" data-toggle="tooltip" title="حذف" data-placement="top"></span></a>
                                        <a href="<?php echo site_url('account/edit/'.$value->id) ?>"><span class="glyphicon glyphicon-edit" data-toggle="tooltip" title="ویرایش" data-placement="top"></span></a>

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
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example2">
                            <thead>
                            <tr>
                                <th>کد</th>
                                <th>تاریخ</th>
                                <th>تناژ</th>
                                <th>مبلغ</th>
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
                                    <td><?php  echo $cash_value->amount;?> تن </td>
                                    <td class="center"><?php  echo $cash_value->cash;?>
                                        <span class="glyphicon glyphicon-usd"></span>
                                    </td>
                                    <td class="center">
                                        <a href="<?php echo site_url('account/delete/'.$cash_value->id) ?>"><span class="glyphicon glyphicon-trash" data-toggle="tooltip" title="حذف" data-placement="top"></span></a>
                                        <a href="<?php echo site_url('account/edit/'.$cash_value->id) ?>"><span class="glyphicon glyphicon-edit" data-toggle="tooltip" title="ویرایش" data-placement="top"></span></a>
                                    </td>
                                </tr>
                            <?php  }?>
                            </tbody>
                            <thead>
                            <tr>
                                <th colspan="2"></th>
                                <th colspan="1">جمع کل تناژ</th>
                                <th colspan="1">مبلغ کل</th>
                                <th colspan="1"></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach ($sum_details as $key => $value) {
                            ?>
                                <tr class="odd gradeX">
                                    <td colspan="2"></td>
                                    <td><?php  echo $value->sum_amount;?> تن </td>
                                    <td><?php  echo $value->sum_cash;?>
                                        <span class="glyphicon glyphicon-usd"></span>
                                    </td>
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
<script>
    $("span").tooltip();
</script>