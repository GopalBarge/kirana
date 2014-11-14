<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {
	function __construct()
	{
		parent::__construct();
 		$this->load->model('main_model');
		$this->load->model('admin_model');
		$this->load->model('cart_model');
		$this->load->library('form_validation');
		
		session_start();
		@$cart_session= session_id();
		if($this->session->userdata('cart_session')=='')	$this->session->set_userdata('cart_session',$cart_session);	
		
	}

	public function index()
	{
		if($this->session->userdata('user_id')=='')
		redirect(base_url()."index.php/login");
		
		$data['orders'] 	= 		$this->cart_model->getUserOrders();
		$this->load->view("dashboard/dashboard",$data); 
		
	}
	
	public function view()
	{
		if($this->session->userdata('user_id')=='')
		redirect(base_url()."index.php/login");
		
		
		$data['order'] 					= 	$this->cart_model->getOrderDetails($this->uri->segment(3));
		$data['address'] 				= 	$this->cart_model->getOrderAddress($this->uri->segment(3));
		$data['cart_products'] 			=	$this->cart_model->getOrderProducts($data['order']->cart_session);
		
		$this->load->view("dashboard/order_details",$data); 
		
	}
	
	public function cancel()
	{
         
                if($this->session->userdata('user_id')=='' || $this->uri->segment(3)=='')
		redirect(base_url()."index.php/login");
		$this->cart_model->cancel_order($this->uri->segment(3));
	}



	public function account()
	{
					
					
		if($this->session->userdata('user_id')=='')
		redirect(base_url()."index.php/login");
		
		
		if($this->input->post('update_action')=='')
			$this->load->view("dashboard/account");

		else
		{
						
					$this->form_validation->set_rules('full_name', 'Full Name', 'trim|required');
					$this->form_validation->set_rules('account_type', 'Account Type', 'trim|required');	
					if($this->input->post('account_type')=='trade')
					$this->form_validation->set_rules('company_name', 'Company Name', 'trim|required');	
					$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');	
					if($this->input->post('password')!='' || $this->input->post('password2')!='' )
					{
						$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]|max_length[12]|matches[password2]');	
						$this->form_validation->set_rules('password2', 'Confirm Password', 'trim|required|min_length[6]|max_length[12]');
					}
					
						if ($this->form_validation->run() == FALSE)
						{
								
								$this->load->view('dashboard/account');	
						}
						else
						{
							
							$this->main_model->update_user($this->input->post());
							
						}
	
			
		}
		
	
		
	}


	
	
//////////// ********** ABOVE THIS ****************/	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */