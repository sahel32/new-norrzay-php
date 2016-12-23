<?php 
class account_model extends CI_Model{

  public $table;
  public $id;
  public $name;
  public $province;
  public $type;
  public $date;
  public $desc;

  public function __construct()
    {
     parent::__construct();
     $this->table="account";
     $this->id="id";
     $this->name="name";
     $this->province="province";
     $this->lname="lname";
     $this->phone="phone";
     $this->email="email";
     $this->date="date";
     $this->desc="desc";

    }

    //get all rows of table
    function get(){
      $this->db->order_by($this->id,'desc');
      $query=$this->db->get($this->table);
      return $query->result();
    }

    function accounts_json($q){
        $this->db->select('name');
        $this->db->like('name', $q);
        $query = $this->db->get($this->table);
        if($query->num_rows() > 0){
            foreach ($query->result_array() as $row){
                $row_set[] = htmlentities(stripslashes($row['name'])); //build an array
            }
            echo json_encode($row_set); //format the array into json data
        }
    }

    
    //get data from table by condition or array of condition
    function group_by($wheres=array(),$group_by){
      //$query = $this->db->get_where('mytable', array('id' => $id), $limit, $offset);
        $this->db->group_by($group_by);
        $this->db->where($wheres);
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
        return $value->$column;
    }

    function get_or_where($wheres,$or_wheres){
        //$query = $this->db->get_where('mytable', array('id' => $id), $limit, $offset);
        $this->db->where($wheres);
        $this->db->or_where($or_wheres);
        $query=$this->db->get($this->table);
        return $query->result();
    }
    function get_name($wheres){
        //$query = $this->db->get_where('mytable', array('id' => $id), $limit, $offset);
        $query=$this->db->get_where($this->table, $wheres);
        $value =$query->row();
        return $value->name;
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