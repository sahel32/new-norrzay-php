


<script type="text/javascript" src="<?php echo asset_url('jquery-ui-1.10.4/jquery-ui.js'); ?>"></script>

<script type="text/javascript" src="<?php echo asset_url('jquery-ui-1.10.4/jquery-ui-1.10.4/ui/jquery.ui.autocomplete.js'); ?>"></script>

<script type="text/javascript">
    $(function(){
        $("#stock_transactions").autocomplete({
            source: "<?php echo site_url('cash/stock_transactions_json');?>" // path to the get_birds method
        });
    });

</script>


<link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.1/themes/base/minified/jquery-ui.min.css" type="text/css" />
<style>
    .ui-autocomplete-loading {
        background: white url("<?php echo asset_url('jquery-ui-1.10.4/ui-anim_basic_16x16.gif');?>") right center no-repeat;
    }

</style>
<div class="row">
    <div class="col-md-12">
        <h2>پرداخت و دریافت </h2>
        <h5>پول یا چک برای مشتری و فروشنده های تیل</h5>

    </div>
</div>
<!-- /. ROW  -->
<hr />
<div class="row">
    <div class="col-md-12">
        <!-- Form Elements -->
        <div class="panel panel-default">
            <div class="panel-heading">
                فورم ثبت درایور
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
                        <form role="form" action="<?php echo site_url('cash/oil_credit_debit/'.$this->uri->segment(3)); ?>" method="post" id="debit">
                            <input type="hidden" name="date"  value="<?php echo $date;?>" class="form-control">
                            <div class="col-md-3 form-group">
                                <!-- <a href="#new-driver" data-toggle="modal">
                                     <i class="fa fa-plus-circle" data-toggle="tooltip" title="ثبت درایور جدید" data-placement="top"></i>
                                 </a>-->
                                <label>فاکتور مربوظ </label>
                                <input type="text" name="st_id"  id="stock_transactions" class="form-control">
                            </div>
                            <div class="col-md-3 form-group">

                                <label>مقدار پول</label>

                                <input type="text"  value="<?php echo set_value('amount'); ?>"name="amount" class="form-control" data-trigger="hover"/>
                                <span class="help-inline"><?php echo (form_error('amount') ) ? form_error('amount') : "<span class='red'>*</span>"; ?></span>

                            </div>


                            <div class="col-md-3 form-group">

                                <label>دریافت یا پرداخت</label>

                                <select class="form-control" name="transaction_type">

                                    <option value="debit">رسیدگی </option>
                                    <option value="credit">بردگی </option>

                                </select>

                            </div>





                            <div class="col-md-3 form-group">

                                <label>نوع پول</label>


                                <select class="form-control" name="type" id="type">
                                    <option value="usa">usa</option>
                                    <option value="check" >check</option>


                                </select>

                            </div>
                          <!--  <div class="col-md-3 form-group">
                                 <a href="#new-driver" data-toggle="modal">
                                     <i class="fa fa-plus-circle" data-toggle="tooltip" title="ثبت درایور جدید" data-placement="top"></i>
                                 </a>
                                <label>اسم شخص گیرنده یا دهند </label>
                                <input type="text" name="account_name"  id="birds" class="form-control">
                            </div>
-->
                            <div class="col-md-3 gaps">
                                <button type="submit" class="btn btn-default pull-left">تائید</button>
                                <button type="reset" class="btn btn-primary pull-left">تنظیم مجدد</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


 



