<link href="<?php echo asset_url('jquery-ui-1.10.4/jquery-ui.css'); ?>" rel="stylesheet" type="text/css" />




<script type="text/javascript" src="<?php echo asset_url('jquery-ui-1.10.4/external/jquery/jquery.js'); ?>"></script>
<script type="text/javascript" src="<?php echo asset_url('jquery-ui-1.10.4/jquery-ui.js'); ?>"></script>

<script type="text/javascript" src="<?php echo asset_url('jquery-ui-1.10.4/jquery-ui-1.10.4/ui/jquery.ui.autocomplete.js'); ?>"></script>

<!--<link rel="stylesheet" href="<?php /*echo asset_url('jquery-ui-1.10.4/jquery-ui-1.10.4/themes/base/jquery.ui.all.css'); */?>">
<script src="<?php /*echo asset_url('jquery-ui-1.10.4/jquery-ui-1.10.4/jquery-1.10.2.js'); */?>"></script>
<script src="<?php /*echo asset_url('jquery-ui-1.10.4/jquery-ui-1.10.4/ui/jquery.ui.core.js'); */?>"></script>
<script src="<?php /*echo asset_url('jquery-ui-1.10.4/jquery-ui-1.10.4/ui/jquery.ui.widget.js'); */?>"></script>
<script src="<?php /*echo asset_url('jquery-ui-1.10.4/jquery-ui-1.10.4/ui/jquery.ui.position.js'); */?>"></script>
<script src="<?php /*echo asset_url('jquery-ui-1.10.4/jquery-ui-1.10.4/ui/jquery.ui.menu.js'); */?>"></script>
<script src="<?php /*echo asset_url('jquery-ui-1.10.4/jquery-ui-1.10.4/ui/jquery.ui.autocomplete.js'); */?>"></script>
<link rel="stylesheet" href="<?php /*echo asset_url('jquery-ui-1.10.4/jquery-ui-1.10.4/demos.css'); */?>">
-->
<script type="text/javascript">
    $(function(){
        $("#birds").autocomplete({
            source: "<?php echo site_url('cash/get_birds');?>" // path to the get_birds method
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
        <h2>ثبت درایور</h2>
        <h5>از این قسمت میتوانید مشخصات درایور را ثبت نمایید. </h5>

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
                        <form role="form" action="<?php echo site_url('cash/check_type/'.$cash_id.'/'.$this->uri->segment(4)); ?>" method="post" id="debit">
                                <input type="hidden" name="cash_id" value="<?php echo $cash_id;?>">
                            <div class="col-md-3 form-group">

                                <label>کد چک</label>

                                <input type="text"  value="<?php echo set_value('code'); ?>"name="code" class="form-control" data-trigger="hover"/>
                                <span class="help-inline"><?php echo (form_error('code') ) ? form_error('code') : "<span class='red'>*</span>"; ?></span>

                            </div>

                            <div class="col-md-3 form-group">

                                <label>اسم صاحب چک</label>

                                <input type="text"  value="<?php echo set_value('name'); ?>"name="name" class="form-control" data-trigger="hover"/>
                                <span class="help-inline"><?php echo (form_error('name') ) ? form_error('name') : "<span class='red'>*</span>"; ?></span>

                            </div>
                            <div class="col-md-3 form-group">

                                <label>نوع پول</label>


                                <select class="form-control" name="type" id="type">

                                    <?php
                                    foreach ($money_type as $anotherkey => $val) {
                                        echo "<option value='".$anotherkey."'>".$val."</option>";
                                    }
                                    ?>
                                    


                                </select>

                            </div>
                            <div class="col-md-3 form-group">

                                <label>چک بانک یا صراف</label>

                                <select class="form-control" name="check_type">

                                    <option value="excheck">چک صراف </option>
                                    <option value="bankcheck">چک بانک</option>

                                </select>

                            </div>
                            <div class="col-md-3 gaps">
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
                  //  $('#new-driver').modal('toggle');
                }
            })


        </script>
        <!-- Start Modal driver -->
        <div id="new-driver" class="modal fade" tabindex="-1">
            <script>


                $("#insert-check").click(function () {
                    alert("hi")
                })

            </script>



