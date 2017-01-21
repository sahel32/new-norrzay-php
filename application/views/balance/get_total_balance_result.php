
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
                        <caption> <h2> حساب ها به ترتیب </h2></caption>
                        <thead>
                        <tr>
                            <th>کد</th>
                            <th>نام</th>
                            <th>تخلص</th>
                            <th>تلفن</th>
                            <th>ولایات</th>
                            <th>نوع حساب</th>
                            <th>بیلانس (الباقی)</th>
                            <th>نوع پول</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($account_rows as $key => $value) {

                            if ($value->type == 'customer' or $value->type == 'seller') {
                                // $this->load->model('cash_model');
                                $this->load->model('balance_model');
                                // $get_balance_date=$this->balance_model->get_balance_datetime(array('table_id'=>$value->id,'table_name'=>'account'));
                                $single_balance_rows = $this->cash_model->get_balance_credit_debit_single(array('account_id' => $value->id));
                                ?>
                                <tr class="odd gradeX">
                                    <td><?php echo $value->id; ?></td>
                                    <td><?php echo $value->name; ?></td>
                                    <td><?php echo $value->lname; ?></td>
                                    <td><?php echo $value->phone; ?></td>
                                    <td><?php echo $value->pravince; ?></td>
                                    <td><?php
                                        switch ($value->type){
                                            case "seller";
                                                echo "فروشنده";
                                                break;
                                            case "customer";
                                                echo "مشتری";
                                                break;
                                            case "exchanger";
                                                echo "صراف";
                                                break;
                                            case "dealer";
                                                echo "کمیشن کار";
                                                break;
                                            case "driver";
                                                echo "راننده";
                                                break;
                                            case "stuff";
                                                echo "کارمند";
                                                break;
                                        }
                                        ?></td>
                                    <?php foreach ($single_balance_rows as $bkey => $bvalue) { ?><?php } ?>
                                    <!--       <td class="center"><?php /*echo (isset($bvalue->debit))? $bvalue->debit : "";*/
                                    ?></td>
                                            <td class="center"><?php /*echo (isset($bvalue->credit))? $bvalue->credit : "";*/
                                    ?></td>-->
                                    <td class="center"><?php echo (isset($bvalue->balance)) ? $remain=$bvalue->balance : ""; ?></td>
                                    <td>
                                        <?php

                                        switch ($bvalue->type) {
                                            case "usa";
                                                echo "دالر";
                                                $dalar+=$remain;
                                                break;
                                            case "af";
                                                echo "افغانی";
                                                $af+=$remain;
                                                break;
                                            case "ir";
                                                echo "تومان";
                                                $ir+=$remain;
                                                break;
                                            case "eur";
                                                echo "یرو";
                                                $eur+=$remain;
                                                break;
                                            default:
                                                echo "عرض های دیکه ";
                                        }


                                        ?></td>
                                </tr>
                                <?php
                            } elseif ($value->type == 'dealer' or $value->type == 'exchanger') {
                                ?>
                                <td><?php echo $value->id; ?></td>
                                <td><?php echo $value->name; ?></td>
                                <td><?php echo $value->lname; ?></td>
                                <td><?php echo $value->phone; ?></td>
                                <td><?php echo $value->pravince; ?></td>
                                <td><?php
                                    switch ($value->type){
                                        case "seller";
                                            echo "فروشنده";
                                            break;
                                        case "customer";
                                            echo "مشتری";
                                            break;
                                        case "exchanger";
                                            echo "صراف";
                                            break;
                                        case "dealer";
                                            echo "کمیشن کار";
                                            break;
                                        case "driver";
                                            echo "راننده";
                                            break;
                                        case "stuff";
                                            echo "کارمند";
                                            break;
                                    } ?></td>
                                <td colspan="2"></td>
                                <?php
                                $type_rows = $this->cash_model->group_by(array('account_id' => $value->id), 'type');
                                foreach ($type_rows as $key => $type_value) { ?>
                                    <tr class="odd gradeX">
                                    <td colspan="6"></td>
                                    <?php
                                    $this->load->model('cash_model');
                                    //$this->load->model('balance_model');

                                    if ($type_value->type != "check") {
                                        // $get_balance_date=$this->balance_model->get_balance_datetime(array('table_id'=>$type_value->account_id,'table_name'=>'account','balance_type'=>$type_value->type));
                                        $all = $this->cash_model->get_balance_credit_debit_mylty_money($type_value->account_id, $type_value->type);
                                        foreach ($all as $key => $value) {
                                            ?>
                                            <!--<td class="center"><?php /*echo $value->debit;*/ ?></td>
                                    <td class="center"><?php /*echo $value->credit;*/ ?></td>-->
                                            <td class="center"><?php echo $remain+=$value->balance; ?></td>
                                            <td>
                                                <?php

                                                switch ($type_value->type) {
                                                    case "usa";
                                                        echo "دالر";
                                                        $dalar+=$remain;
                                                        break;
                                                    case "af";
                                                        echo "افغانی";
                                                        $af+=$remain;
                                                        break;
                                                    case "ir";
                                                        echo "تومان";
                                                        $ir+=$remain;
                                                        break;
                                                    case "eur";
                                                        echo "یرو";
                                                        $eur+=$remain;
                                                        break;
                                                    default:
                                                        echo "عرض های دیکه ";
                                                }


                                                ?></td>

                                        <?php } ?>
                                        </tr>
                                        <?php
                                    }


                                }
                            }
                        }
                        ?>
                        </tbody>
                    </table>
                    <table class="table table-striped table-bordered table-hover">
                        <caption> <h2> جمع کل همه حساب ها </h2></caption>
                        <thead>
                        <tr class="money-amount">
                            <th class='dalar'>دلار</th>
                            <th class='af'>افغانی</th>
                            <th class='ir'>تومان</th>
                            <th class='eur'>یرو</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        echo "<tr class='money'>
                                   <th class='dalar'>$dalar</th>
                                  <th class='af'>$af</th>
                                  <th class='ir'>$ir</th>
                                  <th class='eur'>$eur</th>
                                  </tr>";
                        ?>
                        <tr class="input">
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
                        <tr><td>
                                <select id="money-type">
                                    <option>dalar</option>
                                    <option>af</option>
                                    <option>ir</option>
                                    <option>eur</option>
                                </select>
                            </td>
                            <td colspan="3">
                                <input type="button" value="acount" id="calculate">
                            </td>

                        </tr>
                        </tbody>
                    </table>

                </div>

            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" >
                        <caption> <h2> وضعیت گدام ها</h2></caption>
                        <thead>
                        <tr>
                            <th>کد</th>
                            <th>نام</th>
                            <th>ولایت</th>

                            <th>تیل موجود</th>
                            <th>نوع گدام</th>
                            <th>نوع تیل</th>

                        </tr>
                        </thead>
                        <tbody>
                        <?php

                        foreach ($stock_rows as $key => $value) {?>


                            <tr class="odd gradeX">
                                <td><?php echo $value->id;?></td>
                                <td><?php echo $value->name;?></td>
                                <td><?php echo $value->province;?></td>
                                <?php if($value->type=="fact"){ ?>
                                    <td class="center"><?php
                                        $this->load->model('stock_model');
                                        echo  $this->stock_model->get_stock_balance_fact($value->id,$value->type);
                                        $sufix="fact";

                                        ?></td>
                                <?php  }else if($value->type=="sell"){?>
                                    <td class="center"><?php
                                        $this->load->model('stock_model');

                                        echo  $this->stock_model->get_stock_balance_pre_sell($value->id);
                                        $sufix="pre";
                                        ?></td>
                                <?php }else if($value->type=="buy"){?>
                                    <td class="center"><?php
                                        $this->load->model('stock_model');

                                        echo  $this->stock_model->get_stock_balance_pre_buy($value->id);
                                        $sufix="pre";
                                        ?></td>
                                <?php }?>
                                <td class="center"><?php
                                    switch ($value->type){
                                        case "buy";
                                            echo "پیش خرید";
                                            break;
                                        case "sell";
                                            echo "پیش فروش";
                                            break;
                                        default;
                                            echo "حقیقی";
                                    }

                                    ?></td>
                                <td class="center"><?php echo $value->oil_type;?></td>
                               
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

<script src="<?php echo asset_url('js/dataTables/jquery.dataTables.js'); ?>"></script>
<script src="<?php echo asset_url('js/dataTables/dataTables.bootstrap.js'); ?>"></script>

<script>
    $(document).ready(function () {
        $('#dataTables-example').dataTable({
            "pageLength": 500
        });
        $('#dalar').attr('type','hidden')
        $('#money-type').change(function(){

            var type=$(this).val()


            var array_of_name = [];
            $(".input").each(function(){
                $(this).find('#dalar').attr('type','text')
                $(this).find('#ir').attr('type','text')
                $(this).find('#af').attr('type','text')
                $(this).find('#eur').attr('type','text')
                $(this).find('#'+type).attr('type','hidden')
                $(this).find('#'+type).val('')

                array_of_name.push({'dalar':'hi'});
            });
        })

        $("#calculate").click(function(){
            var total;
            $(".input").each(function(){
                $(this).find('#dalar').val()
                $(this).find('#ir').val()
                $(this).find('#af').val()
                $(this).find('#eur').val()
            });

            $(".money-amount").each(function(){
                $(this).find('.dalar').val()
                $(this).find('.ir').val()
                $(this).find('.af').val()
                $(this).find('.eur').val()
            });
        })

    });
</script>
<!-- CUSTOM SCRIPTS -->