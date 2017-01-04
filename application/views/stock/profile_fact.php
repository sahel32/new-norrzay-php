              <div class="row">
                    <div class="col-md-12">
                        <?php
                        foreach ($stock_rows as $key => $t_value) {
                            ?>

                            <h2>گدام حقیقی</h2>
                            <h5> نوع تیل در این گدام <?php echo $t_value->oil_type ?></h5>

                        <?php }?>

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
                                    <table class="table table-striped table-bordered table-hover" >
                                        <thead>
                                            <tr>
                                                <th>کد</th>
                                                <th>نام گدام</th>
                                                <th>نوع تیل</th>
                                                <th>تیل موجودی</th>
                                                <th>نوع گدام</th>
                                                <th>تغییرات</th>
                                                <th>وضعیت</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                         <?php 

                                        foreach ($stock_rows as $key => $s_value) {?>
                                            
                                            
                                            <tr class="odd gradeX">
                                                <td><?php echo $s_value->id;?></td>
                                                <td><?php echo $s_value->name;?></td>
                                                <td><?php echo $s_value->oil_type;?></td>
                                                <?php if($s_value->type=="fact"){ ?>
                                                    <td class="center"><?php
                                                        $this->load->model('stock_model');
                                                        echo  $this->stock_model->get_stock_balance_fact($s_value->id);

                                                        ?></td>
                                                <?php  }else{?>
                                                    <td class="center"><?php
                                                        $this->load->model('stock_model');

                                                        echo  $this->stock_model->get_stock_balance($s_value->id,$s_value->type);
                                                        ?></td>
                                                <?php } ?>
                                                <td class="center"><?php echo $s_value->type;?></td>
                                                <td class="center">

                                                    <a href="#"><span class="glyphicon glyphicon-edit"></span></a>
                                                </td>
                                                <td class="center">
                                                    <?php
                                                    if($s_value->type=="fact") {
                                                        echo ($s_value->status) ? "<a href='" . site_url('stock/inactive/' . $s_value->id . '') . "'> غیر فعال کردن </a>" : "<a href='" . site_url('stock/active/' . $s_value->id . '') . "'> فعال کردن </a>";
                                                    }?>
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


              <div class="row">
                  <div class="col-md-12 col-sm-6">
                      <div class="panel panel-default">
                          <div class="panel-heading">
                              تیل های حفیفی 
                              <div class="btn-group pull-left">
                                  <select id="filter2">
                                      <option value="debit">debit</option>
                                      <option value="credit">credit</option>
                                  </select>
                                  <i class="fa fa-comments fa-filter" aria-hidden="true"> فیلتر </i>
                              </div>
                          </div>

                          <div class="panel-body">
                              <div class="table-responsive">
                                  <table class="table table-striped table-bordered table-hover" id="dataTables-example1">
                                      <thead>
                                      <tr>
                                          <th>کد</th>
                                          <th>کد پیش خرید</th>

                                          <th>نام فروشنده</th>
                                          <th>نوغ تیل</th>
                                          <th>حالت تیل</th>
                                          <th>تناژ</th>
                                          <th>تعداد موتر</th>
                                          <th>فی</th>
                                          <th>تغییرات</th>
                                      </tr>
                                      </thead>
                                      <tbody>
                                      <?php

                                      foreach ($fact_oil_rows as $key => $value) {?>
                                          <tr class="odd gradeX">
                                              <td><?php echo $value->id;?></td>
                                              <td><?php echo $value->parent_id;?></td>

                                              <td class="center"><?php
                                                  $this->load->model('account_model');
                                                  echo $this->account_model->get_name(array('id'=>$value->buyer_seller_id));
                                                  ?></td>
                                              <td class="center"><?php echo $value->name;?></td>
                                              <td class="center"><?php echo $value->type;?></td>
                                              <td class="center">
                                                  <?php echo $value->amount;?>
                                              </td>
                                              <td class="center"><?php echo $value->car_count;?></td>
                                              <td class="center"><?php echo $value->unit_price;?></td>
                                              <td class="center">
                                                  <a href="<?php echo site_url('stock/fact_oil_delete/'.$value->id) ?>"><span class="glyphicon glyphicon-trash"></span></a>
                                                  <a href="<?php echo site_url('account/edit/'.$value->id) ?>"><span class="glyphicon glyphicon-edit"></span></a>
                                                  <a href="<?php echo site_url('oil/profile/'.$value->parent_id.'/buy'); ?>"><span class="glyphicon glyphicon-asterisk"></span></a>
                                              </td>
                                          </tr>
                                      <?php }
                                      ?>

                                      </tbody>
                                  </table>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>

              <div class="row">
                  <div class="col-md-12 col-sm-6">
                      <div class="panel panel-default">
                          <div class="panel-heading">
                              تیل های اضافه باز از راننده ها
                              <div class="btn-group pull-left">
                                  <select id="filter2">
                                      <option value="debit">debit</option>
                                      <option value="credit">credit</option>
                                  </select>
                                  <i class="fa fa-comments fa-filter" aria-hidden="true"> فیلتر </i>
                              </div>
                          </div>

                          <div class="panel-body">
                              <div class="table-responsive">
                                  <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                      <thead>
                                      <tr>
                                          <th>کد</th>
                                          <th>کد پیش خرید</th>
                                          <th>نام فروشنده</th>
                                          <th>نوغ تیل</th>
                                          <th>حالت تیل</th>
                                          <th>تناژ</th>
                                          <th>تعداد موتر</th>
                                          <th>فی</th>
                                          <th>تغییرات</th>
                                      </tr>
                                      </thead>
                                      <tbody>
                                      <?php
                                      foreach ($driver_oil_rows as $key => $value) {?>
                                          <tr class="odd gradeX">
                                              <td><?php echo $value->id;?></td>
                                              <td><?php echo $value->parent_id;?></td>

                                              <td class="center"><?php
                                                  $this->load->model('account_model');
                                                  echo $this->account_model->get_name(array('id'=>$value->buyer_seller_id));
                                                  ?></td>
                                              <td class="center"><?php echo $value->name;?></td>
                                              <td class="center"><?php echo $value->type;?></td>
                                              <td class="center">
                                                  <?php echo $value->amount;?>
                                              </td>
                                              <td class="center"><?php echo $value->car_count;?></td>
                                              <td class="center"><?php echo $value->unit_price;?></td>
                                              <td class="center">
                                                  <a href="<?php echo site_url('stock/driver_oil_delete/'.$value->id) ?>"><span class="glyphicon glyphicon-trash"></span></a>
                                                  <a href="<?php echo site_url('account/edit/'.$value->id) ?>"><span class="glyphicon glyphicon-edit"></span></a>
                                                  <a href="<?php echo site_url('oil/profile/'.$value->parent_id.'/buy'); ?>"><span class="glyphicon glyphicon-asterisk"></span></a>

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
              <div class="row">
                  <div class="col-md-12 col-sm-6">
                      <div class="panel panel-default">
                          <div class="panel-heading">
                              جدول اول تیل های خارج شده جدول دوم تیل های وارد شده از گدام های دیگه
                              <div class="btn-group pull-left">
                                  <select id="filter2">
                                      <option value="debit">debit</option>
                                      <option value="credit">credit</option>
                                  </select>
                                  <i class="fa fa-comments fa-filter" aria-hidden="true"> فیلتر </i>
                              </div>
                          </div>

                          <div class="panel-body">
                              <div class="table-responsive">
                                  <table class="table table-striped table-bordered table-hover" id="dataTables-example3">
                                      <thead>
                                      <tr>
                                          <th>کد</th>
                                          <th>کدام منبا</th>
                                          <th>گدام مقصد</th>
                                          <th>نوغ تیل</th>
                                          <th>تلریخ</th>
                                          <th>تناژ</th>
                                          <th>اسم راننده</th>
                                          <th>فی</th>
                                          <th>تغییرات</th>
                                      </tr>
                                      </thead>
                                      <tbody>
                                      <?php
                                      foreach ($transfer_in as $key => $value) {?>
                                          <tr class="odd gradeX">
                                              <td><?php echo $value->id;?></td>
                                              <td><?php
                                                  $this->load->model('stock_model');
                                                  echo $this->stock_model->get_where_column(array('id'=>$value->stock_id),'name');
                                                  ?>
                                              </td>
                                              <td><?php
                                                  echo $this->stock_model->get_where_column(array('id'=>$value->stock),'name');
                                                  ?></td>
                                              <td class="center"><?php
                                                  echo $this->stock_model->get_where_column(array('id'=>$value->stock_id),'oil_type');
                                                  ?></td>
                                              <td class="center">
                                                  <?php echo $value->f_date;?>
                                              </td>
                                              <td class="center">
                                                  <?php echo $value->amount;?>
                                              </td>
                                              <td><?php
                                                  $this->load->model('stock_model');
                                                  $this->load->model('driver_model');
                                                  $account_id= $this->driver_model->get_where_column(array('st_id'=>$value->id),'driver_id');
                                                  echo $this->account_model->get_where_column(array('id'=>$account_id),'name');
                                                  ?>
                                              </td> 
                                              <td class="center"><?php echo $value->unit_price;?></td>
                                              <td class="center">
                                                  <a href="<?php echo site_url('stock/transfer_delete/'.$value->stock.'/'.$value->stock_id.'/'.$value->id) ?>"><span class="glyphicon glyphicon-trash"></span></a>
                                                  <a href="<?php echo site_url('account/edit/'.$value->id) ?>"><span class="glyphicon glyphicon-edit"></span></a>
                                              </td>
                                          </tr>
                                      <?php }?>
                                      </tbody>
                                  </table>
                              </div>
                          </div>
                          <div class="panel-body">
                              <div class="table-responsive">
                                  <table class="table table-striped table-bordered table-hover" id="dataTables-example2">
                                      <thead>
                                      <tr>
                                          <th>کد</th>
                                          <th>کدام منبا</th>
                                          <th>گدام مقصد</th>
                                          <th>نوغ تیل</th>
                                          <th>تلریخ</th>
                                          <th>تناژ</th>
                                          <th>اسم راننده</th>
                                          <th>فی</th>
                                          <th>تغییرات</th>
                                      </tr>
                                      </thead>
                                      <tbody>
                                      <?php
                                      foreach ($transfer_out as $key => $value) {?>
                                          <tr class="odd gradeX">
                                              <td><?php echo $value->id;?></td>
                                              <td><?php
                                                  $this->load->model('stock_model');
                                                  echo $this->stock_model->get_where_column(array('id'=>$value->stock_id),'name');
                                                  ?>
                                              </td>
                                              <td><?php
                                                  echo $this->stock_model->get_where_column(array('id'=>$value->stock),'name');
                                                  ?></td>
                                              <td class="center"><?php
                                                  echo $this->stock_model->get_where_column(array('id'=>$value->stock_id),'oil_type');
                                                  ?></td>
                                              <td class="center">
                                                  <?php echo $value->f_date;?>
                                              </td>
                                              <td class="center">
                                                  <?php echo $value->amount;?>
                                              </td>
                                              <td><?php
                                                  $this->load->model('stock_model');
                                                  $this->load->model('driver_model');
                                                  $account_id= $this->driver_model->get_where_column(array('st_id'=>$value->id),'driver_id');
                                                  echo $this->account_model->get_where_column(array('id'=>$account_id),'name');
                                                  ?>
                                              </td>
                                              <td class="center"><?php echo $value->unit_price;?></td>
                                              <td class="center">
                                                  <a href="<?php echo site_url('stock/transfer_delete/'.$value->stock.'/'.$value->stock_id.'/'.$value->id) ?>"><span class="glyphicon glyphicon-trash"></span></a>

                                                  <a href="<?php echo site_url('account/edit/'.$value->id) ?>"><span class="glyphicon glyphicon-edit"></span></a>
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
            </div>
             <!-- /. PAGE INNER  -->

              <!-- /. PAGE INNER  -->
              <script src="<?php echo asset_url('js/dataTables/jquery.dataTables.js'); ?>"></script>
              <script src="<?php echo asset_url('js/dataTables/dataTables.bootstrap.js'); ?>"></script>

              <script>
                  $(document).ready(function () {
                      $('#dataTables-example').dataTable();
                      $('#dataTables-example1').dataTable();
                      $('#dataTables-example2').dataTable();
                      $('#dataTables-example3').dataTable();

                  });

                  $('#filter2').change( function() {
                      var filtervalue = this.value;
                      var table2= $('#dataTables-example2').dataTable();
                      table2.fnFilter(filtervalue );
                  });
              </script>