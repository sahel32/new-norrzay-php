<?php
class delete_model extends CI_Model{

    public $cash;
    public $account;
    public $balance;
    public $check_option;
    public $dealer_transaction;
    public $driver_transaction;
    public $stock;
    public $stock_transaction;

    public function __construct()
    {
        parent::__construct();
        $this->cash="cash";
        $this->account="account";
        $this->balance="balance";
        $this->check_option="check_option";
        $this->dealer_transaction="dealer_transaction"; //pre or fact
        $this->driver_transaction="driver_transaction";
        $this->stock="stock";
        $this->stock_transaction="stock_transaction";
    }
    
    public function cash($wheres){
        $this->db->delete($this->cash,$wheres);
    }
    public function account($wheres){
        $this->db->delete($this->account,$wheres);
}
    public function balance($wheres){
        $this->db->delete($this->balance,$wheres);
    }
    public function check_option($wheres){
        $this->db->delete($this->check_option,$wheres);
    }
    public function dealer_transaction($wheres){
        $this->db->delete($this->dealer_transaction,$wheres);
    }
    public function driver_transaction($wheres){
        $this->db->delete($this->driver_transaction,$wheres);
    }
    public function stock($wheres){
        $this->db->delete($this->stock,$wheres);
    }
    public function stock_transaction($wheres){
        $this->db->delete($this->stock_transaction,$wheres);
    }
}