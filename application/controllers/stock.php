<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class stock extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	public function index()
	{
		 $data['title']="dashboard";
		 $this->load->template("stock/index", $data);
	}

	public function add(){

				$data['main_title']="add stock";
		$data['sub_title']="add stock form ";
		$data['desc']="add stock decription";
		$data['oil_type_rows'] = $this->stock_model->get_group_by('oil_type');

        $this->form_validation->set_rules('name' , null, 'alpha_int|required',
            array(
                'required'      => 'You have not provided name in name field',
                'alpha_int'         =>'please insert just alghabatic charecters'
        )
            );

   /*    $this->form_validation->set_rules('province' , null, 'alpha_int|required',
            array(
                'required'      => 'You have not provided name in name field',
                'alpha_int'         =>'please insert just alghabatic charecters'
        )
            );

       $this->form_validation->set_rules('phone' , null, 'is_natural|required|regex_match[/^[0-9]{10}$/]',
            array(
                'required'      => 'You have not provided name in name field',
                'is_natural'         =>'Please Use Just numberic charecters'
        )
            );*/
		
		function alpha_int($str)
		{
			$ci =& get_instance();
			$str = (strtolower($ci->config->item('charset')) != 'utf-8') ? utf8_encode($str) : $str;

			return ( ! preg_match("/^[[:alpha:]- 1234567890qwertyuiopasdfghjklzxcvbnmچجحخهعغفقثصضشسیبلاتنمکگپظطزرذدئو_.]+$/", $str)) ? FALSE : TRUE;
		}

        if($this->form_validation->run()==false){

        $data['signup_form']="active";
        $this->load->template('stock/add',$data);
        }else{

        $cantact_info=array(
            'name'=>$this->db->escape_str($this->input->post('name')),
            'province'=>$this->db->escape_str($this->input->post('province')),
			'type'=>'fact',
			'oil_type'=>$this->input->post('oil_type')
            );

       $id=$this->stock_model->insert($cantact_info);

        $data['fu_page_title']="Login Form";
        redirect('stock/profile/'.$id.'/fact');
      // $this->profile($id); 
        }


    }

    public function profile($id=0,$type){
    	  $data['fu_page_title']="Login Form";
          $data['stock_rows']=$this->stock_model->get_where(array('id' => $id));
		$data['main_title']="stock profile";
		$data['sub_title']="stock details";
		$data['desc']="stick descipttion";


		$data['pre_oil_rows']=$this->oil_model->get_where(array('stock_id' => $id,'type'=>'pre'));

		$data['fact_oil_rows']=$this->oil_model->get_where(array('stock_id' => $id,'type'=>'fact'));
		$data['driver_oil_rows']=$this->driver_model->get_where_oil(array('stock_id' => $id,'type'=>'fact'));

       	$this->load->template('stock/profile_'.$type,$data);
    }

	public function lists()
	{
		$data['main_title']="stock profile";
		$data['sub_title']="stock details";
		$data['buy_sell']="stock details";
		$data['desc']="stick descipttion";
		 $data['stock_rows']=$this->stock_model->get();
		 $this->load->template("stock/lists", $data);
	}

}