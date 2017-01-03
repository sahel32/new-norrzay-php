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
	public function transfer()
	{

		$data['main_title'] = "add stock";
		$data['sub_title'] = "add stock form ";
		$data['desc'] = "add stock decription";
		$data['oil_type_rows'] = $this->stock_model->get_group_by('oil_type');
		$data['stocks'] = $this->stock_model->get_where(array('type' => 'fact'));
		$data['drivers'] = $this->account_model->get_where(array('type' => 'driver'));





		function check_exist_pre_buy_sell_id($id)
		{
			$ci = get_instance();
			$con = $ci->oil_model->check_exist(array('id' => $id));
			return $con;
		}

		$this->form_validation->set_rules('transit', null, 'required',
			array(
				'required' => 'ضروری'
			)
		);
		$this->form_validation->set_rules('amount', null, 'required',
			array(
				'required' => 'ضروری'
			)
		);
		if ($this->form_validation->run() == false) {
			$data['oil_type_rows'] = $this->stock_model->get_group_by('oil_type');
			$data['stocks'] = $this->stock_model->get_where(array('type' => 'fact'));
			$data['drivers'] = $this->account_model->get_where(array('type' => 'driver'));
			$this->load->template('stock/transfer', $data);
		} else {
			$fact_transaction = array(
				'f_date' => $this->input->post('date'),
				'amount' => $this->db->escape_str($this->input->post('amount')),
				'stock_id' => $this->input->post('stock_source'),
				'unit_price' => $this->input->post('unit_price'),
				'stock' => $this->input->post('stock_target'),
				'unit' => 'ton',
				'type' => "fact",
				'buyer_seller_id'=>0,
				'buy_sell' => 'sell',
			);

			$id = $this->oil_model->insert($fact_transaction);
			$extra_transaction = array(
				'st_id' => $id,
				'driver_id' => $this->input->post('driver_id'),
				'transit' => $this->db->escape_str($this->input->post('transit'))
			);


			$d_id = $this->driver_model->insert($extra_transaction);
			$this->load->template('stock/transfer', $data);
		}




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
		$this->session->set_userdata('url',$this->router->fetch_class().'/'.$this->router->fetch_method().'/'.$this->uri->segment(3).'/'.$this->uri->segment(4));
    	  $data['fu_page_title']="Login Form";
          $data['stock_rows']=$this->stock_model->get_where(array('id' => $id));
		$data['main_title']="stock profile";
		$data['sub_title']="stock details";
		$data['desc']="stick descipttion";


		$data['pre_oil_rows']=$this->oil_model->get_where(array('stock_id' => $id,'type'=>'pre'));

		$data['fact_oil_rows']=$this->oil_model->get_where(array('stock_id' => $id,'type'=>'fact','buyer_seller_id!='=>''));
		$data['transfer_in']=$this->oil_model->get_where(array('stock_id' => $id,'type'=>'fact','buyer_seller_id'=>0));
		$data['transfer_out']=$this->oil_model->get_where(array('stock' => $id,'type'=>'fact','buyer_seller_id'=>0));
		$data['driver_oil_rows']=$this->driver_model->get_where_oil(array('stock_id' => $id,'type'=>'fact'));

       	$this->load->template('stock/profile_'.$type,$data);
    }

	public function lists()
	{
		$this->session->set_userdata('url',$this->router->fetch_class().'/'.$this->router->fetch_method());
		$data['main_title']="stock profile";
		$data['sub_title']="stock details";
		$data['buy_sell']="stock details";
		$data['desc']="stick descipttion";
		 $data['stock_rows']=$this->stock_model->get();
		 $this->load->template("stock/lists", $data);
	}

	public function inactive($id){
		$this->stock_model->update(array('status'=>0),array('id'=>$id));
		redirect($_SESSION['url']);
	}
	public function active($id){
		$this->stock_model->update(array('status'=>1),array('id'=>$id));
		redirect($_SESSION['url']);
	}
	public function delete_review($id){

		$data['id']=$id;

		$this->load->popupp('accounts/delete_review',$data);
	}


	public function transfer_delete($stock,$stock_id,$st_id){
		$this->driver_model->delete(array('st_id'=>$st_id));
		$this->oil_model->delete(array('stock'=>$stock,'stock_id'=>$stock_id));
		redirect($_SESSION['url']);
	}
	public function fact_oil_delete($st_id){
		$this->driver_model->delete(array('st_id'=>$st_id));
		$this->oil_model->delete(array('id'=>$st_id));
		$this->cash_model->delete(array('table_id'=>$st_id,'table_name'=>'stock_transaction'));
		redirect($_SESSION['url']);

	}

	public function driver_oil_delete($id){
		echo $oil_id=$this->driver_model->get_where_column(array('id'=>$id),'st_id');
		$this->driver_model->delete(array('id'=>$id));
		$this->oil_model->delete(array('id'=>$oil_id));
		$this->cash_model->delete(array('table_id'=>$id,'table_name'=>'driver_transaction'));
		redirect($_SESSION['url']);

	}
	public function delete($id){


		redirect($_SESSION['url']);
	}
}