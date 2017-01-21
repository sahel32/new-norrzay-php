<div class="row">
    <div class="col-md-12">
        <?php
        foreach ($stock_rows as $key => $t_value) {
            ?>

            <h2>گدام حقیقی</h2>
            <h5> نوع تیل در این گدام <?php echo $t_value->oil_type ?></h5>

        <?php }?>

    </div>
</div>
<!-- /. ROW  -->
<hr />
<!--<div class="row">
    <div class="col-md-12 col-sm-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                اطلاعات عمومی گدام

            </div>

            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" >
                        <thead>
                        <tr>
                            <th>کد</th>
                            <th>نام گدام</th>
                            <th>نوع تیل</th>
                            <th>موجودی تیل</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
/*
                        foreach ($stock_rows as $key => $s_value) {*/?>


                            <tr class="odd gradeX">
                                <td><?php /*echo $s_value->id;*/?></td>
                                <td><?php /*echo $s_value->name;*/?></td>
                                <td><?php /*echo $s_value->oil_type;*/?></td>
                                <?php
/*                               echo  $s_value->type;
                                if($s_value->type=="fact"){ */?>
                                    <td class="center"><?php
/*                                        $this->load->model('stock_model');
                                        echo  $this->stock_model->get_stock_balance_fact($s_value->id);

                                        */?> تن </td>
                                <?php /* }else{*/?>
                                    <td class="center"><?php
/*                                        $this->load->model('stock_model');
                                        echo  $this->stock_model->get_stock_balance($s_value->id,$s_value->type);
                                        */?></td>
                                <?php /*} */?>

                            </tr>
                        <?php /*}*/?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>-->
<!-- /. ROW -->


<div class="row">
    <div class="col-md-12 col-sm-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                اطلاعات تیل های موجود در این گدام
            </div>

            <div class="panel-body">

                <div class="tab-content">
                    <div class="panel-heading">
                       لیست خرید
                    </div>
                    <div id="buy-list">
                        <h4></h4>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                <tr>
                                    <th>کد</th>
                                    <th>کد پیش خرید</th>
                                    <th>تاریخ</th>
                                    <th>فروشنده</th>
                                    <th>نوع تیل</th>
                                    <th>تناژ</th>
                                    <th>فی</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php

                                foreach ($fact_oilbuy_rows as $key => $value) {?>
                                    <tr class="odd gradeX">
                                        <td><?php echo $value->id;?></td>
                                        <td><?php echo $value->parent_id;?></td>
                                        <td><?php echo $value->f_date;?></td>
                                        <td class="center"><?php
                                            $this->load->model('account_model');
                                            echo $this->account_model->get_name(array('id'=>$value->buyer_seller_id));
                                            echo " ";
                                            echo $this->account_model->get_where_column(array('id'=>$value->buyer_seller_id),'lname');
                                            ?></td>
                                        <td class="center"><?php
                                            $this->load->model('stock_model');
                                            echo $this->stock_model->get_where_column(array('id'=>$value->stock_id),'oil_type')
                                            ?></td>
                                        <td class="center">
                                            <?php echo $value->amount;?> تن
                                        </td>
                                        <td class="center"><?php
                                            $this->load->model('oil_model');
                                            echo  $this->oil_model->get_where_column(array('id'=>$value->parent_id),'unit_price');
                                            ?></td>

                                    </tr>
                                <?php }
                                ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="panel-heading">
                        لیست اضافه بار
                    </div>
                    <div  id="overload">
                        <h4></h4>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example1">
                                <thead>
                                <tr>
                                    <th>کد</th>
                                    <th>کد پیش خرید</th>
                                    <th>تاریخ</th>
                                    <th>فروشنده</th>
                                    <th>درایور (راننده)</th>
                                    <th>ترانزیت (نمبر موتر)</th>
                                    <th>اضافه بار</th>
                                    <th>مبلغ</th>

                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                foreach ($driver_oil_rows as $key => $value) {?>
                                    <tr class="odd gradeX">
                                        <td><?php echo $value->id;?></td>
                                        <td><?php echo $value->parent_id;?></td>
                                        <td></td>
                                        <td class="center"><?php
                                            $this->load->model('account_model');
                                            echo $this->account_model->get_name(array('id'=>$value->buyer_seller_id));
                                            ?>
                                        </td>
                                        <td class="center"><?php echo $this->account_model->get_name(array('id'=>$value->driver_id));?></td>
                                        <td class="center"><?php echo $value->transit;?></td>
                                        <td class="center">
                                            <?php echo $value->amount;?>
                                        </td>
                                        <td class="center"><?php
                                            $this->load->model('oil_model');
                                            echo $value->amount
                                                *
                                                $this->oil_model->get_where_column(array('id'=>$value->parent_id),'unit_price');
                                            ?> تومان </td>

                                    </tr>
                                <?php }?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="panel-heading">
                        لیست فروش

                    </div>
                    <div  id="sell-list">
                        <h4></h4>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example2">
                                <thead>
                                <tr>
                                    <th>کد</th>
                                    <th>کد پیش فروش</th>
                                    <th>تاریخ</th>
                                    <th>خریدار</th>
                                    <th>نوع تیل</th>
                                    <th>تناژ</th>
                                    <th>فی</th>

                                </tr>
                                </thead>
                                <tbody>
                                <?php

                                foreach ($fact_oilsell_rows as $key => $value) {?>
                                    <tr class="odd gradeX">
                                        <td><?php echo $value->id;?></td>
                                        <td><?php echo $value->parent_id;?></td>
                                        <td><?php echo $value->f_date;?></td>
                                        <td class="center"><?php
                                            $this->load->model('account_model');
                                            echo $this->account_model->get_name(array('id'=>$value->buyer_seller_id));
                                            echo " ";
                                            echo $this->account_model->get_where_column(array('id'=>$value->buyer_seller_id),'lname');
                                            ?></td>
                                        <td class="center"><?php
                                            $this->load->model('stock_model');
                                            echo $this->stock_model->get_where_column(array('id'=>$value->stock_id),'oil_type')
                                            ?></td>
                                        <td class="center">
                                            <?php echo $value->amount;?> تن
                                        </td>
                                        <td class="center"><?php
                                            $this->load->model('oil_model');
                                            echo  $this->oil_model->get_where_column(array('id'=>$value->parent_id),'unit_price');
                                            ?></td>

                                    </tr>
                                <?php }
                                ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="panel-heading">
                       لیست تیل های انتقالی
                    </div>
                    <div  id="transfer-list">
                        <h4></h4>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example3">
                                <thead>
                                <tr>
                                    <th>کد</th>
                                    <th>تاریخ</th>
                                    <th>گدام مبدا</th>
                                    <th>گدام مقصد</th>
                                    <th>نوع تیل</th>
                                    <th>تناژ</th>
                                    <th>درایور (راننده)</th>
                                    <th>شرح و تفصیلات</th>

                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                foreach ($transfer_in as $key => $value) {?>
                                    <tr class="odd gradeX">
                                        <td><?php echo $value->id;?></td>
                                        <td class="center">
                                            <?php echo $value->f_date;?>
                                        </td>
                                        <td><?php
                                            $this->load->model('stock_model');
                                            echo $this->stock_model->get_where_column(array('id'=>$value->stock_id),'name');
                                            ?>
                                        </td>
                                        <td><?php
                                            echo $this->stock_model->get_where_column(array('id'=>$value->stock),'name');
                                            ?></td>
                                        <td class="center"><?php
                                            echo $this->stock_model->get_where_column(array('id'=>$value->stock_id),'oil_type');
                                            ?></td>
                                        <td class="center">
                                            <?php echo $value->amount;?>
                                        </td>
                                        <td><?php
                                            $this->load->model('stock_model');
                                            $this->load->model('driver_model');
                                            echo $account_id= $this->driver_model->get_where_column(array('st_id'=>$value->id),'name');
                                            // echo $this->account_model->get_where_column(array('id'=>$account_id),'name');
                                            ?>
                                        </td>
                                        <td class="center"><?php echo $value->unit_price;?></td>

                                    </tr>
                                <?php }?>
                                <?php
                                foreach ($transfer_out as $key => $value) {?>
                                    <tr class="odd gradeX">
                                        <td><?php echo $value->id;?></td>
                                        <td class="center">
                                            <?php echo $value->f_date;?>
                                        </td>
                                        <td><?php
                                            $this->load->model('stock_model');
                                            echo $this->stock_model->get_where_column(array('id'=>$value->stock_id),'name');
                                            ?>
                                        </td>
                                        <td><?php
                                            echo $this->stock_model->get_where_column(array('id'=>$value->stock),'name');
                                            ?></td>
                                        <td class="center"><?php
                                            echo $this->stock_model->get_where_column(array('id'=>$value->stock_id),'oil_type');
                                            ?></td>
                                        <td class="center">
                                            <?php echo $value->amount;?>
                                        </td>
                                        <td><?php
                                            $this->load->model('stock_model');
                                            $this->load->model('driver_model');
                                            echo $account_id= $this->driver_model->get_where_column(array('st_id'=>$value->id),'name');
                                            // echo $this->account_model->get_where_column(array('id'=>$account_id),'name');
                                            ?>
                                        </td>
                                        <td class="center"><?php echo $value->unit_price;?></td>
                                    </tr>
                                <?php }?>
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
<!-- /. PAGE INNER  -->
<script>
    $("span").tooltip();
</script>