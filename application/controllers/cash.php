<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Cash extends CI_Controller
{

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     *        http://example.com/index.php/welcome
     *    - or -
     *        http://example.com/index.php/welcome/index
     *    - or -
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
        // permission();
    }

    public function index()
    {

        // $shamci_date=new shamci_date();

        // echo  get_today_date();

        $data['title'] = "dashboard";
        //$this->load->template("Accounts/index", $data);
    }


    public function lists($type)
    {
        $data['title'] = "dashboard";
        $data['account_rows'] = $this->account_model->get_where(array('type' => $type));
        $this->load->template("Accounts/lists", $data);
    }

    public function credit_debit($account_type)
    {
        $this->session->set_userdata('url', $this->router->fetch_class() . '/' . $this->router->fetch_method() . '/' . $this->uri->segment(3));
        switch ($account_type) {
            case "stuff":
                $money_type = array('af' => 'افغانی');
                break;

            case "driver":
                $money_type = array('ir' => 'تومان');
                break;

            case "exchanger":
                $money_type = array(
                    'usa' => 'دالر',
                    'af' => 'افغانی',
                    'eur' => 'یرو',
                    'ir' => 'تومان',
                    'klp' => 'کلدار'
                );
                break;
            case "dealer":
                $money_type = array(
                    'usa' => 'دالر',
                    'af' => 'افغانی',
                    'eur' => 'یرو',
                    'ir' => 'تومان',
                    'klp' => 'کلدار'
                );
                break;
            default:
                $money_type = array('usa' => 'دالر');
        }
        $data['money_type'] = $money_type;
        $data['title'] = "dashboard";

        $data['date'] = $this->shamci_date->get_today_datetime();
        $this->form_validation->set_rules('amount', null, 'required',
            array(
                'required' => 'You have not provided name in name field'
            )
        );
        $this->form_validation->set_rules('account_name', null, 'alpha_int|required',
            array(
                'required' => 'You have not provided name in name field',
                'alpha_int' => 'please insert just alghabatic charecters'
            )
        );
        function alpha_int($str)
        {
            $ci =& get_instance();
            $str = (strtolower($ci->config->item('charset')) != 'utf-8') ? utf8_encode($str) : $str;

            return (!preg_match("/^[[:alpha:]- چجحخهعغفقثصضشسیبلاتنمکگپظطزرذدئو_.]+$/", $str)) ? FALSE : TRUE;
        }

        if ($this->form_validation->run() == false) {

            $data['signup_form'] = "active";
            $this->load->template('cash/credit_debit', $data);
        } else {

            $cash_information = array(
                'cash' => $this->db->escape_str($this->input->post('amount')),
                'type' => $this->input->post('type'),
                'date' => $this->input->post('date'),
                'desc' => $this->db->escape_str($this->input->post('desc')),
                'transaction_type' => $this->input->post('transaction_type'),
                'account_id' => $this->account_model->get_where_column(array('name' => $this->input->post('account_name')), 'id')

            );
            $cash_id = $this->cash_model->insert($cash_information);
            if ($this->input->post('type') == "check") {
                $this->check_type($cash_id, $account_type);
            } else {
                $this->load->template('cash/credit_debit', $data);
            }
        }

    }

    public function profile_credit_debit($account_id, $account_type)
    {
        $this->session->set_userdata('url', $this->router->fetch_class() . '/' . $this->router->fetch_method() . '/' . $this->uri->segment(3) . '/' . $this->uri->segment(4));
        switch ($account_type) {
            case "stuff":
                $money_type = array('af' => 'افغانی');
                break;

            case "driver":
                $money_type = array('ir' => 'تومان');
                break;

            case "exchanger":
                $money_type = array(
                    'usa' => 'دالر',
                    'af' => 'افغانی',
                    'eur' => 'یرو',
                    'ir' => 'تومان',
                    'klp' => 'کلدار'
                );
                break;

            default:
                $money_type = array('usa' => 'دالر');
        }
        $data['money_type'] = $money_type;
        $data['account_id'] = $account_id;
        $data['title'] = "dashboard";
        $data['date'] = $this->shamci_date->get_today_datetime();
        $this->form_validation->set_rules('amount', null, 'required',
            array(
                'required' => 'You have not provided name in name field'
            )
        );

        function alpha_int($str)
        {
            $ci =& get_instance();
            $str = (strtolower($ci->config->item('charset')) != 'utf-8') ? utf8_encode($str) : $str;

            return (!preg_match("/^[[:alpha:]- چجحخهعغفقثصضشسیبلاتنمکگپظطزرذدئو_.]+$/", $str)) ? FALSE : TRUE;
        }

        if ($this->form_validation->run() == false) {

            $data['signup_form'] = "active";
            $this->load->template('cash/profile_credit_debit', $data);
        } else {

            $cash_information = array(
                'cash' => $this->db->escape_str($this->input->post('amount')),
                'type' => $this->input->post('type'),
                'date' => $this->input->post('date'),
                'desc' => $this->db->escape_str($this->input->post('desc')),
                'transaction_type' => $this->input->post('transaction_type'),
                'account_id' => $this->input->post('account_id')

            );

            $cash_id = $this->cash_model->insert($cash_information);
            if ($this->input->post('type') == "check") {
                $this->check_type($cash_id, $account_type);
            } else {
                $this->load->template('cash/profile_credit_debit', $data);
            }
        }

    }

    public function oil_credit_debit($account_type)
    {
        $this->session->set_userdata('url', $this->router->fetch_class() . '/' . $this->router->fetch_method() . '/' . $this->uri->segment(3));

        switch ($account_type) {
            case "stuff":
                $money_type = array('af' => 'افغانی');
                break;

            case "driver":
                $money_type = array('ir' => 'تومان');
                break;

            case "exchanger":
                $money_type = array(
                    'usa' => 'دالر',
                    'af' => 'افغانی',
                    'eur' => 'یرو',
                    'ir' => 'تومان',
                    'klp' => 'کلدار'
                );
                break;

            default:
                $money_type = array('usa' => 'دالر');
        }
        $data['money_type'] = $money_type;
        $data['title'] = "dashboard";
        $data['date'] = $this->shamci_date->get_today_datetime();
        $this->form_validation->set_rules('amount', null, 'required',
            array(
                'required' => 'You have not provided name in name field'
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

            return (!preg_match("/^[[:alpha:]- چجحخهعغفقثصضشسیبلاتنمکگپظطزرذدئو_.]+$/", $str)) ? FALSE : TRUE;
        }

        if ($this->form_validation->run() == false) {

            $data['signup_form'] = "active";
            $this->load->template('cash/oil_credit_debit', $data);
        } else {

            $cash_information = array(
                'cash' => $this->db->escape_str($this->input->post('amount')),
                'type' => $this->input->post('type'),
                'date' => $this->input->post('date'),
                'desc' => $this->db->escape_str($this->input->post('desc')),
                'transaction_type' => $this->input->post('transaction_type'),
                'account_id' => $this->oil_model->get_column(array('id' => $this->db->escape_str($this->input->post('st_id'))), 'buyer_seller_id'),
                'table_id' => $this->db->escape_str($this->input->post('st_id')),
                'table_name' => 'stock_transaction'

            );

            $cash_id = $this->cash_model->insert($cash_information);
            if ($this->input->post('type') == "check") {
                $this->check_type($cash_id, $account_type);
            } else {
                $this->load->template('cash/oil_credit_debit', $data);
            }
        }

    }

    public function profile_oil_credit_debit($account_id, $account_type)
    {
        $this->session->set_userdata('url', $this->router->fetch_class() . '/' . $this->router->fetch_method() . '/' . $this->uri->segment(3) . '/' . $this->uri->segment(4));
        switch ($account_type) {
            case "stuff":
                $money_type = array('af' => 'افغانی');
                break;

            case "driver":
                $money_type = array('ir' => 'تومان');
                break;

            case "exchanger":
                $money_type = array(
                    'usa' => 'دالر',
                    'af' => 'افغانی',
                    'eur' => 'یرو',
                    'ir' => 'تومان',
                    'klp' => 'کلدار'
                );
                break;

            default:
                $money_type = array('usa' => 'دالر');
        }
        $data['money_type'] = $money_type;
        $data['title'] = "dashboard";
        $data['account_id'] = $account_id;
        $data['date'] = $this->shamci_date->get_today_datetime();
        $this->form_validation->set_rules('amount', null, 'required',
            array(
                'required' => 'You have not provided name in name field'
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

            return (!preg_match("/^[[:alpha:]- چجحخهعغفقثصضشسیبلاتنمکگپظطزرذدئو_.]+$/", $str)) ? FALSE : TRUE;
        }

        if ($this->form_validation->run() == false) {

            $data['signup_form'] = "active";
            $this->load->template('cash/profile_oil_credit_debit', $data);
        } else {

            $cash_information = array(
                'cash' => $this->db->escape_str($this->input->post('amount')),
                'desc' => $this->db->escape_str($this->input->post('desc')),
                'type' => $this->input->post('type'),
                'date' => $this->input->post('date'),
                'transaction_type' => $this->input->post('transaction_type'),
                'account_id' => $this->input->post('account_id'),
                'table_id' => $this->db->escape_str($this->input->post('st_id')),
                'table_name' => 'stock_transaction'

            );

            $cash_id = $this->cash_model->insert($cash_information);
            if ($this->input->post('type') == "check") {
                $this->check_type($cash_id, $account_type);
            } else {
                $this->load->template('cash/profile_oil_credit_debit', $data);
            }
        }

    }

    public function debit_deal($id, $type)
    {
        $this->session->set_userdata('url', $this->router->fetch_class() . '/' . $this->router->fetch_method() . '/' . $this->uri->segment(3) . '/' . $this->uri->segment(4));

        $data['id'] = $id;
        $data['type'] = $type;
        $data['money_type'] = $money_type = array(
            'usa' => 'دالر',
            'ir' => 'تومان'
        );
        // $data['account_id']=$account_id;
        $data['title'] = "dashboard";
        $data['date'] = $this->shamci_date->get_today_datetime();
        $this->form_validation->set_rules('st_id', null, 'required',
            array(
                'required' => 'You have not provided name in name field'
            )
        );

        function alpha_int($str)
        {
            $ci =& get_instance();
            $str = (strtolower($ci->config->item('charset')) != 'utf-8') ? utf8_encode($str) : $str;

            return (!preg_match("/^[[:alpha:]- چجحخهعغفقثصضشسیبلاتنمکگپظطزرذدئو_.]+$/", $str)) ? FALSE : TRUE;
        }

        if ($this->form_validation->run() == false) {
            $data['signup_form'] = "active";
            $this->load->template('cash/debit_deal', $data);
        } else {
            $dealer_information = array(
                'st_id' => $this->db->escape_str($this->input->post('st_id')),
                'unit_price' => $this->db->escape_str($this->input->post('unit_price')),
                'date' => $this->db->escape_str($this->input->post('date')),
                'dealer_id' => $id

            );
            $dealer_id = $this->dealer_model->insert($dealer_information);
            echo $amount = $this->oil_model->get_sum_dealer($this->db->escape_str($this->input->post('st_id'))) *
                $this->db->escape_str($this->input->post('unit_price'));
            $cash_information = array(
                'cash' => $amount,
                'type' => $this->db->escape_str($this->input->post('date')),
                'date' => $this->input->post('date'),
                'transaction_type' => 'debit',
                'table_name' => 'dealer_transaction',
                'table_id' => $dealer_id,
                'account_id' => $id,
                'desc' => $this->db->escape_str($this->input->post('desc'))


            );

            $cash_id = $this->cash_model->insert($cash_information);
            redirect($_SESSION['url']);
        }

    }

    function check_type($cash_id, $account_type)
    {
        echo $this->uri->segment(2);
        switch ($account_type) {
            case "stuff":
                $money_type = array('af' => 'افغانی');
                break;

            case "driver":
                $money_type = array('ir' => 'تومان');
                break;

            case "exchanger":
                $money_type = array(
                    'usa' => 'دالر',
                    'af' => 'افغانی',
                    'eur' => 'یرو',
                    'ir' => 'تومان',
                    'klp' => 'کلدار'
                );
                break;

            default:
                $money_type = array('usa' => 'دالر');
        }
        $data['money_type'] = $money_type;

        $data['main_title'] = "check";
        $data['cash_id'] = $cash_id;
        $this->form_validation->set_rules('code', null, 'required',
            array(
                'required' => 'You have not provided name in name field'
            )
        );
        $this->form_validation->set_rules('name', null, 'required',
            array(
                'required' => 'You have not provided name in name field'
            )
        );

        if ($this->form_validation->run() == false) {

            $data['signup_form'] = "active";
            $this->load->template('cash/check_type', $data);
        } else {
            $check_information = array(
                'cash_id' => $this->input->post('cash_id'),
                'check_type' => $this->input->post('check_type'),
                'code' => $this->db->escape_str($this->input->post('code')),
                'type' => $this->db->escape_str($this->input->post('type')),
                'name' => $this->db->escape_str($this->input->post('name'))

            );

            $cash_id = $this->check_model->insert($check_information);
            redirect($this->session->userdata('url'), $data);
        }
    }

    function get_accounts()
    {

        if (isset($_GET['term'])) {
            $q = strtolower($_GET['term']);
            echo $this->account_model->accounts_json($q);
        }
    }

    function stock_transactions_json()
    {

        if (isset($_GET['term'])) {
            $q = strtolower($_GET['term']);
            echo $this->oil_model->srock_transactions_json($q);
        }
    }

    function get_real_oil_id_json()
    {

        if (isset($_GET['term'])) {
            $q = strtolower($_GET['term']);
            echo $this->oil_model->get_real_oil_id_json($q);
        }
    }

    public function add()
    {

        $this->form_validation->set_rules('name', null, 'alpha_int|required',
            array(
                'required' => 'You have not provided name in name field',
                'alpha_int' => 'please insert just alghabatic charecters'
            )
        );
        $this->form_validation->set_rules('lname', null, 'alpha_int|required',
            array(
                'required' => 'You have not provided name in name field',
                'alpha_int' => 'please insert just alghabatic charecters'
            )
        );

        $this->form_validation->set_rules('phone', null, 'is_natural|required|regex_match[/^[0-9]{10}$/]',
            array(
                'required' => 'You have not provided name in name field',
                'is_natural' => 'Please Use Just numberic charecters'
            )
        );

        function alpha_int($str)
        {
            $ci =& get_instance();
            $str = (strtolower($ci->config->item('charset')) != 'utf-8') ? utf8_encode($str) : $str;

            return (!preg_match("/^[[:alpha:]- چجحخهعغفقثصضشسیبلاتنمکگپظطزرذدئو_.]+$/", $str)) ? FALSE : TRUE;
        }

        $data['account_rows'] = $this->account_model->group_by('type');
        if ($this->form_validation->run() == false) {

            $data['signup_form'] = "active";
            $this->load->template('accounts/add', $data);
        } else {

            $cantact_info = array(
                'name' => $this->db->escape_str($this->input->post('name')),
                'lname' => $this->db->escape_str($this->input->post('lname')),
                'type' => $this->db->escape_str($this->input->post('type')),
                'phone' => $this->db->escape_str($this->input->post('phone'))
            );

            $id = $this->account_model->insert($cantact_info);

            $data['fu_page_title'] = "Login Form";
            redirect('account/profile/' . $id . '/' . $this->input->post('type'));
            // $this->profile($id);
        }


    }

    public function profile($id = 0, $type)
    {
        $this->session->set_userdata('url', $this->router->fetch_class() . '/' . $this->router->fetch_method() . '/' . $this->uri->segment(3) . '/' . $this->uri->segment(4));

        $data['fu_page_title'] = "Login Form";
        $data['account_rows'] = $this->cash_model->get_balance_credit_debit($id);
        $data['balance_rows'] = $this->account_model->get_where(array('id' => $id, 'type' => 'account'));
        $data['buy_rows'] = $this->oil_model->get_where(array('buyer_seller_id' => $id, 'buy_sell' => 'buy', 'type' => 'pre'));
        $data['sell_rows'] = $this->oil_model->get_where(array('buyer_seller_id' => $id, 'buy_sell' => 'sell', 'type' => 'pre'));
        $data['cash_rows'] = $this->cash_model->get_where(array('account_id' => $id));
        //$data['debit']=$this->cash_model->sum_where(array('account_id' => $id, 'transaction_type'=>'debit'));
        //$data['credit']=$this->cash_model->sum_where(array('account_id' => $id, 'transaction_type'=>'credit'));
        //$data['balance']=$this->cash_model->get_balance($id);

        //	$this->load->template('accounts/profile',$data);

        if ($type == "driver") {
            $data['driver_cash_rows'] = $this->cash_model->get_where(array('account_id' => $id, 'table_name' => 'driver_transaction'));
            $data['driver_oil_rows'] = $this->driver_model->get_where_oil(array('driver_transaction.driver_id' => $id));
            $this->load->template('accounts/driver_profile', $data);
        }

        if ($type == "exchanger") {
            $data['exchanger_cash_rows'] = $this->cash_model->get_where(array('account_id' => $id, 'table_name' => 'account'));
            $data['cash_type_rows'] = $this->cash_model->group_by(array('account_id' => $id), 'type');

            $this->load->template('accounts/exchanger_profile', $data);
        }

        if ($type == "seller") {
            $data['cash_rows'] = $this->cash_model->get_where(array('account_id' => $id));
            $this->load->template('accounts/seller_profile', $data);
        }
        if ($type == "customer") {
            $data['cash_rows'] = $this->cash_model->get_where(array('account_id' => $id));
            $this->load->template('accounts/customer_profile', $data);
        }

        if ($type == "stuff") {
            $data['driver_cash_rows'] = $this->cash_model->get_where(array('account_id' => $id, 'table_name' => 'driver_transaction'));
            $data['all_debit_credit'] = $this->driver_model->get_where(array('account_id' => $id));
            $this->load->template('accounts/stuff_profile', $data);
        }

        if ($type == "dealer") {
            $data['driver_cash_rows'] = $this->cash_model->get_where(array('account_id' => $id, 'table_name' => 'driver_transaction'));
            $data['driver_oil_rows'] = $this->driver_model->get_where_oil(array('driver_transaction.driver_id' => $id));
            $this->load->template('accounts/dealer_profile', $data);
        }
    }

    public function driver_cash_delete($id)
    {
        $cash = $this->cash_model->get_where(array('id' => $id));
        foreach ($cash as $key => $value) {
            $driver = $this->driver_model->get_where(array('id' => $value->table_id));
            $this->check_model->delete(array('cash_id' => $id));
            $this->driver_model->delete(array('id' => $value->table_id));
            foreach ($driver as $key => $dvalue) {
                $this->oil_model->delete(array('id' => $dvalue->st_id));

            }
        }
        $this->cash_model->delete(array('id' => $id));

        redirect($_SESSION['url']);
    }

    public function delete($id)
    {
        $this->check_model->delete(array('cash_id' => $id));
        $this->cash_model->delete(array('id' => $id));
        redirect($_SESSION['url']);
    }

}
