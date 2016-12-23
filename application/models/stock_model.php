<?php 
class stock_model extends CI_Model{

  public $table;
  public $id;
  public $name;
  public $province;
  public $type;
  public $date;
  public $desc;
    public $oil_type;

  public function __construct()
    {
     parent::__construct();
     $this->table="stock";
     $this->id="id";
     $this->name="name";
     $this->province="province";
     $this->type="type";
     $this->date="date";
     $this->desc="desc";
        $this->oil_type="oil_type";

    }

    //get all rows of table
    function get(){
    //  $this->db->order_by($this->id,'desc');
      $query=$this->db->get($this->table);
      return $query->result();
    }
    function get_group_by($column){
        $this->db->group_by($column);
        $query=$this->db->get($this->table);
        return $query->result();


    }
    function get_where_column($wheres,$column){

        //$query = $this->db->get_where('mytable', array('id' => $id), $limit, $offset);
        $query=$this->db->get_where($this->table, $wheres);
        $value =$query->row();
        return $value->$column;
    }
    function get_remain_oil($id,$buy_sell){
        $query=$this->db->query('
        SELECT
  (buy - sell) AS remain
FROM
  (SELECT
    SUM(amount) AS sell
  FROM
    stock_transaction
  WHERE parent_id = ?
    AND buy_sell = ?) AS result,
  (SELECT
    amount AS buy
  FROM
    stock_transaction
  WHERE id = ?
    AND buy_sell = ?) AS result1', array($id,$buy_sell,$id,$buy_sell));
        $value =$query->row();
        return $value->remain;

    }


    function get_stock_balance_fact($id){
        $query=$this->db->query('
SELECT (buy-sell) AS remain FROM (SELECT (driver+buy1) AS buy FROM (SELECT
  IFNULL(SUM(amount),0) AS buy1
FROM
  stock,
  stock_transaction
WHERE stock.id = ?
  AND stock.id = stock_transaction.`stock_id`
  AND buy_sell = \'buy\' AND stock_transaction.type=\'fact\') AS t,
  (SELECT
  IFNULL(SUM(driver_transaction.amount),0) AS driver
FROM
  driver_transaction,
  stock_transaction
WHERE stock_transaction.id = driver_transaction.`st_id` AND stock_id=?) AS t1) AS t ,
  (SELECT
   IFNULL(SUM(amount),0) AS sell
FROM
  stock,
  stock_transaction
WHERE stock.id = ?
  AND stock.id = stock_transaction.`stock_id`
  AND buy_sell = \'sell\' AND stock_transaction.type=\'fact\') AS t1
        ', array($id,$id,$id));
        $value =$query->row();
        return $value->remain;
    }

    function get_stock_balance_pre($id,$buy_sell){
        $query=$this->db->query('
SELECT (buy_pre - sell) AS remain FROM (SELECT
  IFNULL(SUM(amount),0) AS buy_pre
FROM
  stock_transaction
WHERE id IN
  (SELECT
    id
  FROM
    stock_transaction
  WHERE buy_sell = ?
    AND TYPE = \'pre\'
    AND stock_id = ?)) AS t,
    (SELECT IFNULL((sell1+sell2),0) AS sell FROM (  SELECT
  IFNULL(SUM(amount), 0) AS sell2
FROM
  stock_transaction
WHERE buy_sell =?
  AND TYPE = \'fact\'
  AND parent_id IN
  (SELECT
    id
  FROM
    stock_transaction
  WHERE stock_id = ?)) AS s1,
  (    SELECT
 IFNULL(SUM(amount),0) AS sell1
FROM
  stock_transaction
WHERE buy_sell =?
  AND TYPE = \'pre\'
  AND parent_id IN
  (SELECT
    id
  FROM
    stock_transaction
  WHERE stock_id = ?)) AS s2
  ) AS t1
        ', array($buy_sell,$id,$buy_sell,$id,$buy_sell,$id));
        $value =$query->row();
        return $value->remain;
    }

    function get_stock_balance_pre_sell($id){
        $query=$this->db->query('
SELECT
  (presell - factsell) AS remain_presell
FROM
  (SELECT
    IFNULL(SUM(amount), 0) AS presell
  FROM
    stock_transaction
  WHERE buy_sell = \'sell\'
    AND TYPE = \'pre\'
    AND stock_id = ?) AS t,
  (SELECT
    IFNULL(SUM(amount), 0) AS factsell
  FROM
    stock_transaction
  WHERE TYPE = \'fact\'
    AND buy_sell = \'sell\'
    AND parent_id IN
    (SELECT
      id
    FROM
      stock_transaction
    WHERE buy_sell = \'sell\'
      AND TYPE = \'pre\'
      AND stock_id = ?)) AS t1
        ', array($id,$id));
        $value =$query->row();
        return $value->remain_presell;
    }

    function get_stock_balance_pre_buy($id){
        $query=$this->db->query('
SELECT
  (presell - presel) AS remain
FROM
  (SELECT
    IFNULL(SUM(amount), 0) AS presell
  FROM
    stock_transaction
  WHERE NULLIF(parent_id, \' \') IS NULL
    AND buy_sell = \'buy\'
    AND TYPE = \'pre\'
    AND stock_id = ?) AS t,
  (SELECT
      IFNULL(SUM(amount), 0) AS presel
    FROM
      stock_transaction
    WHERE TYPE = \'pre\'
      AND buy_sell = \'sell\'
      AND parent_id IN
      (SELECT
        id
      FROM
        stock_transaction
      WHERE buy_sell = \'buy\'
        AND TYPE = \'pre\'
        AND stock_id = ?)
      OR stock = ?) AS t1
        ', array($id,$id,$id));

        $value =$query->row();
        return $value->remain;
    }
    //get data from table by condition or array of condition
    function get_where($wheres){
      //$query = $this->db->get_where('mytable', array('id' => $id), $limit, $offset);
      $query=$this->db->get_where($this->table, $wheres);
      return $query->result();
    }
    function get_or_where($wheres,$or_wheres){
        //$query = $this->db->get_where('mytable', array('id' => $id), $limit, $offset);
        $this->db->where($wheres);
        $this->db->or_where($or_wheres);
        $query=$this->db->get($this->table);
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