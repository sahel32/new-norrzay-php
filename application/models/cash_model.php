<?php
class cash_model extends CI_Model{

    public $table;
    public $id;
    public $cash;
    public $date;
    public $type;
    public $desc;
    public $st_parent_id;
    public $account_id;
    public $transaction_type;


    public function __construct()
    {
        parent::__construct();
        $this->table="cash";
        $this->id="id";
        $this->cash="cash";
        $this->date="date";
        $this->type="type"; //pre or fact
        $this->st_parent_id="st_parent_id";
        $this->account_id="account_id";
        $this->desc="desc";
        $this->transaction_type="transaction_type";


    }
    function get_where_column($wheres,$column){
        $query=$this->db->get_where($this->table, $wheres);
        $value=$query->row();
        return $value->$column;

    }
    //get all rows of table
    function get(){
        //  $this->db->order_by($this->id,'desc');
        $query=$this->db->get($this->table);
        return $query->result();
    }

    function get_balance_credit_debit_mylty_money($id,$type,$date){
        $query=$this->db->query("
SELECT
  ( debit-credit) AS balance,
  credit,
  debit,
  NAME,
  lname,
  phone,
  account.id,
  cash.type as type
FROM
  (SELECT (debit1+debit2) AS credit FROM (
SELECT
    IFNULL(SUM(cash),0)  AS debit1
  FROM
    cash
  WHERE transaction_type = 'debit'
    AND account_ID = ? AND type=? and date>='".$date."'
) AS t1,
(SELECT
  IFNULL(SUM(cash.`cash`),0) AS debit2
FROM
  cash,
  check_option
WHERE cash.id = check_option.`cash_id`
  AND cash.`account_id` = ?
  AND check_option.`type` = ? and date>='".$date."'
  AND cash.`transaction_type`='debit'
) AS t2) AS result,
  (SELECT (credit1+credit2) AS debit FROM (
SELECT
    IFNULL(SUM(cash),0)  AS credit1
  FROM
    cash
  WHERE transaction_type = 'credit'
    AND account_ID = ? AND type=? and date>='".$date."'
) AS t1,
(SELECT
  IFNULL(SUM(cash.`cash`),0) AS credit2
FROM
  cash,
  check_option
WHERE cash.id = check_option.`cash_id`
  AND cash.`account_id` = ?
  AND check_option.`type` = ? and date>='".$date."'
  AND cash.`transaction_type`='credit'
) AS t2) AS result1,
  account,
  cash
WHERE cash.`account_id` = account.id
  AND account.`id` = ?
GROUP BY account.`id`
        ", array($id,$type,$id,$type,$id,$type,$id,$type,$id));
        return  $query->result();

    }


    function get_balance_credit_debit_single($id,$date){
        $query=$this->db->query("
SELECT
  (credit-debit) AS balance,
  credit,
  debit,
  name,
  lname,
  phone,
  account.id
FROM
  (SELECT
    IFNULL(SUM(cash),0) AS debit
  FROM
    cash
  WHERE transaction_type = 'debit'
    AND account_ID = ? and date>='".$date."') AS result,
  (SELECT
    IFNULL(SUM(cash),0) AS credit
  FROM
    cash
  WHERE transaction_type = 'credit'
    AND account_ID = ? and date>='".$date."') AS result1,
  account,
  cash
WHERE cash.`account_id` = account.id
  AND account.`id` = ? 
GROUP BY account.`id`
        ", array($id,$id,$id));
        return  $query->result();

    }
    //get data from table by condition or array of condition
    function group_by($wheres=array(),$group_by){
        //$query = $this->db->get_where('mytable', array('id' => $id), $limit, $offset);
        $this->db->group_by($group_by);
        $this->db->where($wheres);
        $query=$this->db->get($this->table);
        return $query->result();
    }
    function sum_where($wheres){
        //$query = $this->db->get_where('mytable', array('id' => $id), $limit, $offset);
        $this->db->select_sum('cash');
        $query=$this->db->get_where($this->table, $wheres);
        $value= $query->row();
        return $value->cash;
    }

    function get_balance($id){
        $debit=$this->sum_where(array('account_id'=>$id,'transaction_type'=>'debit'));
        $credit=$this->sum_where(array('account_id'=>$id,'transaction_type'=>'credit'));
        return $balance= $debit -$credit;
    }
    //get data from table by condition or array of condition
    function get_where($wheres){
        //$query = $this->db->get_where('mytable', array('id' => $id), $limit, $offset);
        $query=$this->db->get_where($this->table, $wheres);
        return $query->result();
    }

    //deletes data from table by condtion or array of condition
    function delete($wheres){
        $this->db->delete($this->table,$wheres);
    }

    //inset array of data to table
    function insert($data){
        $this->db->insert($this->table,$data);
        return $this->last_id();
    }


    //updates data or array of data by condition or array of condition
    function update($data,$wheres){
        $str = $this->db->update($this->table, $data, $wheres);
        return $str;
    }

    function check_email_exist($wheres){
        //$query = $this->db->get_where('mytable', array('id' => $id), $limit, $offset);
        $query=$this->db->get_where($this->table, $wheres);
        $result=$query->num_rows();
        if($result==0){
            return false;
        }else{
            return true;
        }
    }


    //check tha table if is empty or not
    function check_empty(){
        return $this->db->count_all($this->table);
    }


    function last_id(){

        $this->db->select($this->id);
        $this->db->from($this->table);
        $this->db->limit(1);
        $this->db->order_by($this->id, "desc");
        $query=$this->db->get();
        $result=$query->result();
        if(empty($result)){
            return 1;
        }else{
            foreach ($result as $key => $value) {
                return $value->{$this->id}++;
            }
        }
    }
    function get_where_sum_column($wheres,$column){
        $this->db->select_sum($this->$column);
        $query=$this->db->get_where($this->table, $wheres);
        $value= $query->row();
        return $value->$column;
    }
    function get_where_sum($wheres,$column){
        $this->db->select_sum($this->$column);
        $query=$this->db->get_where($this->table, $wheres);
        $value= $query->result();
        return $value;
    }
    function last_row(){

        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->limit(1);
        $this->db->order_by($this->id, "desc");
        $query=$this->db->get();
        $result=$query->row_array();
        return $result;
    }

}
?>