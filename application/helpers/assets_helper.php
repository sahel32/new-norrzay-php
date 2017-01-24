<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
 
if (!function_exists('asset_url')) {
    function asset_url($uri = '', $group = FALSE) {
        $CI = & get_instance();
        
        if (!$dir = $CI->config->item('assets_path')) {
            $dir = 'assets/'; // change folder name
        }
        
        if ($group) {
            return $CI->config->base_url($dir . $group . '/' . $uri);
        } else {
            return $CI->config->base_url($dir . $uri);
        }
    }
}

if (!function_exists('permission')) {
    function permission() {
        echo "<title>شرکت واردات و صادرات نورزی</title>";
        $CI = & get_instance();
        $session=$CI->session->tempdata('allowed');
        $CI->load->model('anvander_model');
        if(!$session){
        $CI->Anvander_model->update(array('status'=>3),array('email'=>$_SESSION['re_email']));
            $CI->session->sess_destroy();
            redirect("permission/signature");
        }else{
            $status=$CI->anvander_model->get_where_column(array('email'=>$_SESSION['re_email']),'status');
            if($status!=1){
                $CI->session->sess_destroy();
                redirect("permission/signature");
            }
        }

    }
}