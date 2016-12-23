<?php
class oil_model extends CI_Model{

    public $table;
    public $id;
    public $name;
    public $province;
    public $type;
    public $f_date;
    public $s_date;
    public $desc;
    public $amount;
    public $unit_price;
    public $buy_sell;
    public $parent_id;
    public $unit;
    public $stock_id;

    public function __construct()
    {
        parent::__construct();
        $this->table="stock_transaction";
        $this->id="id";
        $this->amount="amount";
        $this->unit_price="unit_price";
        $this->type="type"; //pre or fact
        $this->f_date="f_date";
        $this->desc="desc";
        $this->provnice="province";
        $this->name="name";
        $this->s_date="s_date";
        $this->buy_sell="buy_sell"; //buy or sell
        $this->parent_id="parent_id";
        $this->unit="unit";
        $this->stock_id="stock_id";

       // $this->get_balance(array('stock_id'=>$this->stock_id));
    }

    //get all rows of table
    function get(){
        //  $this->db->order_by($this->id,'desc');
        $query=$this->db->get($this->table);
        return $query->result();
    }
    function get_column($wheres,$column_name){

        //$query = $this->db->get_where('mytable', array('id' => $id), $limit, $offset);
        $query=$this->db->get_where($this->table, $wheres);
        $value =$query->row();
        return $value->$column_name;
    }
    function get_where_column($wheres,$column){
        $query=$this->db->get_where($this->table, $wheres);
        $value=$query->row();
        return $value->$column;

    }
    function get_oil_profile($id){
        $query=$this->db->query('
SELECT
  *
FROM
  stock_transaction,
  cash
WHERE stock_transaction.id = cash.`table_id`
  AND cash.`table_name` = \'stock_transaction\'
  AND stock_transaction.`parent_id`=?
        ', array($id));
        //$query =$query->row();
        return $query->result();

    }
    function get_sum_profile($id){
        $query=$this->db->query('
SELECT
  SUM(cash.`cash`) AS sum_cash,
  SUM(amount) AS sum_amount
FROM
  stock_transaction,
  cash
WHERE stock_transaction.id = cash.`table_id`
  AND cash.`table_name` = \'stock_transaction\'
  AND stock_transaction.`parent_id`=?
        ', array($id));
        //$query =$query->row();
        return $query->result();

    }

    function get_remain_oil_each_pre_buy($id,$buy_sell){
        $query=$this->db->query('
SELECT
  (buy-sell) AS remain
FROM
  (SELECT
    IFNULL(SUM(amount), 0) AS sell
  FROM
    stock_transaction
  WHERE parent_id = ?) AS result,
  (SELECT
    amount AS buy
  FROM
    stock_transaction
  WHERE id = ?
    AND buy_sell = ?
    AND TYPE = \'pre\') AS result1
        ', array($id,$id,$buy_sell));
        $query =$query->row();
        return $query->remain;

    }

    function get_remain_oil_each_pre($id,$buy_sell){
        $query=$this->db->query('
SELECT (sell2-sell1) AS remain FROM (SELECT
  IFNULL(amount,0) AS sell2
FROM
  stock_transaction
WHERE buy_sell =?
  AND TYPE = \'pre\'
  AND id = ?) AS t, (SELECT
  IFNULL(SUM(amount),0) AS sell1
FROM
  stock_transaction
WHERE parent_id IN
  (SELECT
    id
  FROM
    stock_transaction
  WHERE buy_sell = ? AND id=?)) AS t1
        ', array($buy_sell,$id,$buy_sell,$id));
        $query =$query->row();
        return $query->remain;

    }


    function get_remain_oil_each_fact($id,$buy_sell){
        $query=$this->db->query('
SELECT (sell2-sell1) AS remain FROM (SELECT
  IFNULL(amount,0) AS sell2
FROM
  stock_transaction
WHERE buy_sell =?
  AND TYPE = \'pre\'
  AND id = ?) AS t, (SELECT
  IFNULL(SUM(amount),0) AS sell1
FROM
  stock_transaction
WHERE parent_id IN
  (SELECT
    id
  FROM
    stock_transaction
  WHERE buy_sell = ? AND id=?)) AS t1
        ', array($buy_sell,$id,$buy_sell,$id));
        $query =$query->row();
        return $query->remain;

    }
    function get_balance($wheres){
        $this->load->model('balance_model');
        $CI =& get_instance();

        $this->db->select_sum($this->amount);
        $query=$this->db->get_where($this->table, array(''));
        $value= $query->row();

        $this->db->select_sum($this->amount);
        $query=$this->db->get_where($this->table, $wheres);
        $value= $query->row();

   /*     $CI->balance_model->insert(array(
            'type'=>'stock',
            'balance_type'=>'ton',
            'balance'=>$value->amount,
            'balanced_id'=>$wheres['stock_id']
        ));*/
        return $value->amount;



    }

    function get_where_sum($wheres,$column){
        $this->db->select_sum($this->$column);
        $query=$this->db->get_where($this->table, $wheres);
        $value= $query->row();
        return $value->$column;
    }
    function srock_transactions_json($q){
        $this->db->select('stock_transaction.id as id,account.name as name');
        $this->db->like('stock_transaction.id', $q);
        $this->db->join('account','account.id=stock_transaction.buyer_seller_id');
        $query = $this->db->get($this->table);
        if($query->num_rows() > 0){
            foreach ($query->result_array() as $row){
               // $row_set[] = htmlentities(stripslashes(' شماره فاکتور-'.$row['id'].' - '.$row['name'])); //build an array
                $row_set[] = htmlentities(stripslashes($row['id'])); //build an array
            }
            echo json_encode($row_set); //format the array into json data
        }
    }
    //get data from table by condition or array of condition
    function get_where($wheres){
        //$query = $this->db->get_where('mytable', array('id' => $id), $limit, $offset);
        $query=$this->db->get_where($this->table, $wheres);
        return $query->result();
    }

    //get data from table by condition or array of condition


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

    function check_exist($wheres){
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