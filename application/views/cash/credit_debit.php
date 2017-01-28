<link href="<?php echo asset_url('jquery-ui-1.10.4/jquery-ui.css'); ?>" rel="stylesheet" type="text/css" />




<script type="text/javascript" src="<?php echo asset_url('jquery-ui-1.10.4/external/jquery/jquery.js'); ?>"></script>
<script type="text/javascript" src="<?php echo asset_url('jquery-ui-1.10.4/jquery-ui.js'); ?>"></script>

<script type="text/javascript" src="<?php echo asset_url('jquery-ui-1.10.4/jquery-ui-1.10.4/ui/jquery.ui.autocomplete.js'); ?>"></script>

<script type="text/javascript">
    $(function(){
        $("#birds").autocomplete({
            source: "<?php echo site_url('cash/get_accounts');?>" // path to the get_birds method
        });
    });
</script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-modal/2.2.6/js/bootstrap-modal.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-modal/2.2.6/js/bootstrap-modalmanager.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-modal/2.2.6/js/bootstrap-modalmanager.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-modal/2.2.6/js/bootstrap-modal.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-modal/2.2.6/css/bootstrap-modal.css" type="text/css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-modal/2.2.6/css/bootstrap-modal.min.css" type="text/css" />

<link rel="stylesheet" href="<?php echo asset_url('js/modal.css'); ?>" type="text/css" />
<link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.1/themes/base/minified/jquery-ui.min.css" type="text/css" />
<style>
    .ui-autocomplete-loading {
        background: white url("<?php echo asset_url('jquery-ui-1.10.4/ui-anim_basic_16x16.gif');?>") right center no-repeat;
    }

</style>
<div class="row">
    <div class="col-md-12">
        <h2>دریافت / پرداخت</h2>
        <h5>از این قسمت میتوانید بردگی و رسیدگی شخص مورد نظر را ثبت نمایید. </h5>

    </div>
</div>
<!-- /. ROW  -->
<hr />
<div class="row">
    <div class="col-md-12">
        <!-- Form Elements -->
        <div class="panel panel-default">
            <div class="panel-heading">
                فورم ثبت دریافت / پرداخت
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
                        <form role="form" action="<?php echo site_url('cash/credit_debit/'.$this->uri->segment(3)); ?>" method="post" id="debit">

                            <input type="hidden" name="date"  value="<?php echo $date;?>" class="form-control">
                            <div class="col-md-3 form-group">
                                <!-- <a href="#new-driver" data-toggle="modal">
                                     <i class="fa fa-plus-circle" data-toggle="tooltip" title="ثبت درایور جدید" data-placement="top"></i>
                                 </a>-->
                                <label>نام شخص</label>
                                <input type="text" id="birds"  value="<?php echo set_value('account_name'); ?>"name="account_name" class="form-control" data-trigger="hover"/>
                                <span class="help-inline"><?php echo (form_error('account_name') ) ? form_error('account_name') : "<span class='red'>*</span>"; ?></span>

                            </div>

                            <div class="col-md-3 form-group">

                                <label>مبلغ</label>

                                <input type="text"  value="<?php echo set_value('amount'); ?>"name="amount" class="form-control" data-trigger="hover"/>
                                <span class="help-inline"><?php echo (form_error('amount') ) ? form_error('amount') : "<span class='red'>*</span>"; ?></span>

                            </div>


                            <div class="col-md-3 form-group">

                                <label>دریافت / پرداخت</label>

                                <select class="form-control" name="transaction_type">

                                    <option value="credit">رسیدگی </option>
                                    <option value="debit">بردگی </option>

                                </select>

                            </div>

                            <div class="col-md-3 form-group">

                                <label>نوعیت پول</label>


                                <select class="form-control" name="type" id="type">

                                    <?php
                                        foreach ($money_type as $anotherkey => $val) {
                                           echo "<option value='".$anotherkey."'>".$val."</option>";
                                        }
                                    ?>
                                    <option value="check" >چک</option>


                                </select>

                            </div>
                            <div class="col-md-6 form-group">
                                <label>شرح و تفصیلات</label>
                                <textarea class="form-control" rows="1" name="desc" ></textarea>
                            </div>

                            <div class="col-md-3 col-md-offset-3 gaps">
                                <button type="submit" class="btn btn-default pull-left">تائید</button>
                                <button type="reset" class="btn btn-primary pull-left">تنظیم مجدد</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
<script>

    $("#type").change(function () {
        if(this.value=="check") {
           // $('#new-driver').modal('toggle');
        }
    })


</script>




