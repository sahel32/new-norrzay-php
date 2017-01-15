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
                                <th>اضافه بار</th>
                                <th>نوع تیل</th>
                                <th>شرح و تفصیلات</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach ($all_debit_credit as $key => $cash_value) {
                                ?>
                                <tr class="odd gradeX">
                                    <td><?php  echo $cash_value->date;?></td>
                                    <td></td>
                                    <td><?php  echo $cash_value->cash;?></td>
                                    <td></td>
                                    <td></td>
                                    <td class="center"></td>
                                </tr>
                            <?php  }?>
                            </tbody>
                            <thead>
                                <tr>
                                    <th colspan="2"></th>
                                    <th>مبلغ کل</th>
                                    <th colspan="3"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="2"></td>
                                    <td> IRN </td>
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