<div class="row">
    <div class="col-md-12">
        <h2><?php echo $main_title;?></h2>
        <h5><?php echo $desc;?></h5>
    </div>
</div>
<!-- /. ROW  -->
<hr />
<div class="row">
    <div class="col-md-12 col-sm-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                <?php echo $sub_title;?>

            </div>

            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" >
                        <thead>
                        <tr>
                            <th>کد</th>
                            <th>نام گدام</th>
                            <th>ادرس</th>

                            <th>تیل موجودی</th>
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
                                <td><?php echo $s_value->province;?></td>

                                    <td class="center"><?php
                                        $this->load->model('stock_model');
                                        echo  $this->stock_model->get_stock_balance_pre_buy($s_value->id, $s_value->type);

                                        ?></td>

                                <td class="center"><?php echo $s_value->type;?></td>
                                <td class="center">
                                    <a href="#"><span class="glyphicon glyphicon-trash"></span></a>
                                    <a href="#"><span class="glyphicon glyphicon-edit"></span></a>
                                
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
                    تیل های پیش خرید شده
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


                                <th>نام فروشنده</th>
                                <th>نوغ تیل</th>
                                <th>حالت تیل</th>
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
                                        ?></td>
                                    <td class="center"><?php echo $value->name;?></td>
                                    <td class="center"><?php echo $value->type;?></td>
                                    <td class="center">
                                        <?php
                                        $this->load->model('oil_model');
                                        echo $this->oil_model->get_remain_oil_each_pre($value->id,$value->buy_sell);
                                        ?>
                                    </td>
                                    <td class="center"><?php echo $value->car_count;?></td>
                                    <td class="center"><?php echo $value->unit_price;?></td>
                                    <td class="center">
                                        <a href="<?php echo site_url('account/delete/'.$value->id) ?>"><span class="glyphicon glyphicon-trash"></span></a>
                                        <a href="<?php echo site_url('account/edit/'.$value->id) ?>"><span class="glyphicon glyphicon-edit"></span></a>
                                        <a href="<?php echo site_url('account/profile/'.$value->id); ?>"><span class="glyphicon glyphicon-asterisk"></span></a>
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