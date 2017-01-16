<?php $this->load->view('check/ajax_get_check_info'); ?>
<div id="page-inner">
    <div class="row">
        <div class="col-md-12">
            <h2>بردگی و رسیدگی فروشنده ها</h2>
            <h5>در این قسمت شما میتوانید تمام اطلاعات مربوط به بردگی و رسیدگی فروشنده مورد نظر را مشاهده کنید.</h5>
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
                                <th>بیلانس</th>
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
                                    <?php    foreach ($single_balance_rows as $bkey => $bvalue) {?><?php }?>
                                    <!--<td class="center"><?php /*echo (isset($bvalue->debit))? $bvalue->debit : "";*/?></td>
                                    <td class="center"><?php /*echo (isset($bvalue->credit))? $bvalue->credit : "";*/?></td>-->
                                    <td class="center"><?php echo (isset($bvalue->balance))? $bvalue->balance : "";?>
                                        <span class="glyphicon glyphicon-usd"></span>
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
                    لیست رسیدگی ها
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example2">
                            <thead>
                                <tr>
                                    <th>تاریخ</th>
                                    <th>مبلغ</th>
                                    <th>نوع دریافت / پرداخت</th>
                                    <th>نوع پول</th>
                                    <th class="fix-check">کد چک</th>
                                    <th class="fix-check">صادر کننده</th>

                                    <th>تناژ</th>
                                    <th>نوع تیل</th>
                                    <th>فی تن</th>
                                    <th>شرح و تفصیلات</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            $cash=0;
                            $amount=0;
                            foreach ($all_debit_credit as $key => $cash_value) {

                                ?>
                                <tr class="odd gradeX">
                                    <td><?php  echo $cash_value->date;?></td>
                                    <td><?php  echo $cash+=$cash_value->cash;?></td>
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
                                    <td>
                                        <?php
                                        $this->load->model("oil_model");
                                        echo $amount+=$this->oil_model->get_where_column(array('id'=>$cash_value->table_id),'amount');
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        $this->load->model("stock_model");
                                        $stock_id=$this->oil_model->get_where_column(array('id'=>$cash_value->table_id),'stock_id');
                                        echo $this->stock_model->get_where_column(array('id'=>$stock_id),'oil_type');
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        $this->load->model("oil_model");
                                        echo $this->oil_model->get_where_column(array('id'=>$cash_value->table_id),'unit_price');
                                        ?>
                                    </td>
                                        <td></td>
                                </tr>
                            <?php  }?>
                            </tbody>
                            <thead>
                            <tr>
                                <th colspan="1"></th>
                                <th>مبلغ کل</th>
                                <th colspan="2"></th>
                                <th>جمع کل تناژ</th>
                                <td colspan="3"></td>
                            </tr>
                            </thead>
                            <tbody>
                            
                                <tr class="odd gradeX">
                                    <td colspan="1"></td>
                                    <td><?php echo $cash; ?><span class="glyphicon glyphicon-usd"></span></td>
                                    <td colspan="2"></td>
                                    <td> <?php echo $amount; ?> تن</td>
                                    <td colspan="3"></td>
                                </tr>
                            
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
                        <div class="tab-pane fade active in" id="prebuy">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example1">
                                    <thead>
                                    <tr>
                                        <th>تاریخ</th>
                                        <th>مبلغ</th>
                                        <th>نوع دریافت / پرداخت</th>
                                        <th class="fix-check">کد چک</th>
                                        <th class="fix-check">صادر کننده</th>
                                        <th>شرح و تفصیلات</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    foreach ($buy_rows as $key => $value) {?>

                                        <tr class="odd gradeX">
                                            <td><?php echo $value->id;?></td>
                                            <td><?php echo $value->f_date;?></td>
                                            <td><?php echo $value->s_date;?></td>
                                            <td class="fix-check"></td>
                                            <td class="fix-check"></td>
                                            <td class="center"><?php
                                                $this->load->model('account_model');
                                                echo $this->account_model->get_where_column(array('id'=>$value->buyer_seller_id),'name');
                                                echo " - ";
                                                echo $this->account_model->get_where_column(array('id'=>$value->buyer_seller_id),'lname');
                                                ?>
                                            </td>
                                        </tr>
                                    <?php  }?>
                                    </tbody>
                                    <thead>
                                        <tr>
                                            <th colspan="1"></th>
                                            <th>مبلغ کل</th>
                                            <th colspan="2"></th>
                                            <th colspan="2" class="fix-check"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                        <tr class="odd gradeX">
                                            <td colspan="1"></td>
                                            <td><span class="glyphicon glyphicon-usd"></span></td>
                                            <td colspan="2"></td>
                                            <td colspan="2" class="fix-check"></td>
                                        </tr>
                                    
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