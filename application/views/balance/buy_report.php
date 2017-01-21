
<?php $this->load->view('oil/ajax_prebuy_to_fact'); ?>
<div class="row">
    <div class="col-md-12">
        <h2>پیش خرید ها</h2>
        <h5>در جدول پایین شما میتوانید لیست پیش خرید های تیل را مشاهده کنید.</h5>
    </div>
</div>
<!-- /. ROW  -->
<hr />
<div class="row">
    <div class="col-md-12">
        <!-- Advanced Tables -->
        <div class="panel panel-default">
            <div class="panel-heading">
                لیست پیش خرید ها
            </div>
            <div class="panel-body">
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
                                    // echo $this->account_model->get_name(array('id'=>$value->buyer_seller_id));
                                    echo $value->first_hand;
                                    // echo $this->account_model->get_where_column(array('id'=>$value->buyer_seller_id),'lname');
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
        </div>
        <!--End Advanced Tables -->
    </div>
</div>
<!-- /. ROW  -->
</div>
<!-- /. PAGE INNER  -->


