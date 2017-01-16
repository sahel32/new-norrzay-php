<?php
class Anvander_model extends CI_Model{

    public $table;
    public $id;
    public $username;
    public $password;
    public $status;


    public function __construct()
    {
        parent::__construct();
        $this->table="anvander";
        $this->id="id";
        $this->username="namn";
        $this->password="lasnord";
        $this->status="status";

    }

    //get all rows of table
    function get(){
        $this->db->order_by($this->id,'desc');
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

    function order_by($order_by){
        //$query = $this->db->get_where('mytable', array('id' => $id), $limit, $offset);
        $this->db->order_by($order_by);
        $query=$this->db->get($this->table);
        return $query->result();
    }

    function get_where($wheres){
        //$query = $this->db->get_where('mytable', array('id' => $id), $limit, $offset);
        $query=$this->db->get_where($this->table, $wheres);
        return $query->result();
    }

    function get_where_column($wheres,$column){

        //$query = $this->db->get_where('mytable', array('id' => $id), $limit, $offset);
        $query=$this->db->get_where($this->table, $wheres);
        $value =$query->row();
        return (isset($value->$column))? $value->$column : "";
    }

    function get_or_where(){
        //$query = $this->db->get_where('mytable', array('id' => $id), $limit, $offset);
        $query=$this->db->query("
        select * from account where status='1' and (type='seller' or type='customer')
        ");
        return $query->result();
    }
    function get_name($wheres){
        //$query = $this->db->get_where('mytable', array('id' => $id), $limit, $offset);
        $query=$this->db->get_where($this->table, $wheres);
        $value =$query->row();
        return (isset($value->name))? $value->name : "";
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

        $this->db->select('name');
        $this->db->from($this->table);
        $this->db->limit(1);
        $this->db->order_by($this->id, "desc");
        $query=$this->db->get();
        $result=$query->row_array();
        return $result;
    }
   function accounts_json($where){
$result = array();
        $this->db->select('namn,status,email');
$this->db->where($where);
        $query = $this->db->get('anvander');
        if($query->num_rows() > 0){
            foreach ($query->result_array() as $row){
  $result[] = array("name"=> $row['namn'],"status"=> $row['status'],"email"=> $row['email']);
             
            }
            echo json_encode($result); //format the array into json data
        }
    }

    function update_premission($data,$wheres){
        $str = $this->db->update($this->table, $data, $wheres);
 $result[] = array("check"=>  $str);
         echo json_encode($result);
    }

}
?>