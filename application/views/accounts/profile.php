<div id="page-inner">
    <div class="row">
        <div class="col-md-12">
            <h2>پروفایل مشتری</h2>
            <h5>در این قسمت شما میتوانید تمام اطلاعات مربوط به خریدار و فروشنده مورد نظر را مشاهده کنید.</h5>
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
                                <th>کد</th>
                                <th>نام</th>
                                <th>تخلص</th>
                                <th>شماره تماس</th>
                                <th>بردگی</th>
                                <th>رسیدگی</th>
                                <th>بیلانس (الباقی)</th>
                                <th>تغییرات</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php

                            foreach ($account_rows as $key => $value) {?>
                            <tr class="odd gradeX">
                                <td><?php echo $value->id;?></td>
                                <td><?php echo $value->name;?></td>
                                <td><?php echo $value->lname;?></td>
                                <td><?php echo $value->phone;?></td>
                                <td class="center"><?php echo $value->debit;?></td>
                                <td class="center"><?php echo $value->credit;?></td>
                                <td class="center"><?php echo $value->balance;?></td>
                               
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
    <!-- /. ROW -->
    <hr />
    <div class="row">
        <div class="col-md-12 col-sm-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    اطلاعات مالی
                    <div class="btn-group pull-left">

                       <!-- <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-chevron-down"></i>
                        </button>-->
                        <!--<ul class="dropdown-menu slidedown">
                            <li>
                                <a href="#">
                                    <i class="fa fa-sign-out fa-fw"></i>همه
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="#">
                                    <i class="fa fa-refresh fa-fw"></i>
                                    <span class="filter2">debit</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fa fa-check-circle fa-fw"></i>رسیدگی
                                </a>
                            </li>
                        </ul>-->
                        <select id="filter2">
                            <option value="debit">debit</option>
                            <option value="credit">credit</option>
                        </select>
                        <i class="fa fa-comments fa-filter" aria-hidden="true"> فیلتر </i>

                    </div>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example2">
                            <thead>
                            <tr>
                                <th>شماره فاکتور</th>
                                <th>تاریخ</th>
                                <th>مقدار پول</th>
                                <th>نوع پول</th>
                                <th>نوع دریافت / پرداخت پول</th>
                                <th>بیلانس (الباقی)</th>
                                <th>شرح و تفصیلات</th>
                                <th>تغییرات</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach ($cash_rows as $key => $cash_value) {
                                ?>
                            <tr class="odd gradeX">
                                <td><?php  echo $cash_value->id;?></td>
                                <td><?php  echo $cash_value->date;?></td>
                                <td><?php  echo $cash_value->cash;?></td>
                                <td class="center"><?php  echo $cash_value->type;?></td>
                                <td class="center"><?php  echo $cash_value->transaction_type;?></td>
                                <td class="center">X</td>
                                <td class="center"><?php  echo $cash_value->desc;?></td>
                                <td class="center">
                                    <a href="<?php echo site_url('account/delete/'.$value->id) ?>"><span class="glyphicon glyphicon-trash"></span></a>
                                    <a href="<?php echo site_url('account/edit/'.$value->id) ?>"><span class="glyphicon glyphicon-edit"></span></a>
                                    <a href="<?php echo site_url('account/profile/'.$value->id); ?>"><span class="glyphicon glyphicon-asterisk"></span></a>
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
                    اطلاعات خرید و فروش تیل
                </div>
                <div class="panel-body">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#buy" data-toggle="tab">خرید</a></li>
                        <li class=""><a href="#sell" data-toggle="tab">فروش</a></li>
                        <li class=""><a href="#prebuy" data-toggle="tab">پیش خرید</a></li>
                        <li class=""><a href="#presell" data-toggle="tab">پیش فروش</a></li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane fade active in" id="buy">
                            <h4></h4>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                    <tr>
                                        <th>تاریخ</th>
                                        <th>مقدار تیل (تناژ)</th>
                                        <th>نوع تیل</th>
                                        <th>فروشنده دست اول</th>
                                        <th>فی تن</th>
                                        <th>مقدار پیش خرید</th>
                                        <th>موارد بیشتر</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    foreach ($buy_rows as $key => $value) {?>
                                    <tr class="odd gradeX">
                                        <td>Trident</td>
                                        <td><?php echo $value->amount;?></td>
                                        <td><?php echo $value->name;?></td>
                                        <td><?php echo $value->buyer_seller_id;?></td>
                                        <td class="center"><?php echo $value->unit_price;?></td>
                                        <td class="center">4</td>
                                        <td class="center">
                                            <a href="<?php echo site_url('account/delete/'.$value->id) ?>"><span class="glyphicon glyphicon-trash"></span></a>
                                            <a href="<?php echo site_url('account/edit/'.$value->id) ?>"><span class="glyphicon glyphicon-edit"></span></a>
                                            <a href="<?php echo site_url('account/profile/'.$value->id); ?>"><span class="glyphicon glyphicon-asterisk"></span></a>
                                        </td>
                                    </tr>
                                    <?php }  ?>
                                    </tbody>
                                </table>
                            </div>

                            <div class="tab-pane fade" id="moreinfo">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                        <thead>
                                        <tr>
                                            <th>سمیر (آیدی بارنامه)</th>
                                            <th>ترانزیت (نمبر موتر)</th>
                                            <th>ناحیه بارگیری</th>
                                            <th>ناحیه تخلیه</th>
                                            <th>وزن سمیر (وزن بارگیری)</th>
                                            <th>وزن تخلیه</th>
                                            <th>اضافه بار</th>
                                            <th>درایور</th>
                                            <th>تاریخ پیش خرید</th>
                                            <th>الباقی تیل</th>
                                            <th>الباقی پول</th>
                                            <th>شرح و تفصیلات</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr class="odd gradeX">
                                            <td class="center">4</td>
                                            <td>Trident</td>
                                            <td>Internet Explorer 4.0</td>
                                            <td>Win 95+</td>
                                            <td class="center">4</td>
                                            <td class="center">X</td>
                                            <td class="center">4</td>
                                            <td class="center">4</td>
                                            <td class="center">4</td>
                                            <td class="center">4</td>
                                            <td class="center">4</td>
                                            <td class="center">4</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                        <div class="tab-pane fade" id="sell">
                            <h4></h4>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                    <tr>
                                        <th>تاریخ</th>
                                        <th>مقدار تیل (تناژ)</th>
                                        <th>نوع تیل</th>
                                        <th>فی تن</th>
                                        <th>مقدار پیش فروش</th>
                                        <th>موارد بیشتر</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr class="odd gradeX">
                                        <td>Trident</td>
                                        <td>Internet Explorer 4.0</td>
                                        <td>Win 95+</td>
                                        <td class="center">4</td>
                                        <td class="center">X</td>
                                        <td class="center">
                                            <a href="#"><span class="glyphicon glyphicon-trash"></span></a>
                                            <a href="#"><span class="glyphicon glyphicon-edit"></span></a>
                                            <a href="#moreinfo1" data-toggle="tab"><span class="glyphicon glyphicon-asterisk"></span></a>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="tab-pane fade" id="moreinfo1">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                        <thead>
                                        <tr>
                                            <th>سمیر (آیدی بارنامه)</th>
                                            <th>ترانزیت (نمبر موتر)</th>
                                            <th>ناحیه بارگیری</th>
                                            <th>ناحیه تخلیه</th>
                                            <th>وزن سمیر (وزن بارگیری)</th>
                                            <th>درایور</th>
                                            <th>تاریخ پیش فروش</th>
                                            <th>الباقی تیل</th>
                                            <th>الباقی پول</th>
                                            <th>شرح و تفصیلات</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr class="odd gradeX">
                                            <td class="center">4</td>
                                            <td>Trident</td>
                                            <td>Internet Explorer 4.0</td>
                                            <td>Win 95+</td>
                                            <td class="center">4</td>
                                            <td class="center">X</td>
                                            <td class="center">4</td>
                                            <td class="center">4</td>
                                            <td class="center">4</td>
                                            <td class="center">4</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                        <div class="tab-pane fade" id="prebuy">
                            <h4></h4>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                    <tr>
                                        <th>کد</th>
                                        <th>تاریخ</th>
                                        <th>تاریخ تحویل</th>
                                        <th>تعداد موتر</th>
                                        <th>مقدار تیل (تناژ)</th>
                                        <th>نوع تیل</th>
                                        <th>فی تن</th>
                                        <th>موارد بیشتر</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    foreach ($buy_rows as $key => $value) {?>

                                    <tr class="odd gradeX">
                                        <td><?php echo $value->id; ?></td>
                                        <td><?php echo $value->f_date; ?></td>
                                        <td><?php echo $value->s_date; ?></td>
                                        <td class="center"><?php echo $value->car_count; ?></td>
                                        <td class="center"><?php echo $value->amount; ?></td>
                                        <td class="center"><?php echo $value->name; ?></td>
                                        <td class="center"><?php echo $value->unit_price; ?></td>
                                        <td class="center">
                                            <a href="<?php echo site_url('account/delete/'.$value->id); ?>"><span class="glyphicon glyphicon-trash"></span></a>
                                            <a href="#"><span class="glyphicon glyphicon-edit"></span></a>
                                            <a href="<?php echo site_url('account/profile/'.$value->id); ?>"><span class="glyphicon glyphicon-asterisk"></span></a>
                                        </td>
                                    </tr>
                                    <?php  }?>
                                    </tbody>
                                </table>
                            </div>

                            <div class="tab-pane fade" id="moreinfo2">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                        <thead>
                                        <tr>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr class="odd gradeX">
                                            <td class="center">4</td>
                                            <td>Trident</td>
                                            <td>Internet Explorer 4.0</td>
                                            <td>Win 95+</td>
                                            <td class="center">4</td>
                                            <td class="center">X</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                        <div class="tab-pane fade" id="presell">
                            <h4></h4>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                    <tr>
                                        <th>کد</th>
                                        <th>تاریخ</th>
                                        <th>تاریخ تحویل</th>
                                        <th>تعداد موتر</th>
                                        <th>مقدار تیل (تناژ)</th>
                                        <th>نوع تیل</th>
                                        <th>فی تن</th>

                                        <th>موارد بیشتر</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    foreach ($sell_rows as $key => $value) {?>

                                        <tr class="odd gradeX">
                                            <td><?php echo $value->id; ?></td>
                                            <td><?php echo $value->f_date; ?></td>
                                            <td><?php echo $value->s_date; ?></td>
                                            <td class="center"><?php echo $value->car_count; ?></td>
                                            <td class="center"><?php echo $value->amount; ?></td>
                                            <td class="center"><?php echo $value->name; ?></td>
                                            <td class="center"><?php echo $value->unit_price; ?></td>
                                            <td class="center">
                                                <a href="#"><span class="glyphicon glyphicon-trash"></span></a>
                                                <a href="#"><span class="glyphicon glyphicon-edit"></span></a>
                                                <a href="<?php echo site_url('account/profile/'.$value->id); ?>"><span class="glyphicon glyphicon-asterisk"></span></a>
                                            </td>
                                        </tr>
                                    <?php  }?>
                                    </tbody>
                                </table>
                            </div>

                            <div class="tab-pane fade" id="moreinfo3">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                        <thead>
                                        <tr>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr class="odd gradeX">
                                            <td class="center">4</td>
                                            <td>Trident</td>
                                            <td>Internet Explorer 4.0</td>
                                            <td>Win 95+</td>
                                            <td class="center">4</td>
                                            <td class="center">X</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

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


    $('#filter2').change( function() {
        var filtervalue = this.value;
        var table2= $('#dataTables-example2').dataTable();
        table2.fnFilter(filtervalue );
    });
</script>