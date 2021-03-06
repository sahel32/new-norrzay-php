
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
                            <th>تاریخ پیش خرید</th>
                            <th>تاریخ تقریبی رسید</th>
                            <th>نام فروشنده</th>
                            <th>نوع تیل</th>
                            <th>تناژ</th>
                            <th>تعداد موتر</th>
                            <th>فی</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php

                        foreach ($oil_rows as $key => $value) {?>
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

                                    /*if($value->car_count!='0') {
                                        echo $value->car_count*$value->amount;
                                    }else{
                                        echo $remain=$value->amount;
                                    }*/
                                    $this->load->model('oil_model');
                                    echo  $remain=$this->oil_model->get_remain_oil_each_pre($value->id,'buy');
                                    ?>
                                </td>
                                <td class="center"><?php echo $value->car_count;?></td>
                                <td class="center"><?php echo $value->unit_price;?></td>

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
<!-- /. ROW  -->
</div>
<!-- /. PAGE INNER  -->


