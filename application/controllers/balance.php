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
    public function get_single_balance($id,$type){
        $data['title']="dashboard";
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

        $datepicker=$_POST['datepicker'];
        $datepicker1=$_POST['datepicker1'];
        if($datepicker1!=""){
            $data['total_result']=$this->cash_model->get();
        }



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


    public function profile($id=0,$type){
        $data['fu_page_title']="Login Form";
        /*  $data['account_rows']=$this->cash_model->get_balance_credit_debit_single($id);
          $data['balance_rows']=$this->account_model->get_where(array('id' => $id ,'type' => 'account'));
		$data['buy_rows']=$this->oil_model->get_where(array('buyer_seller_id' => $id ,'buy_sell' => 'buy', 'type'=> 'pre'));
		$data['sell_rows']=$this->oil_model->get_where(array('buyer_seller_id' => $id ,'buy_sell' => 'sell', 'type'=> 'pre'));
		$data['cash_rows']=$this->cash_model->get_where(array('account_id' => $id));*/
        //$data['debit']=$this->cash_model->sum_where(array('account_id' => $id, 'transaction_type'=>'debit'));
        //$data['credit']=$this->cash_model->sum_where(array('account_id' => $id, 'transaction_type'=>'credit'));
        //$data['balance']=$this->cash_model->get_balance($id);

        //	$this->load->template('accounts/profile',$data);

        if($type=="driver"){
            $data['single_balance_rows']=$this->cash_model->get_balance_credit_debit_single(array('account_id' => $id));
            $data['all_debit_credit']=$this->cash_model->get_where(array('account_id' => $id));
            $data['driver_cash_rows']=$this->cash_model->get_where(array('account_id' => $id, 'table_name'=>'driver_transaction'));
            $data['driver_oil_rows']=$this->driver_model->get_where_oil(array('driver_transaction.driver_id' => $id));
            $this->load->template('accounts/driver_profile',$data);
        }

        if($type=="exchanger"){
            $data['all_debit_credit']=$this->cash_model->get_where(array('account_id' => $id));
            $data['type_rows']=$this->cash_model->group_by(array('account_id'=>$id),'type');
            $data['account_rows']=$this->cash_model->get_balance_credit_debit_single($id);
            $data['exchanger_cash_rows']=$this->cash_model->get_where(array('account_id' => $id, 'table_name'=>'account'));
            $data['cash_type_rows']=$this->cash_model->group_by(array('account_id' => $id),'type');

            $this->load->template('accounts/exchanger_profile',$data);
        }

        if($type=="seller"){
            $data['single_balance_rows']=$this->cash_model->get_balance_credit_debit_single(array('account_id' => $id));
            $data['all_debit_credit']=$this->cash_model->get_where(array('account_id' => $id));
            $data['buy_rows']=$this->oil_model->get_where(array('buyer_seller_id' => $id ,'buy_sell' => 'buy', 'type'=> 'pre'));
            $this->load->template('accounts/seller_profile',$data);
        }
        if($type=="customer"){
            $data['cash_rows']=$this->cash_model->get_where(array('account_id' => $id));
            $data['single_balance_rows']=$this->cash_model->get_balance_credit_debit_single(array('account_id' => $id));
            $data['all_debit_credit']=$this->cash_model->get_where(array('account_id' => $id));
            $data['pre_buy_rows']=$this->oil_model->get_where(array('buyer_seller_id' => $id ,'buy_sell' => 'buy', 'type'=> 'pre'));
            $data['pre_sell_rows']=$this->oil_model->get_where(array('buyer_seller_id' => $id ,'buy_sell' => 'sell', 'type'=> 'pre'));
            $data['buy_rows']=$this->oil_model->get_where(array('buyer_seller_id' => $id ,'buy_sell' => 'buy', 'type'=> 'fact'));
            $data['sell_rows']=$this->oil_model->get_where(array('buyer_seller_id' => $id ,'buy_sell' => 'sell', 'type'=> 'fact'));
            $this->load->template('accounts/customer_profile',$data);
        }

        if($type=="stuff"){
            $data['single_balance_rows']=$this->cash_model->get_balance_credit_debit_single(array('account_id' => $id));
            $data['all_debit_credit']=$this->cash_model->get_where(array('account_id' => $id));
            $this->load->template('accounts/stuff_profile',$data);
        }

        if($type=="dealer"){
            $data['single_balance_rows']=$this->cash_model->get_balance_credit_debit_single(array('account_id' => $id));
            $data['all_debit_credit']=$this->cash_model->get_where(array('account_id' => $id));
            $this->load->template('accounts/dealer_profile',$data);
        }
    }
    public function delete($id=0){


        //$this->load->template('accounts/profile',$data);
    }
}
