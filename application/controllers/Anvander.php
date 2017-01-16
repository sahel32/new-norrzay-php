<?php
/**
 * Created by PhpStorm.
 * User: Miss You A
 * Date: 1/3/2017
 * Time: 2:37 PM
 */
class Anvander extends CI_Controller{


    public function index(){
        echo "index";
    }
    public function  lock_form(){

$this->load->view("anvander/lock_form");
}
    public function fetchMac($m=0){
        echo $m;
    }
    public function check_permission(){
        $this->session->set_userdata('re_email',$this->input->get('re_email'));
        $check=$this->Anvander_model->update(array('status'=>2),array('email'=>$this->session->userdata("re_email")));
        if($check) {
            $status = $this->Anvander_model->get_where_column(array('email' =>$this->session->userdata("re_email")), 'status');
            if ($status == 1) {
                $this->session->set_userdata('re_email','');
                redirect("dashboard/index");
            } else {
                echo "error";
            }
        }else{
            echo "notexist";
        }
    }
public function update_premission($mac,$pass){

$this->Anvander_model->update_premission(array('status'=>1),array('mac'=>$mac, 'lasnord'=>$pass));
}

public function account_json($macaddress){

$this->Anvander_model->accounts_json(array('mac'=>$macaddress));
}
}