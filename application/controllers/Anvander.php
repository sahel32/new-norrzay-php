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
    public function logout(){
        $data['title']="dashboard";
        $this->Anvander_model->update(array('status'=>3),array('email'=>$this->session->userdata('re_email')));
        $this->session->sess_destroy();
        redirect("permission/signature");
}
    public function check_permission(){
        if(!isset($_SESSION['re_email']) and $_SESSION['re_email']==""){
            $this->session->set_userdata('re_email',$this->input->get('re_email'));
        }else{
            $this->session->userdata('re_email');
        }

        $status = $this->Anvander_model->get_where_column(array('email' =>$this->session->userdata('re_email')), 'status');
        if($status==3){
            $this->Anvander_model->update(array('status'=>2),array('email'=>$this->session->userdata('re_email')));
        }

            $status = $this->Anvander_model->get_where_column(array('email' =>$this->session->userdata('re_email')), 'status');
            if ($status == 1) {
                $this->session->set_tempdata(
                    array(
                        'allowed'=>true,
                        'email'=>$this->input->get('re_email'),
                        'status'=>$status
                    ),
                    1
                );
                echo $status;
            } else {
                //$this->session->sess_destroy();
                echo "error";
            }

    }
public function update_permission($mac,$pass){

$this->Anvander_model->update_premission(array('status'=>1),array('mac'=>$mac, 'lasnord'=>$pass));
}

public function account_json($macaddress){

$this->Anvander_model->accounts_json(array('mac'=>$macaddress));
}
}