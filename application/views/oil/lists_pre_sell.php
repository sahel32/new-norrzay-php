
<?php $this->load->view('oil/ajax_presell_to_fact'); ?>
<div class="row">
    <div class="col-md-12">
        <h2>پیش فروش ها</h2>
        <h5>در جدول پایین شما میتوانید لیست پیش فروش های تیل را مشاهده کنید.</h5>
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
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                        <tr>
                            <th>کد</th>
                            <th>تاریخ پیش فروش</th>
                            <th>تاریخ تقریبی تحویل</th>
                            <th>نام خریدار</th>
                            <th>نوع تیل</th>
                            <th>تناژ</th>
                            <th>تعداد موتر</th>
                            <th>فی</th>
                            <th>تغییرات</th>
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
                                    $this->load->model('oil_model');
                                   echo  $remain=$this->oil_model->get_remain_oil_each_pre($value->id,'sell');
                                    ?> تن
                                </td>

                                <td class="center"><?php echo $value->car_count;?></td>
                                <td class="center"><?php echo $value->unit_price;?>
                                    <span class="glyphicon glyphicon-usd"></span>
                                </td>
                                <td class="center">
                                    <a href="<?php echo site_url('oil/pre_set_end/'.$value->id.'/sell') ?>"><span class="glyphicon glyphicon-trash" ata-toggle="tooltip" title="حذف" data-placement="top"></span></a>
                                    <a href="<?php echo site_url('oil/pre_buy/'.$value->id) ?>"><span class="glyphicon glyphicon-edit" data-toggle="tooltip" title="ویرایش" data-placement="top"></span></a>
                                    <a href="<?php echo site_url('oil/profile/'.$value->id.'/sell'); ?>"><span class="glyphicon glyphicon-tint" ata-toggle="tooltip" title="مشاهده فاکتور" data-placement="top"></span></a>
                                    <?php if($remain!=0){ ?>
                                    <a data-toggle="modal" data-target="#view-modal"  data-remain="<?php echo $remain;?>" data-id="<?php echo $value->id;?>" id="getUser">
                                        <span class="glyphicon glyphicon-shopping-cart" data-toggle="tooltip" title="مشاهده فورم ثبت فروش" data-placement="top"></span></a>
                                    <?php } ?>
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
<!-- /. ROW  -->
</div>
<!-- /. PAGE INNER  -->


<script src="<?php echo asset_url('js/dataTables/jquery.dataTables.js'); ?>"></script>
<script src="<?php echo asset_url('js/dataTables/dataTables.bootstrap.js'); ?>"></script>

<script>
    $(document).ready(function () {
        $('#dataTables-example').dataTable();
    });
</script>
<script>
    $("span").tooltip();
</script>
<!-- CUSTOM SCRIPTS -->
