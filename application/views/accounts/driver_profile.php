<div id="view-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">
                    <i class="glyphicon glyphicon-user"></i> User Profile
                </h4>
            </div>

            <div class="modal-body">
                <div id="modal-loader" style="display: none; text-align: center;">
                    <!-- ajax loader -->
                    <img src="<?php echo asset_url('img/ajax-loader.gif'); ?>">
                </div>

                <!-- mysql data will be load here -->
                <div id="dynamic-content"></div>
            </div>

        </div>
    </div>
</div>
<script>
    $(document).ready(function(){

        $(document).on('click', '#getUser', function(e){

            e.preventDefault();

            var uid = $(this).data('id'); // get id of clicked row

            $('#dynamic-content').html(''); // leave this div blank
            $('#modal-loader').show();      // load ajax loader on button click

            $.ajax({
                url: '<?php echo site_url('check/get_check_info/');?>'+uid,
                type: 'POST',
                data: 'id='+uid,
                dataType: 'html'
            })
                .done(function(data){
                    console.log(data);
                    $('#dynamic-content').html(''); // blank before load.
                    $('#dynamic-content').html(data); // load here
                    $('#modal-loader').hide(); // hide loader
                })
                .fail(function(){
                    $('#dynamic-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
                    $('#modal-loader').hide();
                });

        });
    });
</script>
<div id="page-inner">
    <div class="row">
        <div class="col-md-12">
            <h2>پروفایل راننده ها</h2>
            <h5>در این قسمت شما میتوانید تمام اطلاعات مربوط به راننده مورد نظر را مشاهده کنید.</h5>
        </div>
    </div>
    <!-- /. ROW  -->
    <hr />
    <div class="row">
        <div class="col-md-12 col-sm-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    اطلاعات عمومی
                    <a class="pull-left" href="<?php echo site_url('cash/profile_credit_debit/').$this->uri->segment('3')."/".$this->uri->segment('4');?>">
                        پرداخت/دریافت
                    </a>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                            <tr>
                                <th>کد</th>
                                <th>نام</th>
                                <th>تخلص</th>
                                <th>شماره تماس</th>
                                <th>تغییرات</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach ($account_rows as $key => $value) {
                                $this->load->model('cash_model');
                                $single_balance_rows=$this->cash_model->get_balance_credit_debit_single(array('account_id' => $value->id));

                                ?>
                                <tr class="odd gradeX">
                                    <td><?php echo $value->id;?></td>
                                    <td><?php echo $value->name;?></td>
                                    <td><?php echo $value->lname;?></td>
                                    <td><?php echo $value->phone;?></td>
                                    <!-- <?php    foreach ($single_balance_rows as $bkey => $bvalue) {?><?php }?> -->
                                   <!-- <td class="center"><?php /*echo (isset($bvalue->debit))? $bvalue->debit : "";*/?></td>-->
                                    <!-- <td class="center"><?php echo (isset($bvalue->credit))? $bvalue->credit : "";?></td> -->


                                    <td class="center">
                                        <!--<div data-toggle="modal" data-id="<?php /*echo $value->id;*/?>" data-target="#view-modal" id="getUser" class="glyphicon glyphicon-trash">
                                        </div>-->
                                        <a href="<?php echo site_url('account/edit/'.$value->id) ?>"><span class="glyphicon glyphicon-edit" data-toggle='tooltip' title='ویرایش' data-placement='top'></span></a>
                                        <?php echo ($value->status)?  "<a href='".site_url('account/inactive/'.$value->id.'')."'><span style='color:blue;' class='glyphicon glyphicon-ok-circle' data-toggle='tooltip' title='غیر فعال کردن راننده' data-placement='top'></span></a>" : "<a href='".site_url('account/active/'.$value->id.'')."'><span style='color: #f90c05;' class='glyphicon glyphicon-ban-circle' data-toggle='tooltip' title='فعال کردن راننده' data-placement='top'></span></a>"
                                        ; ?>
<!--                                        <a href="<?php /*echo site_url('balance/balance_check_out/'.$value->id); */?>"><span class="glyphicon glyphicon-asterisk"></span></a>
-->                                    </td>
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
                    اطلاعات مالی
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example2">
                            <thead>
                            <tr>
                                <th>شماره فاکتور</th>
                                <th>کد بار</th>
                                <th>تاریخ</th>
                                <th>مبلغ</th>
                                <th>نوع پول</th>
                                <th>نوع دریافت / پرداخت پول</th>
                                <th>توضیحات</th>
                                <th>تغییرات</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach ($all_debit_credit as $key => $cash_value) {
                                ?>
                                <tr class="odd gradeX">

                                    <td><?php  echo $cash_value->id;?></td>
                                    <td><?php  echo $cash_value->table_id;?></td>
                                    <td><?php  echo $cash_value->date;?></td>
                                    <td><?php  echo $cash_value->cash;?> تومان </td>
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
                                    <td><?php  echo $cash_value->desc;?></td>
                                    <td class="center">
                                        <a data-toggle="modal" data-target="#1myModal<?php echo $cash_value->id; ?>" href="#"><span class="glyphicon glyphicon-trash" data-toggle='tooltip' title='حذف' data-placement='top'></span></a>
                                        <!-- Modal -->
                                        <div class="modal fade" id="1myModal<?php echo $cash_value->id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                        <h4 class="modal-title" id="myModalLabel">هشدار برای حذف داده</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        ایا مطمن هستید که میخواهید حذف کنید؟
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">لغو</button>
                                                        <a type="button" class="btn btn-primary" href="<?php echo site_url('cash/driver_cash_delete/'.$cash_value->id) ?>" " >تایید</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <a href="<?php echo site_url('account/edit/'.$cash_value->id) ?>"><span class="glyphicon glyphicon-edit" data-toggle='tooltip' title='ویرایش' data-placement='top'></span></a>
                                    </td>
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
                   اطلاعات اضافه بار
                </div>
                <div class="panel-body">
                    <div >
                        <h4></h4>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example3">
                                <thead>
                                <tr>
                                    <th>کد بار</th>
                                    <th>تاریخ</th>
                                    <th>تناژ (اضافه بار)</th>
                                    <th>مشتری</th>
                                    <th>نوع تیل</th>
                                    <th>ناحیه تخلیه</th>
                                    <th>فروشنده دست اول</th>
                                    <th>نمبر موتر (ترانزیت)</th>
                                    <th>تغییرات</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php

                                foreach ($driver_oil_rows as $key => $value) {?>
                                    <tr class="odd gradeX">
                                        <td><?php echo $value->id;?></td>
                                        <td><?php echo $value->f_date;?></td>
                                        <td><?php echo $value->amount;?></td>
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
                                        <td class="center"><?php echo $value->first_hand;?></td>
                                        <td class="center"><?php echo $value->transit;?></td>
                                        <td class="center">
                                            <a href="<?php echo site_url('account/driver_oil_delete/'.$value->id) ?>"><span class="glyphicon glyphicon-trash" data-toggle='tooltip' title='حذف' data-placement='top'></span></a>
                                            <a href="<?php echo site_url('account/edit/'.$value->id) ?>"><span class="glyphicon glyphicon-edit" data-toggle='tooltip' title='ویرایش' data-placement='top'></span></a>
                                            <a href="<?php echo site_url('oil/profile/'.$value->parent_id.'/buy'); ?>"><span class="glyphicon glyphicon-tint" data-toggle="tooltip" title="مشاهده فاکتور" data-placement="top"></span></a>
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
    </div>
    <!-- /. ROW -->
</div>
<!-- /. PAGE INNER  -->
<script src="<?php echo asset_url('js/dataTables/jquery.dataTables.js'); ?>"></script>
<script src="<?php echo asset_url('js/dataTables/dataTables.bootstrap.js'); ?>"></script>

<script>
    $(document).ready(function () {
        $('#dataTables-example2').dataTable();

    });

    $(document).ready(function () {
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