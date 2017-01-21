<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class balance extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     *	- or -
     * 		http://example.com/index.php/welcome/index
     *	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */
    public function __construct()
    {
        parent::__construct();
        permission();
    }
    public function index()
    {
        $data['title']="dashboard";
        $this->load->template("Accounts/index", $data);
    }

    public function lists($type)
    {
        $data['title']="dashboard";
        $data['account_rows'] = $this->account_model->get_where(array('type'=>$type));
        $this->load->template("Accounts/lists", $data);
    }

    public function get_total_balance(){
        $data['title']="dashboard";
        $data['account_rows'] = $this->account_model->get();
        $this->load->template("balance/get_total_balance", $data);

}
    
    public function account_report(){

        $id=$this->db->escape_str($this->input->post("id"));
        $type=$this->db->escape_str($this->input->post("type"));
        $firstdate=$this->db->escape_str($this->input->post("firstdate"));
        $seconddate=$this->db->escape_str($this->input->post("seconddate"));
        $this->form_validation->set_rules('firstdate' , null, 'required',
            array(
                'required'      => 'You have not provided name in name field'
            )
        );
        $this->form_validation->set_rules('seconddate' , null, 'required',
            array(
                'required'      => 'You have not provided name in name field'
            )
        );
        $this->form_validation->set_rules('id' , null, 'required',
            array(
                'required'      => 'You have not provided name in name field'
            )
        );
        if($this->form_validation->run()==false){
            $this->load->template("balance/account_report");
        }else{

            if($this->db->escape_str($this->input->post("type"))=="stock"){
                $stock_type=$this->stock_model->get_where_column(array('id'=>$id),'type');
            if($stock_type=="fact"){

                $data['fact_oilbuy_rows']=$this->oil_model->get_where(
                  array(
                      'stock_id'=>$this->db->escape_str($this->input->post("id")),
                      'stock'=>0,
                      'type'=>'fact',
                      'buy_sell'=>'buy',
                      'f_date>='=>$this->db->escape_str($this->input->post("firstdate")),
                      'f_date<='=>$this->db->escape_str($this->input->post("firstdate"))
                      ));

                $data['fact_oilsell_rows']=$this->oil_model->get_where(
                    array(
                        'stock_id'=>$this->db->escape_str($this->input->post("id")),
                        'stock'=>0,
                        'type'=>'fact',
                        'buy_sell'=>'sell',
                        'f_date>='=>$this->db->escape_str($this->input->post("firstdate")),
                        'f_date<='=>$this->db->escape_str($this->input->post("firstdate"))
                    ));

                $data['transfer_in']=$this->oil_model->get_where(
                    array(
                        'stock_id'=>$this->db->escape_str($this->input->post("id")),
                        'buyer_seller_id'=>0,
                        'type'=>'fact',
                        'f_date>='=>$this->db->escape_str($this->input->post("firstdate")),
                        'f_date<='=>$this->db->escape_str($this->input->post("firstdate"))));

                $data['transfer_out']=$this->oil_model->get_where(
                    array(
                        'stock'=>$this->db->escape_str($this->input->post("id")),
                        'type'=>'fact',
                        'f_date>='=>$this->db->escape_str($this->input->post("firstdate")),
                        'f_date<='=>$this->db->escape_str($this->input->post("firstdate"))));

                $data['stock_rows']=$this->stock_model->get_where(
                    array('id'=>$this->db->escape_str($this->input->post("id"))));

                $data['driver_oil_rows']=$this->driver_model->get_where_oil(
                    array(
                        'stock_id' => $this->db->escape_str($this->input->post("id")),
                        'type'=>'fact',
                        'f_date>='=>$this->db->escape_str($this->input->post("firstdate")),
                        'f_date<='=>$this->db->escape_str($this->input->post("firstdate"))));
                $this->load->template("balance/stock_account_report_fact",$data);


                }else{
                $data['pre_oil_rows']=$this->oil_model->get_where(
                    array(
                        'stock_id' =>$this->db->escape_str($this->input->post("id")),
                        'type'=>'pre',
                        'f_date>='=>$this->db->escape_str($this->input->post("firstdate")),
                        'f_date<='=>$this->db->escape_str($this->input->post("firstdate"))));
                $data['stock_rows']=$this->stock_model->get_where(
                    array('id'=>$this->db->escape_str($this->input->post("id"))));
            $this->load->template("balance/stock_account_report_pre",$data);
            }}

            if ($type=="account"){
                $account_type=$this->account_model->get_where_column(array('id'=>$id),'type');
                if($account_type=="driver"){
                    $data['driver_oil_rows']=$this->driver_model->get_where_oil(array('driver_transaction.driver_id' => $id));

                    $data['account_rows'] = $this->account_model->get_where(array('id' => $id));
                    $data['all_debit_credit']=$this->cash_model->get_where(array('account_id' => $id));
                    $data['all_credit']=$this->cash_model->get_where(
                        array(
                            'account_id' => $id,
                            'transaction_type'=>'credit',
                            'date>='=>$firstdate,
                            'date<='=>$seconddate
                        ));
                    $data['all_debit']=$this->cash_model->get_where(
                        array(
                            'account_id' => $id,
                            'transaction_type'=>'debit',
                            'date>='=>$firstdate,
                            'date<='=>$seconddate
                        ));
                    $this->load->template('balance/driver_profile',$data);
                }

                if($account_type=="exchanger"){
                    $data['type_rows']=$this->cash_model->group_by(array('account_id'=>$id),'type');
                    $data['account_rows']=$this->account_model->get_where(array('id'=>$id));
                    $data['exchanger_cash_rows']=$this->cash_model->get_where(array('account_id' => $id, 'table_name'=>'account'));
                    $data['all_credit']=$this->cash_model->get_where(
                        array(
                            'account_id' => $id,
                            'transaction_type'=>'debit',
                            'date>='=>$firstdate,
                            'date<='=>$seconddate
                        ));
                    $data['all_debit']=$this->cash_model->get_where(
                        array(
                            'account_id' => $id,
                            'transaction_type'=>'credit',
                            'date>='=>$firstdate,
                            'date<='=>$seconddate
                        ));
                    $data['firstdate']=$firstdate;
                    $data['seconddate']=$seconddate;
                    $data['cash_type_rows']=$this->cash_model->group_by(array('account_id' => $id),'type');

                    $this->load->template('balance/exchanger_profile',$data);
                }

                if($account_type=="seller"){
                   // $data['buy_rows']=$this->oil_model->get_where(array('buyer_seller_id' => $id ,'buy_sell' => 'buy', 'type'=> 'pre'));

                    $data['account_rows'] = $this->account_model->get_where(array('id' => $id));
                    $data['single_balance_rows']=$this->cash_model->get_balance_credit_debit_single(array('account_id' => $id));
                    $data['all_credit']=$this->cash_model->get_where(
                        array(
                            'account_id' => $id,
                            'transaction_type'=>'credit',
                            'date>='=>$firstdate,
                            'date<='=>$seconddate
                        ));
                    $data['all_debit']=$this->cash_model->get_where(
                        array(
                            'account_id' => $id,
                            'transaction_type'=>'debit',
                            'date>='=>$firstdate,
                            'date<='=>$seconddate
                        ));

                    $this->load->template('balance/seller_profile',$data);
                }
                if($account_type=="customer"){

                    $data['account_rows'] = $this->account_model->get_where(array('id' => $id));
                    $data['cash_rows']=$this->cash_model->get_where(array('account_id' => $id));
                    $data['single_balance_rows']=$this->cash_model->get_balance_credit_debit_single(array('account_id' => $id));
                    $data['all_credit_sell']=$this->cash_model->get_where_oil(
                        array(
                            'account_id' => $id,
                            'transaction_type'=>'credit',
                            'date>='=>$firstdate,
                            'date<='=>$seconddate,
                            'table_name'=>'stock_transaction'
                        ),'sell');

                    $data['all_debit_buy']=$this->cash_model->get_where_oil(
                        array(
                            'account_id' => $id,
                            'transaction_type'=>'debit',
                            'date>='=>$firstdate,
                            'date<='=>$seconddate,
                            'table_name'=>'stock_transaction'
                        ),'buy');
                    $data['all_debit_sell']=$this->cash_model->get_where_oil(
                        array(
                            'account_id' => $id,
                            'transaction_type'=>'debit',
                            'date>='=>$firstdate,
                            'date<='=>$seconddate,
                            'table_name'=>'stock_transaction'
                        ),'sell');

                    $data['all_credit_buy']=$this->cash_model->get_where_oil(
                        array(
                            'account_id' => $id,
                            'transaction_type'=>'credit',
                            'date>='=>$firstdate,
                            'date<='=>$seconddate,
                            'table_name'=>'stock_transaction'
                        ),'buy');
                    $data['pre_buy_rows']=$this->oil_model->get_where(array('buyer_seller_id' => $id ,'buy_sell' => 'buy', 'type'=> 'pre'));
                    $data['pre_sell_rows']=$this->oil_model->get_where(array('buyer_seller_id' => $id ,'buy_sell' => 'sell', 'type'=> 'pre'));
                    $data['buy_rows']=$this->oil_model->get_where(array('buyer_seller_id' => $id ,'buy_sell' => 'buy', 'type'=> 'fact'));
                    $data['sell_rows']=$this->oil_model->get_where(array('buyer_seller_id' => $id ,'buy_sell' => 'sell', 'type'=> 'fact'));
                    $this->load->template('balance/customer_profile',$data);
                }

                if($account_type=="stuff"){
                    $data['account_rows'] = $this->account_model->get_where(array('id' => $id));
                    $data['single_balance_rows']=$this->cash_model->get_balance_credit_debit_single(array('account_id' => $id));
                    $data['all_debit_credit']=$this->cash_model->get_where(
                        array(
                            'account_id' => $id,
                            'date>='=>$firstdate,
                            'date<='=>$seconddate
                        ));

                    $this->load->template('balance/stuff_profile',$data);
                }

                if($account_type=="dealer"){
                    $data['all_debit_credit']=$this->cash_model->get_where(
                        array(
                            'account_id' => $id,
                            'date>='=>$firstdate,
                            'date<='=>$seconddate
                            ));
                    $data['all_credit']=$this->cash_model->get_where(
                        array(
                            'account_id' => $id,
                            'transaction_type'=>'debit',
                            'date>='=>$firstdate,
                            'date<='=>$seconddate
                        ));
                    $data['all_debit']=$this->cash_model->get_where(
                        array(
                            'account_id' => $id,
                            'transaction_type'=>'credit',
                            'date>='=>$firstdate,
                            'date<='=>$seconddate
                        ));

                    $data['type_rows']=$this->cash_model->group_by(array('account_id'=>$id),'type');
                    $data['account_rows']=$this->account_model->get_where(array('id'=>$id));
                    $data['exchanger_cash_rows']=$this->cash_model->get_where(array('account_id' => $id, 'table_name'=>'account'));
                    $data['cash_type_rows']=$this->cash_model->group_by(array('account_id' => $id),'type');
                    $data['firstdate']=$firstdate;
                    $data['seconddate']=$seconddate;
                    $this->load->template('balance/dealer_profile',$data);
                }
            }

            if ($type=="prebuy"){
                $data['oil_rows']=$this->oil_model->get_where(
                    array(
                        'type' => 'pre',
                        'buyer_seller_id'=>$id,
                        'buy_sell'=>'buy',
                        'f_date>='=>$firstdate,
                        'f_date<='=>$seconddate
                    ));
                $this->load->template("balance/prebuy_report",$data);
            }

            if ($type=="presell"){
                $data['oil_rows']=$this->oil_model->get_where(
                    array(
                        'type' => 'pre',
                        'buyer_seller_id'=>$id,
                        'buy_sell'=>'sell',
                        'f_date>='=>$firstdate,
                        'f_date<='=>$seconddate
                    ));
                $this->load->template("balance/presell_report",$data);
            }

            if ($type=="buy"){
                $data['fact_oilbuy_rows']=$this->oil_model->get_where(
                    array(
                        'type'=>'fact',
                        'buyer_seller_id'=>$id,
                        'buy_sell'=>'buy',
                        'stock'=>0,
                        'f_date>='=>$firstdate,
                        'f_date<='=>$seconddate
                    ));
                $this->load->template("balance/buy_report",$data);
            }

            if ($type=="sell"){
                $data['fact_oilsell_rows']=$this->oil_model->get_where(
                    array(
                        'type'=>'fact',
                        'buy_sell'=>'sell',
                        'buyer_seller_id'=>$id,
                        'stock'=>0,
                        'f_date>='=>$firstdate,
                        'f_date<='=>$seconddate
                    ));
                $this->load->template("balance/sell_report",$data);
            }
        }

    }
    public function oil_report(){

        $id=$this->db->escape_str($this->input->post("id"));
        $type=$this->db->escape_str($this->input->post("type"));
        $firstdate=$this->db->escape_str($this->input->post("firstdate"));
        $seconddate=$this->db->escape_str($this->input->post("seconddate"));
        $this->form_validation->set_rules('firstdate' , null, 'required',
            array(
                'required'      => 'You have not provided name in name field'
            )
        );

        if($this->form_validation->run()==false){
            $this->load->template("balance/oil_report");
        }else{

            if ($type=="prebuy"){
                $data['oil_rows']=$this->oil_model->get_where(
                    array(
                        'type' => 'pre',
                        'buy_sell'=>'buy',
                        'f_date>='=>$firstdate,
                        'f_date<='=>$seconddate
                    ));
                $this->load->template("balance/prebuy_report",$data);
            }

            if ($type=="presell"){
                $data['oil_rows']=$this->oil_model->get_where(
                    array(
                        'type' => 'pre',
                        'buy_sell'=>'sell',
                        'f_date>='=>$firstdate,
                        'f_date<='=>$seconddate
                    ));
                $this->load->template("balance/presell_report",$data);
            }

            if ($type=="buy"){
                $data['fact_oilbuy_rows']=$this->oil_model->get_where(
                    array(
                        'type'=>'fact',
                        'buy_sell'=>'buy',
                        'stock'=>0,
                        'f_date>='=>$firstdate,
                        'f_date<='=>$seconddate
                    ));
                $this->load->template("balance/buy_report",$data);
            }

            if ($type=="sell"){
                $data['fact_oilsell_rows']=$this->oil_model->get_where(
                    array(
                        'type'=>'fact',
                        'buy_sell'=>'sell',
                        'stock'=>0,
                        'f_date>='=>$firstdate,
                        'f_date<='=>$seconddate
                    ));
                $this->load->template("balance/sell_report",$data);
            }
        }

    }
    public function get_single_balance($id,$type){
        $data['title']="dashboard";
        $data['dalar']='';
        $data['af']='';
        $data['ir']='';
        $data['eur']='';
        switch ($type){
            case "stuff":
                $type=array('af'=>'افغانی');
                break;

            case "driver":
                $type=array('ir'=>'تومان');
                break;

            case "exchanger":
                $type=array(
                    'usa'=>'دالر',
                    'af'=>'افغانی',
                    'usa'=>'دالر',
                    'eur'=>'یرو',
                    'ir'=>'تومان'
                );
                break;

            default:
                $money_type=array('usa'=>'دالر');
        }
        $data['money_type']=$money_type;
        $data['account_rows'] = $this->account_model->get_where(array('id'=>$id,'type'=>$type));
        $this->load->template("balance/get_single_balance", $data);

    }
    function get_total_balance_result(){

        $data['stock_rows']=$this->stock_model->get();
        $data['account_rows']=$this->account_model->order_by('type');
        $data['dalar']='';
        $data['af']='';
        $data['ir']='';
        $data['eur']='';

        $this->load->popupp('balance/get_total_balance_result',$data);
    }

    function get_single_balance_result(){

        $datepicker=$_POST['datepicker'];
        $datepicker1=$_POST['datepicker1'];
        $account_id=$_POST['account_id'];

        $data['single_result']=$this->cash_model->get_where(array('date(date)>='=>$datepicker, 'date(date)<='=>$datepicker1,'account_id'=>$account_id));
        $this->load->popupp('balance/get_single_balance_result',$data);
    }
    function balance_check_out($id){
        $this->form_validation->set_rules('date' , null, 'required',
            array(
                'required'      => 'You have not provided name in name field'
            )
        );

        $data['date']=$this->shamci_date->get_today_date();
        $data['date_time']=$this->shamci_date->get_today_datetime();
        $data['get_balance_date']=$this->balance_model->get_balance_datetime(array('table_id'=>$id,'table_name'=>'account'));
        $data['check_last_balance']=$this->balance_model->get_where_num_rows(array('table_id'=>$id,'table_name'=>'account','date(date)'=>$data['date']));
        $data['last_balance']=$this->balance_model->get_where_desc(array('table_id'=>$id,'table_name'=>'account','date(date)'=>$data['date']));

        $data['single_balance_rows']=$this->cash_model->get_balance_credit_debit_single(array('account_id' => $id),$data['get_balance_date']);

        $data['id']=$id;

        if($this->form_validation->run()==false){

            $data['signup_form']="active";
            $this->load->template("balance/balance_check_out", $data);
        }else{

            $balance_info=array(
                'debit_buy'=>$this->db->escape_str($this->input->post('debit')),
                'credit_sell'=>$this->db->escape_str($this->input->post('credit')),
                'date'=>$this->db->escape_str($this->input->post('date')),
                'table_name'=>'account',
                'balance'=>$this->db->escape_str($this->input->post('balance')),
                'table_id'=>$id
            );


            $balance_id=$this->balance_model->insert($balance_info);

            if($this->db->escape_str($this->input->post('balance'))>0){
                $cash_information = array(
                    'cash' => $this->db->escape_str($this->input->post('balance')),
                    'type' => $this->input->post('type'),
                    'date' => $this->db->escape_str($this->input->post('date')),
                    'transaction_type' => 'credit',
                    'account_id' => $id,
                    'table_id'=>$balance_id,
                    'table_name'=>'balance'

                );

            }else{
                $cash_information = array(
                    'cash' => abs($this->db->escape_str($this->input->post('balance'))),
                    'type' => $this->input->post('type'),
                    'date' => $this->db->escape_str($this->input->post('date')),
                    'transaction_type' => 'debit',
                    'account_id' => $id,
                    'table_id'=>$balance_id,
                    'table_name'=>'balance'

                );
            }
                $id=  $this->cash_model->insert($cash_information);




            //$account_id=$this->balance_model->insert($cantact_info);


            $data['fu_page_title']="Login Form";

           redirect($_SESSION['url']);

            // $this->profile($id);
        }

    }

    function balance_check_out_multy($id,$type){
        $this->form_validation->set_rules('date' , null, 'required',
            array(
                'required'      => 'You have not provided name in name field'
            )
        );

        $data['date']=$this->shamci_date->get_today_date();
        $data['date_time']=$this->shamci_date->get_today_datetime();
        $data['get_balance_date']=$this->balance_model->get_balance_datetime(array('table_id'=>$id,'table_name'=>'account'));
        $data['check_last_balance']=$this->balance_model->get_where_num_rows(array('table_id'=>$id,'table_name'=>'account','date(date)'=>$data['date'],'balance_type'=>$type));
        $data['last_balance']=$this->balance_model->get_where_desc(array('table_id'=>$id,'table_name'=>'account','date(date)'=>$data['date']));

        $data['multy_balance_rows']=$this->cash_model->get_balance_credit_debit_mylty_money(array('account_id' => $id),$type,$data['get_balance_date']);

        $data['id']=$id;
        $data['type']=$type;

        if($this->form_validation->run()==false){

            $data['signup_form']="active";
            $this->load->template("balance/balance_check_out_multy", $data);
        }else{

            $balance_info=array(
                'debit_buy'=>$this->db->escape_str($this->input->post('debit')),
                'credit_sell'=>$this->db->escape_str($this->input->post('credit')),
                'date'=>$this->db->escape_str($this->input->post('date')),
                'table_name'=>'account',
                'balance'=>$this->db->escape_str($this->input->post('balance')),
                'table_id'=>$id,
                'balance_type'=>$this->input->post('type')
            );

            $balance_id=$this->balance_model->insert($balance_info);

            if($this->db->escape_str($this->input->post('balance'))>0){
                $cash_information = array(
                    'cash' => $this->db->escape_str($this->input->post('balance')),
                    'type' => $this->input->post('type'),
                    'date' => $this->db->escape_str($this->input->post('date')),
                    'transaction_type' => 'credit',
                    'account_id' => $id,
                    'table_id'=>$balance_id,
                    'table_name'=>'balance'

                );

            }else{
                $cash_information = array(
                    'cash' => abs($this->db->escape_str($this->input->post('balance'))),
                    'type' => $this->input->post('type'),
                    'date' => $this->db->escape_str($this->input->post('date')),
                    'transaction_type' => 'debit',
                    'account_id' => $id,
                    'table_id'=>$balance_id,
                    'table_name'=>'balance'

                );
            }
            $id=  $this->cash_model->insert($cash_information);
            //$account_id=$this->balance_model->insert($cantact_info);
            $data['fu_page_title']="Login Form";

            redirect($_SESSION['url']);

            // $this->profile($id);
        }

    }

    public function delete($id=0){


        //$this->load->template('accounts/profile',$data);
    }

    public function load_accounts($type){

        if($type=="stock"){
            $stock=$this->stock_model->get_where(array('type'=>'fact'));
            echo "<lable>گدام ها</lable>
                  <select class='form-control' name='id'>";

            foreach ($stock as $key => $value){
                echo "<option value='".$value->id."'>".$value->name."</option>";
            }

            echo "</select>";
        }else if($type=="account"){
            $stock=$this->account_model->group_by(array(),'type');
            echo "<lable>حساب ها</lable>
                  <select class='form-control' id='account'>
                  <option>انتخاب یک گروه</option>";

            foreach ($stock as $key => $value){
                echo "<option value='".$value->type."'>";
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
                    echo "</option>";
            }

            echo "</select>";
        }else{
            echo "<lable>نمبر فاکتور </lable>";
            ?>
        <input type='text'  value='<?php echo set_value('id'); ?>' name='id' class='form-control'/>
        <span class="help-inline"><?php echo (form_error('id') ) ? form_error('id') : "<span class='red'>*</span>"; ?></span>
            <?php


}

    }
    public function account($type){

            $stock=$this->account_model->get_where(array('type'=>$type));
            echo "<lable>ایدی مورد نظر</lable>
                  <select class='form-control' name='id' id='accounts'>";

            foreach ($stock as $key => $value){
                echo "<option value='".$value->id."'>".$value->name." ".$value->lname."</option>";
            }

            echo "</select>";
        }
}
