<?php $this->load->view('stock/ajax_delete_review'); ?>
<div class="row">
    <div class="col-md-12">
        <?php
        foreach ($stock_rows as $key => $t_value) {
            ?>

            <h2>گدام غیر حقیقی </h2>
            <h5> نوع تیل در این گدام <?php echo $t_value->oil_type ?></h5>

        <?php }?>
    </div>
</div>
<!-- /. ROW  -->
<hr />
<div class="row">
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
                            <th>نوع گدام</th>
                            <th>تغییرات</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php

                        foreach ($stock_rows as $key => $s_value) {?>


                            <tr class="odd gradeX">
                                <td><?php echo $s_value->id;?></td>
                                <td><?php echo $s_value->name;?></td>
                                <td><?php echo $s_value->oil_type;?></td>

                                    <td class="center"> <?php
                                        $this->load->model('stock_model');
                                        echo  $this->stock_model->get_stock_balance_pre_buy($s_value->id, $s_value->type);

                                        ?> تن </td>

                                <td class="center"><?php echo $s_value->type;?></td>
                                <td class="center">
                                    <div data-toggle="modal" data-id="<?php echo $s_value->id;?>" data-target="#view-modal" id="getUser" class="glyphicon glyphicon-trash" data-toggle="tooltip" title="حذف" data-placement="top">
                                    </div>
                                    <a href="#"><span class="glyphicon glyphicon-edit" data-toggle="tooltip" title="ویرایش" data-placement="top"></span></a>
                                
                                </td>
                            </tr>
                        <?php }?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /. ROW -->
    <div class="row">
        <div class="col-md-12 col-sm-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    اطلاعات تیل های موجود در این گدام
                </div>

                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                            <tr>
                                <th>کد</th>
                                <th>نام فروشنده</th>
                                <th>نوع تیل</th>
                                <th>تناژ</th>
                                <th>تعداد موتر</th>
                                <th>فی</th>
                                <th>تغییرات</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php

                            foreach ($pre_oil_rows as $key => $value) {?>
                                <tr class="odd gradeX">
                                    <td><?php echo $value->id;?></td>
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
                                        <?php
                                        $this->load->model('oil_model');
                                        echo $this->oil_model->get_remain_oil_each_pre($value->id,$value->buy_sell);
                                        ?> تن
                                    </td>
                                    <td class="center"><?php echo $value->car_count;?></td>
                                    <td class="center"><?php echo $value->unit_price;?>
                                        <span class="glyphicon glyphicon-usd"></span>
                                    </td>
                                    <td class="center">
                                        <a href="<?php echo site_url('account/delete/'.$value->id) ?>"><span class="glyphicon glyphicon-trash" data-toggle="tooltip" title="حذف" data-placement="top"></span></a>
                                        <a href="<?php echo site_url('account/edit/'.$value->id) ?>"><span class="glyphicon glyphicon-edit" data-toggle="tooltip" title="ویرایش" data-placement="top"></span></a>
                                        <a href="<?php echo site_url('account/profile/'.$value->id); ?>"><span class="glyphicon glyphicon-tint" data-toggle="tooltip" title="مشاهده فاکتور" data-placement="top"></span></a>
                                    </td>
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
<!-- /. PAGE INNER  -->

<!-- /. PAGE INNER  -->
<script src="<?php echo asset_url('js/dataTables/jquery.dataTables.js'); ?>"></script>
<script src="<?php echo asset_url('js/dataTables/dataTables.bootstrap.js'); ?>"></script>

<script>
    $(document).ready(function () {
        $('#dataTables-example').dataTable();

    });

    $('#filter2').change( function() {
        var filtervalue = this.value;
        var table2= $('#dataTables-example2').dataTable();
        table2.fnFilter(filtervalue );
    });
</script>
<script>
    $("span").tooltip();
    $("div").tooltip();
</script>