<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class check extends CI_Controller {

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
        $this->load->template("check/index", $data);
    }

    public function get_check_info($id){
        $data['title']="dashboard";
        $data['check_info'] = $this->check_model->get_where(array('cash_id'=>$id));
        $this->load->popupp("check/get_check_info", $data);

    }
    public function lists($type)
    {
        $data['title']="dashboard";
        $data['account_rows'] = $this->account_model->get_where(array('type'=>$type));
        $this->load->template("Accounts/lists", $data);
    }
    public function credit_debit(){
        $data['title']="dashboard";
        $this->form_validation->set_rules('amount' , null, 'required',
            array(
                'required'      => 'You have not provided name in name field'
            )
        );
        /*        $this->form_validation->set_rules('account_name' , null, 'alpha_int|required',
                    array(
                        'required'      => 'You have not provided name in name field',
                        'alpha_int'         =>'please insert just alghabatic charecters'
                    )
                );*/
        function alpha_int($str)
        {
            $ci =& get_instance();
            $str = (strtolower($ci->config->item('charset')) != 'utf-8') ? utf8_encode($str) : $str;

            return ( ! preg_match("/^[[:alpha:]- چجحخهعغفقثصضشسیبلاتنمکگپظطزرذدئو_.]+$/", $str)) ? FALSE : TRUE;
        }
        if($this->form_validation->run()==false){

            $data['signup_form']="active";
            $this->load->template('cash/credit_debit', $data);
        }else {

            $cash_information = array(
                'cash' => $this->db->escape_str($this->input->post('amount')),
                'type' => $this->input->post('type'),
                'transaction_type' => $this->input->post('transaction_type'),
                'account_id' => $this->account_model->get_column(array('name'=>$this->input->post('account_name')),'id')

            );

            $cash_id=  $this->cash_model->insert($cash_information);
            if($this->input->post('type')=="check"){
                $this->check_type($cash_id);
            }else {
                $this->load->template('cash/credit_debit', $data);
            }
        }

    }


    function get_accounts(){

        if (isset($_GET['term'])){
            $q = strtolower($_GET['term']);
            echo $this->account_model->accounts_json($q);
        }
    }
    function stock_transactions_json(){

        if (isset($_GET['term'])){
            $q = strtolower($_GET['term']);
            print_r( $this->oil_model->srock_transactions_json($q));
        }
    }
    public function add(){

        $this->form_validation->set_rules('name' , null, 'alpha_int|required',
            array(
                'required'      => 'You have not provided name in name field',
                'alpha_int'         =>'please insert just alghabatic charecters'
            )
        );
        $this->form_validation->set_rules('lname' , null, 'alpha_int|required',
            array(
                'required'      => 'You have not provided name in name field',
                'alpha_int'         =>'please insert just alghabatic charecters'
            )
        );

        $this->form_validation->set_rules('phone' , null, 'is_natural|required|regex_match[/^[0-9]{10}$/]',
            array(
                'required'      => 'You have not provided name in name field',
                'is_natural'         =>'Please Use Just numberic charecters'
            )
        );

        function alpha_int($str)
        {
            $ci =& get_instance();
            $str = (strtolower($ci->config->item('charset')) != 'utf-8') ? utf8_encode($str) : $str;

            return ( ! preg_match("/^[[:alpha:]- چجحخهعغفقثصضشسیبلاتنمکگپظطزرذدئو_.]+$/", $str)) ? FALSE : TRUE;
        }
        $data['account_rows']=$this->account_model->group_by('type');
        if($this->form_validation->run()==false){

            $data['signup_form']="active";
            $this->load->template('accounts/add',$data);
        }else{

            $cantact_info=array(
                'name'=>$this->db->escape_str($this->input->post('name')),
                'lname'=>$this->db->escape_str($this->input->post('lname')),
                'type'=>$this->db->escape_str($this->input->post('type')),
                'phone'=>$this->db->escape_str($this->input->post('phone'))
            );

            $id=$this->account_model->insert($cantact_info);

            $data['fu_page_title']="Login Form";
            redirect('account/profile/'.$id.'/'.$this->input->post('type'));
            // $this->profile($id);
        }


    }


    public function delete($id=0){


        //$this->load->template('accounts/profile',$data);
    }
}
