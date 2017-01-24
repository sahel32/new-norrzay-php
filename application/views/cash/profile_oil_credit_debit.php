
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
                        <form role="form" action="<?php echo site_url('cash/profile_oil_credit_debit/'.$account_id.'/'.$this->uri->segment(4)); ?>" method="post" id="debit">
                            <input type="hidden" name="account_id" value="<?php echo $account_id; ?>"  id="birds" class="form-control">
                            <input type="hidden" name="date"  value="<?php echo $date;?>" class="form-control">

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
                            <div class="col-md-3 gaps">
                                <button type="submit" class="btn btn-default pull-left">تائید</button>
                                <button type="reset" class="btn btn-primary pull-left">تنظیم مجدد</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>




   