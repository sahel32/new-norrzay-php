<div class="row">
    <div class="col-md-12">
        <h2>پروفایل مشتری ها </h2>
        <h5>در این قسمت شما میتوانید تمام اطلاعات مربوط به خریدار و فروشنده مورد نظر را مشاهده کنید.</h5>
    </div>
</div>

<hr/>
<div class="row">
    <div class="col-md-12 col-sm-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                اطلاعات مالی

            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <caption><h2> جمع کل همه حساب ها </h2></caption>
                        <thead>
                        <tr class="money-amount">
                            <th>کردت یا دبت</th>
                            <th>دلار</th>
                            <th>افغانی</th>
                            <th>تومان</th>
                            <th>یرو</th>
                        </tr>
                        </thead>
                        <?php
                        $remain = '';

                        foreach ($transaction_type as $key => $val) {
                            $dates['transaction_type'] = $val->transaction_type;
                            foreach ($money_type as $key => $values) {
                                $this->load->model('cash_model');
                                $dates['type'] = $values->type;
                                $all = $this->cash_model->get_where($dates);
                                foreach ($all as $key => $value) {
                                    $remain += $value->cash;
                                    switch ($value->type) {
                                        case "usa";
                                            $dalar += $remain;

                                            break;
                                        case "af";
                                            $af += $remain;

                                            break;
                                        case "ir";
                                            $ir += $remain;

                                            break;
                                        case "eur";
                                            $eur += $remain;

                                            break;
                                        default:

                                    }
                                }
                                if ($re_dalar == "") {
                                    $re_dalar = $dalar;
                                }
                                if ($re_af == "") {
                                    $re_af = $re_af;
                                }
                                if ($re_ir == "") {
                                    $re_ir = $re_ir;
                                }
                                if ($re_eur == "") {
                                    $re_eur = $re_eur;
                                }
                            }
                            ?>

                            <tr>
                                <th><?php
                                    switch ($val->transaction_type) {
                                        case "credit";
                                            echo "درامد";

                                            break;
                                        case "debit";
                                            echo "مصرف";

                                            break;
                                        default:

                                    }

                                    ?></th>
                                <th><?php  echo $dalar?></th>
                                <th><?php  echo $af?></th>
                                <th><?php  echo $ir?></th>
                                <th><?php  echo $eur?></th>
                            </tr>
                        <?php }
                        ?>

                        <tr class=".money-amount">
                            <td>مفاد یا ضرر</td>
                            <td class="dalar">
                                <?php echo $dalar - $re_dalar; ?>
                            </td>
                            <td class='af'><?php echo $af - $re_af ?></td>
                            <td class='ir'><?php echo $ir - $re_ir ?></td>
                            <td class='eur'><?php echo $eur - $re_eur ?></td>
                        </tr>

                        <tr class="input">
                            <th>

                            </th>
                            <th>
                                <input name="dalar" id="dalar">
                            </th>
                            <th>
                                <input name="af" id="af">
                            </th>
                            <th>
                                <input name="ir" id="ir">
                            </th>
                            <th>
                                <input name="eur" id="eur">
                            </th>
                        </tr>
                        <tr>
                            <td>
                                <select id="money-type">
                                    <option value="dalar">دالر</option>
                                    <option value="af">افغانی</option>
                                    <option value="ir">تومان</option>
                                    <option value="eur">یرو</option>
                                </select>
                            </td>
                            <td colspan="4">
                                <input type="button" value="حساب کردن" id="calculate">
                            </td>

                        </tr>
                    </table>

                </div>

            </div>

        </div>
    </div>
</div>
<!-- /. ROW -->

<script src="<?php echo asset_url('js/dataTables/jquery.dataTables.js'); ?>"></script>
<script src="<?php echo asset_url('js/dataTables/dataTables.bootstrap.js'); ?>"></script>

<script>
    $(document).ready(function () {
        $('#dataTables-example').dataTable({
            "pageLength": 500
        });
        $('#dalar').attr('type', 'hidden')
        $('#dalar').val('1')
        $('#money-type').change(function () {

            var type = $(this).val()

            var array_of_name = [];
            $(".input").each(function () {
                $(this).find('#dalar').attr('type', 'text')
                $(this).find('#dalar').val('')
                $(this).find('#ir').attr('type', 'text')
                $(this).find('#ir').val('')
                $(this).find('#af').attr('type', 'text')
                $(this).find('#af').val('')
                $(this).find('#eur').attr('type', 'text')
                $(this).find('#eur').val('')
                $(this).find('#' + type).attr('type', 'hidden')
                $(this).find('#' + type).val('1')

               // array_of_name.push({'dalar': 'hi'});
            });
        })

        $("#calculate").click(function () {

            var total=0;
            var ch_dalar;
            var mo_dalar;
            var ch_ir;
            var mo_ir;
            var ch_af;
            var mo_af;
            var ch_eur;
            var mo_eur;
            $(".input").each(function () {
                ch_dalar= parseInt($(this).find('#dalar').val())
                ch_ir=parseInt($(this).find('#ir').val())
                ch_af=parseInt($(this).find('#af').val())
                ch_eur=parseInt( $(this).find('#eur').val())
            });

           // $(".money-amount").each(function () {
                mo_dalar= parseInt($('.dalar').html())
                mo_ir=  parseInt($('.ir').html())
                mo_af= parseInt($('.af').html())
                mo_eur= parseInt($('.eur').html())
           // });

            if(!isNaN(mo_dalar)&&!isNaN(ch_dalar)){
                total+=mo_dalar*ch_dalar;
            }else {
                total+=mo_dalar
            }
            if(!isNaN(mo_ir) && !isNaN(ch_ir)){
                total+=mo_ir*ch_ir;
            }else{
                total+=mo_ir
            }
            if(!isNaN(mo_af) && !isNaN(ch_af)){
                total+=mo_af*ch_af;
            }else{
                total+=mo_af
            }
            if(!isNaN(mo_eur) && !isNaN(ch_eur)){
                total+=mo_eur*ch_eur;
            }else{
                total+=mo_eur
            }


alert(total)

        })
    });
</script>
<!-- CUSTOM SCRIPTS -->