<?php
class check_model extends CI_Model{

    public $table;
    public $id;
    public $cash_id;
    public $date;
    public $desc;
    public $check_type;
    public $name;


    public function __construct()
    {
        parent::__construct();
        $this->table="check_option";
        $this->id="id";
        $this->cash_id="cash_id";
        $this->date="date";
        $this->desc="desc";
        $this->check_type="check_type"; //pre or fact
        $this->name="name";


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