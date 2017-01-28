
<div class="row">
    <div class="col-md-12">
        <h2>دریافت / پرداخت</h2>
        <h5>از این قسمت میتوانید بردگی و رسیدگی شخص مورد نظر را ثبت نمایید.</h5>

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
                        <form role="form" action="<?php echo site_url('cash/profile_oil_credit_debit/'.$account_id.'/'.$this->uri->segment(4)); ?>" method="post" id="debit">
                            <input type="hidden" name="account_id" value="<?php echo $account_id; ?>"  id="birds" class="form-control">
                            <input type="hidden" name="date"  value="<?php echo $date;?>" class="form-control">

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
                                    <option value="usa">دالر</option>
                                    <option value="check" >چک</option>


                                </select>

                            </div>
                            <div class="col-md-6 form-group">
                                <label>شرح و تفصیلات</label>
                                <textarea class="form-control" rows="1" name="desc" ></textarea>
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




   