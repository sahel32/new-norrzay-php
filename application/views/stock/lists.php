              <div class="row">
                    <div class="col-md-12">
                        <h2><?php echo $main_title;?></h2>   
                        <h5><?php echo $desc;?></h5>
                    </div>
                </div>
                 <!-- /. ROW  -->
                 <hr />
                <div class="row">
                    <div class="col-md-12 col-sm-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                 <?php echo $sub_title;?>
                            </div>

                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                        <thead>
                                            <tr>
                                                <th>کد</th>
                                                <th>نام</th>
                                                <th>ولایت</th>

                                                <th>تیل موجود</th>
                                                <th>نوع گدام</th>
                                                <th>نوع تیل</th>
                                                <th>تغییرات</th>
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
                                                <td class="center">
                                                    <a href="#"><span class="glyphicon glyphicon-trash"></span></a>
                                                    <a href="#"><span class="glyphicon glyphicon-edit"></span></a>
                                                    <a href="<?php echo site_url('stock/profile/'.$value->id.'/'.$sufix); ?>"><span class="glyphicon glyphicon-asterisk"></span></a>
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
            </div>
             <!-- /. PAGE INNER  -->

                    <script src="<?php echo asset_url('js/dataTables/jquery.dataTables.js'); ?>"></script>
    <script src="<?php echo asset_url('js/dataTables/dataTables.bootstrap.js'); ?>"></script>

            <script>
            $(document).ready(function () {
                $('#dataTables-example').dataTable();
            });
    </script>
      <!-- CUSTOM SCRIPTS -->