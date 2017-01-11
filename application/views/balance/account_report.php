
<link href="<?php echo asset_url('js/bootstrap-datepicker/css/bootstrap.min.css'); ?>" rel="stylesheet" type="text/css" >
<link href="<?php echo asset_url('js/bootstrap-datepicker/bootstrap-datepicker.min.css'); ?>" rel="stylesheet" type="text/css" >

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<script src="<?php echo asset_url('js/bootstrap-datepicker/bootstrap-datepicker.min.js'); ?>"></script>
<script src="<?php echo asset_url('js/bootstrap-datepicker/bootstrap-datepicker.fa.min.js'); ?>"></script>

<script type="text/javascript">
    $(function(){
        $("#datepicker").datepicker({
            dateFormat: "yy/mm/dd",
            showOtherMonths: true,
            selectOtherMonths: true
        });
        $("#datepicker1").datepicker({
            dateFormat: "yy/mm/dd"
        });
    });
</script>
<?php $this->load->view('balance/ajax_account_report'); ?>

<div id="page-inner">
    <div class="row">
        <div class="col-md-12">
            <h2>گرفتن یک کلی </h2>
            <h5>در این قسمت شما میتوانید تمام اطلاعات مربوط به خریدار و فروشنده مورد نظر را مشاهده کنید.</h5>
        </div>
    </div>
    <!-- /. ROW  -->
    <hr/>
    <div class="row">
        <div class="col-md-12">
            <!-- Form Elements -->
            <div class="panel panel-default">


                <div class="panel-heading">
                    بالانس گیری جید یا نمایش اخرین بالانس
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form action="<?php echo site_url('balance/account_report'); ?>" method="post">
                                 <div class="col-md-3 form-group">
                                     <lable>از این تاریخ</lable>
                                     <input type="text"  value="<?php echo set_value('firstdate'); ?>"name="firstdate" class="form-control" id="datepicker" />
                                     <span class="help-inline"><?php echo (form_error('firstdate') ) ? form_error('firstdate') : "<span class='red'>*</span>"; ?></span>

                                 </div>
                                <div class="col-md-3 form-group">
                                    <lable>الی تاریخ</lable>
                                    <input type="text"  value="<?php echo set_value('seconddate'); ?>"id="datepicker1" name="seconddate" class="form-control"/>
                                    <span class="help-inline"><?php echo (form_error('seconddate') ) ? form_error('seconddate') : "<span class='red'>*</span>"; ?></span>

                                </div>
                                <div class="col-md-3 form-group">
                                    <label>گزراش از :</label>
                                    <select class="form-control" name="type" id="load-accounts">
                                        <option>انتخاب از بیست</option>
                                        <option value="stock">گدام ها</option>
                                        <option value="prebuy">تیل های پیش خرید</option>
                                        <option value="presell">تیل های پیش فروش</option>
                                        <option value="sell">تیل های فروخته شده</option>
                                        <option value="buy">تیل های خریداری شده</option>
                                        <option value="account">حساب ها</option>
                                    </select>
                                </div>
                                <div class="col-md-3 form-group" id="load-content1">



                                </div>
                                <div class="col-md-4 gaps">
                                    <!--<button type="button" class="btn btn-default pull-left" id="get_total_balance"
                                            data-toggle="modal" data-target="#view-modal">جستجو
                                    </button>-->
                                    <button type="submit"  class="btn btn-default pull-left">جستجو</button>
                                    <button type="submit" name="print" class="btn btn-default pull-left">جستجو پرنت</button>

                                    <button type="reset" class="btn btn-primary pull-left">تنظیم مجدد</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <hr>

                </div>
            </div>

        </div>
    </div>
</div>
<script>

    $(document).ready(function(){

        $(document).on('change', '#load-accounts', function(e){

            e.preventDefault();

            var type = $(this).val()
            $('#load-content1').hide();
            $('#load-content1').html('<img src="<?php echo asset_url('img/balls.gif');?>" height="50" width="50">'); // leave this div blank
            $('#load-content1').show();      // load ajax loader on button click

            $.ajax({
                url:  '<?php echo site_url('balance/load_accounts'); ?>/'+type,
                //type: 'POST',
                // data: 'id='+id,
                dataType: 'html'
            })
                .done(function(data){
                    console.log(data);

                    $('#load-content1').html(''); // blank before load.
                    $('#load-content1').html(data); // load here
                    $('#load-content1').hide();
                    $('#load-content1').show();
                   // $('#modal-loader').hide(); // hide loader
                })
                .fail(function(){
                    $('#load-content1').html('<option>problem</option>');
                    $('#load-content1').show();
                    $('#load-content1').hide();
                });

        });
        $(document).on('change', '#account', function(e){

            e.preventDefault();

            var type = $(this).val()
            $('#load-content1').hide();
            $('#load-content1').html('<img src="<?php echo asset_url('img/balls.gif');?>" height="50" width="50">'); // leave this div blank
            $('#load-content1').show();      // load ajax loader on button click

            $.ajax({
                url:  '<?php echo site_url('balance/account'); ?>/'+type,
                //type: 'POST',
                // data: 'id='+id,
                dataType: 'html'
            })
                .done(function(data){
                    console.log(data);

                    $('#load-content1').html(''); // blank before load.
                    $('#load-content1').html(data); // load here
                    $('#load-content1').hide();
                    $('#load-content1').show();
                    // $('#modal-loader').hide(); // hide loader
                })
                .fail(function(){
                    $('#load-content1').html('<option>problem</option>');
                    $('#load-content1').show();
                    $('#load-content1').hide();
                });

        });
    });
</script>


