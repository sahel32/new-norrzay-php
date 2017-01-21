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
            <h2>بردگی و رسیدگی درایورها</h2>
            <h5>در این قسمت شما میتوانید تمام اطلاعات مربوط به درایور (راننده) مورد نظر را مشاهده کنید.</h5>
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
                    اطلاعات مالی
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example2">
                            <thead>
                            <tr>
                                <th>تاریخ</th>
                                <th>نام مشتری</th>
                                <th>مبلغ</th>
                                <th> نوع پول</th>
                                <th>اضافه بار</th>
                                <th>نوع تیل</th>
                                <th>شرح و تفصیلات</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $cash=0;
                            $amount=0;
                            foreach ($all_credit as $key => $cash_value) {

                                ?>
                                <tr class="odd gradeX">
                                    <td><?php  echo $cash_value->date;?></td>
                                    <th>نام مشتری</th>
                                    <td><?php  echo $cashh=$cash_value->cash;
                                        $cash+=$cashh;?></td>
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
                                        $this->load->model("driver_model");
                                        $oil_id=$this->driver_model->get_where_column(array('id'=>$cash_value->table_id),'st_id');

                                        echo $amountt=$this->oil_model->get_where_column(array('id'=>$oil_id),'amount');
                                        $amount+=$amountt;
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        $this->load->model("stock_model");
                                        $oil_id=$this->driver_model->get_where_column(array('id'=>$cash_value->table_id),'st_id');

                                        $stock_id=$this->oil_model->get_where_column(array('id'=>$oil_id),'stock_id');

                                        echo $this->stock_model->get_where_column(array('id'=>$stock_id),'oil_type');
                                        ?>
                                    </td>

                                    <td>
                                        <?php echo $cash_value->desc; ?>
                                    </td>
                                </tr>
                            <?php  }?>
                            </tbody>
                            <thead>
                            <tr>
                                <th colspan="2"></th>
                                <th>مبلغ کل</th>
                                <th colspan="1"></th>
                                <th>جمع کل تناژ</th>
                                <td colspan="3"></td>
                            </tr>
                            </thead>
                            <tbody>

                            <tr class="odd gradeX">
                                <td colspan="2"></td>
                                <td><?php echo $cash; ?><span class="glyphicon glyphicon-usd"></span></td>
                                <td colspan="1"></td>
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
</div>
