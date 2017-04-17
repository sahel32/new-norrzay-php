
              <div class="row">
                    <div class="col-md-12">
                        <h2>گدام ها</h2>   
                        <h5>در قسمت پایین شما میتوانید لیست گدام های موجود را مشاهده نمایید.</h5>
                    </div>
                </div>
                 <!-- /. ROW  -->
                 <hr />
                <div class="row">
                    <div class="col-md-12 col-sm-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                 لیست گدام ها
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
                                                    echo  $oil=$this->stock_model->get_stock_balance_fact($value->id,$value->type);
                                                    $sufix="fact";

                                                    ?> تن </td>
                                                <?php  }else if($value->type=="sell"){?>
                                                <td class="center"><?php
                                                    $this->load->model('stock_model');

                                                    echo  $this->stock_model->get_stock_balance_pre_sell($value->id);
                                                    $sufix="pre";
                                                    ?> تن </td>
                                                <?php }else if($value->type=="buy"){?>
                                                    <td class="center"><?php
                                                $this->load->model('stock_model');

                                                echo  $oil=$this->stock_model->get_stock_balance_pre_buy($value->id);
                                                $sufix="pre";
                                                ?> تن </td>
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
                                                   <!-- <div data-toggle="modal" data-id="<?php /*echo $value->id;*/?>" data-target="#view-modal" id="getUser" class="glyphicon glyphicon-trash">
                                                    </div>-->
                                                    <a href="<?php echo site_url('stock/add/'.$value->id); ?>"><span class="glyphicon glyphicon-edit" data-toggle="tooltip" title="ویرایش" data-placement="top"></span></a>
                                                    <a href="<?php echo site_url('stock/profile/'.$value->id.'/'.$sufix); ?>"><span class="fa fa-database" data-toggle="tooltip" title="پروفایل گدام" data-placement="top"></span></a>
                                                     <?php
                                                    if($value->type=="fact") {
                                                        echo ($value->status) ? "<a href='" . site_url('stock/inactive/' . $value->id . '') . "'><span style='color:blue;' class='glyphicon glyphicon-ok-circle' data-toggle='tooltip' title='غیر فعال کردن گدام' data-placement='top'></span>  </a>" : "<a href='" . site_url('stock/active/' . $value->id . '') . "'>
                                                            <span style='color: #f90c05;' class='glyphicon glyphicon-ban-circle' data-toggle='tooltip' title='فعال کردن گدام' data-placement='top'></span>
                                                              </a>";
                                                    }
                                                     if($oil==0) {
                                                     ?>
                                                    <a href="#" data-toggle="modal" data-target="#myModal" data-id="<?php echo $value->id; ?>"
                                                    ><span class="glyphicon glyphicon-trash" data-toggle="tooltip" title="حذف" data-placement="top"></span></a>
                                                    <?php } ?>
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
              <!-- Button trigger modal -->

              <!-- Modal -->
              <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                  <div class="modal-dialog" role="document">
                      <div class="modal-content">
                          <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                              <h4 class="modal-title" id="myModalLabel">هشدار برای حذف داده</h4>
                          </div>
                          <div class="modal-body">
                              ایا مطمن هستید که میخواهید حذف کنید؟
                          </div>
                          <div class="modal-footer">
                              <button type="button" class="btn btn-default" data-dismiss="modal">لغو</button>
                              <a type="button" class="btn btn-primary"  href="<?php echo site_url('stock/delete/'.$value->id); ?>" >تایید</a>
                          </div>
                      </div>
                  </div>
              </div>

                    <script src="<?php echo asset_url('js/dataTables/jquery.dataTables.js'); ?>"></script>
    <script src="<?php echo asset_url('js/dataTables/dataTables.bootstrap.js'); ?>"></script>

            <script>
            $(document).ready(function () {
                $('#dataTables-example').dataTable();
            });
    </script>
    <script>
        $("span").tooltip();
    </script>
      <!-- CUSTOM SCRIPTS -->