       <!-- /. NAV TOP  -->
        <nav class="navbar-default navbar-side fix-sidebar" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
                    <li>
                        <a  href="<?php echo site_url(''); ?> "><i class="fa fa-dashboard fa-3x"></i> داشبورد</a>
                    </li>
                    <li>
                        <a  href="#"><i><img class="sidebar-menu" src="<?php echo asset_url('img/stock.png'); ?>" alt="stock"/></i> گدام</a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="<?php  echo site_url('stock/add');?>">گدام جدید</a>
                            </li>
                            <li>
                                <a href="<?php  echo site_url('stock/lists');?>">گدام ها</a>
                            </li>
                            <li>
                                <a href="<?php  echo site_url('stock/transfer');?>"> ترانسفر بین گدام ها </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a  href="#"><i><img class="sidebar-menu" src="<?php echo asset_url('img/safebox.png'); ?>" alt="safebox"/></i> صندوق</a>
                    </li>
                    <li  >
                        <a  href="#"><i><img class="sidebar-menu" src="<?php echo asset_url('img/buys.png'); ?>" alt="buys"/></i> خریدها</a>
                        <ul class="nav nav-second-level">

                            <li>
                                <a href="<?php  echo site_url('oil/lists_pre_buy');?>">لیست پیش خرید ها</a>
                            </li>
                            <li>
                                <a href="<?php  echo site_url('oil/pre_buy');?>">پیش خرید جدید</a>
                            </li>
                        </ul>
                    </li>
                    <li  >
                        <a  href="chart.html"><i><img class="sidebar-menu" src="<?php echo asset_url('img/sells.png'); ?>" alt="sells"/></i> فروشات</a>
                        <ul class="nav nav-second-level">
                          
                            <li>
                                <a href="<?php  echo site_url('oil/lists_pre_sell');?>">لیست پیش فروش ها</a>
                            </li>
                            <li>
                                <a href="<?php  echo site_url('oil/pre_sell');?>">پیش فروش جدید</a>
                            </li>
                        </ul>
                    </li>   
                      <li  >
                        <a  href="table.html"><i><img class="sidebar-menu" src="<?php echo asset_url('img/reports.png'); ?>" alt="reports"/></i> گزارشات</a>
                          <ul class="nav nav-second-level">

                              <li>
                                  <a href="<?php  echo site_url('balance/get_total_balance');?>">گزارش کلی</a>
                              </li>
                              <li>
                                  <a href="<?php  echo site_url('balance/account_report');?>">گزارش حساب ها / گدام ها</a>
                              </li>
                              <li>
                                  <a href="<?php  echo site_url('balance/oil_report');?>">گزارش از تیل ها</a>
                              </li>
                          </ul>
                    </li>
                    <li  >
                        <a  href="chart.html"><i><img class="sidebar-menu" src="<?php echo asset_url('img/accounts.png'); ?>" alt="accounts"/></i> حساب ها</a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="<?php echo site_url('account/lists/seller');?>">فروشنده ها</a>
                            </li>
                            <li>
                                <a href="<?php echo site_url('account/lists/customer');?>">فروشنده ها و خریداران</a>
                            </li>
                            <li>
                                <a href="<?php echo site_url('account/lists/exchanger');?>">صرافی ها</a>
                            </li>
                            <li>
                                <a href="<?php echo site_url('account/lists/dealer');?>">کمیشن کارها</a>
                            </li>
                            <li>
                                <a href="<?php echo site_url('account/lists/driver');?>">درایور ها</a>
                            </li>
                            <li>
                                <a href="<?php echo site_url('account/lists/stuff');?>">کارکنان</a>
                            </li>
                            <li>
                                <a href="<?php echo site_url("account/add") ?>">حساب جدید</a>
                            </li>
                        </ul>
                    </li>
                     <li  >
                        <a  href="#"><i><img class="sidebar-menu" src="<?php echo asset_url('img/debit-credit.png'); ?>" alt="debits"/></i> دریافت / پرداخت</a>
                        <ul class="nav nav-second-level">

                            <li>
                                <a href="<?php echo site_url("cash/credit_debit/exchanger") ?>"> بر اساس نام</a>
                            </li>
                            <li>
                                <a href="<?php echo site_url("cash/oil_credit_debit/exchanger") ?>">بر اساس نمبر فاکتور</a>
                            </li>
                        </ul>
                    </li>
                </ul>
               
            </div>
            
        </nav>


        <div id="page-wrapper" >
            <div id="page-inner">