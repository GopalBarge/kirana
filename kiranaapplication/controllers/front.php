<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Front extends CI_Controller {
	function __construct()
	{
		parent::__construct();
 		$this->load->model('main_model');
		$this->load->model('admin_model');
                $this->load->model('email_model');
		$this->load->model('cart_model');
		$this->load->library('form_validation');
		
		session_start();
		@$cart_session= session_id();
		if($this->session->userdata('cart_session')=='')	$this->session->set_userdata('cart_session',$cart_session);	
		
	}

	public function index()
	{
		
		$data['categories'] 		= $this->main_model->getAllCategories();
		$data['home_products'] 		= $this->main_model->getLatestProducts();
		$this->load->view("home",$data); 
		
	}
	
	
	public function category()
	{
		
		$data['categories']                     = $this->main_model->getAllCategories();
		$data['category_products'] 		= $this->main_model->getCategoryProducts($this->uri->segment(2));
		$this->load->view("category_products",$data); 
		
	}
	
	function signout()
	{
		
		$sess_array = array(
				'user_name'			=>	'',
				'email'				=>	'',
				'user_id'			=>	'',
				'account_type'                  =>	'',
				'company_name'                  =>	'',
                                'cart_items_count'		=>	'0',
                                'total_price'                   =>	'0',
				); 
				
				$this->session->set_userdata($sess_array);
				$loc = base_url()."index.php";
				header("Location:$loc");
		}	
	
	function details()
	{
		
		$pid 				= 	$this->uri->segment(2);
		$data['categories'] = 	$this->main_model->getAllCategories();
		$data['product']	= 	$this->admin_model->getProductDetails($pid);
		$this->load->view('product_details',$data);
		
	}
	
	function cart()
	{
		
		
		$data['categories'] 	= 	$this->main_model->getAllCategories();
		$data['cart_products']	= 	$this->cart_model->getCartProducts();
		$this->load->view('cart',$data);
		
	}
	
	function buy()
	{
		
			$pid = $this->uri->segment(2);
			$this->cart_model->add2cart($pid);
			
                        $total_products_cart 	= $this->cart_model->getTotalCartProducts();
			$total_price 		 	= $this->cart_model->getTotalCartPrice();
                        
			$this->session->set_userdata('cart_items_count',$total_products_cart);
			$this->session->set_userdata('total_price',$total_price);
			//header("Location:".$_SERVER['HTTP_REFERER']);
                        redirect(base_url()."index.php/cart/added");
			exit();
	}
	
	function update_cart()
	{
		
		if($this->input->post('update_action')!='')
		{
			$this->cart_model->update_cart($this->input->post());
			
			$total_products_cart 	 = $this->cart_model->getTotalCartProducts();
			$total_price 		 = $this->cart_model->getTotalCartPrice();
			$this->session->set_userdata('cart_items_count',$total_products_cart);
			$this->session->set_userdata('total_price',$total_price);
			
			
			redirect(base_url()."index.php/cart");
			exit();
		}	
		
	}
	
	
	function checkout()
	{
		$this->cart_model->saveCart();
	}
	
	
	
	function register()
	{
	
		if($this->session->userdata('user_id')!='')
			{
				$target	=	base_url()."index.php/front/account";
				header("Location:$target");
			}
		
		else if($this->session->userdata('user_id')=='' && $this->input->post('register_action')!='true')
		{
			
					$data['categories'] 	= 	$this->main_model->getAllCategories();		
					$this->load->view('register',$data);

		}
		
		else if ($this->input->post('register_action')=='true')
		{
				
					$this->form_validation->set_rules('full_name', 'Full Name', 'trim|required');
					$this->form_validation->set_rules('account_type', 'Account Type', 'trim|required');	
					
					if($this->input->post('account_type')=='Trade')
					$this->form_validation->set_rules('company_name', 'Company Name', 'trim|required');	
					$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');	
					$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]|max_length[12]|matches[password2]');	
					$this->form_validation->set_rules('password2', 'Confirm Password', 'trim|required|min_length[6]|max_length[12]');
					
						if ($this->form_validation->run() == FALSE)
						{
								$data['categories'] 	= 	$this->main_model->getAllCategories();
								$this->load->view('register',$data);	
						}
						else
						{
							
							$this->main_model->register($this->input->post());
							
						}
            
		}
		

	}
	
	function login()
	{
            
           if($this->session->userdata('user_id')=='' && $this->input->post('login_action')!='true')
		{
			$data['categories'] 	= 	$this->main_model->getAllCategories();
			$this->load->view('login',$data);	
		}
		else if ($this->input->post('login_action')=='true')
		{
			
					
                	$this->form_validation->set_rules('username', 'Username/Email', 'trim|required|valid_email');	
					$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]|max_length[12]|xss_clean');

						if ($this->form_validation->run() == FALSE)
						{
								$data['categories'] 	= 	$this->main_model->getAllCategories();
								$this->load->view('login',$data);	
						}
						else
						{
							$this->main_model->check_login($this->input->post());
							
						}
            
		}
		else
		{
			
			$data['categories'] 	= 	$this->main_model->getAllCategories();
			$this->load->view('login',$data);	

		}
		
		
	}
	
	function order_step2()
	{
					if($this->session->userdata('user_id')=='')
                                            header("Location:".base_url()."index.php/login");
                                        
                                        if($this->session->userdata('total_price')=='0')
                                            header("Location:".base_url()."index.php/user");
                                        
					else if($this->input->post('checkout_action')=='')
					{
					
							$data['categories'] 	= 	$this->main_model->getAllCategories();
							$data['products']		=	$this->cart_model->getCheckoutDetails();
							$this->load->view('checkout',$data);	
					}
					else if($this->input->post('checkout_action')=='true')
					{
						
						$this->form_validation->set_rules('address1', 'Address 1', 'trim|required');
						$this->form_validation->set_rules('address2', 'Address 2', 'trim|required');
						$this->form_validation->set_rules('city', 'City', 'trim|required');
						$this->form_validation->set_rules('county', 'County', 'trim|required');
						$this->form_validation->set_rules('post_code', 'Post Code', 'trim|required');	
						
						
						if ($this->form_validation->run() == FALSE)
						{
								$data['categories'] 	= 	$this->main_model->getAllCategories();
								$data['products']		=	$this->cart_model->getCheckoutDetails();
								$this->load->view('checkout',$data);
						}
						else
						{
							$order_id = $this->cart_model->save_order($this->input->post());
							$this->cart_model->save_address($this->input->post());
							$url = base_url()."index.php/confirm";
							header("Location:$url");
						}

						
					}
					
	}
	
	
	
	function confirm()
	{
		if($this->session->userdata('order_id')!='')
		{
			$data['categories'] 	= 	$this->main_model->getAllCategories();
                        $this->email_model->order_confirmation();
			$this->load->view('order_confirmation',$data);
			
		}
		else
		header("Location:".base_url());
		
	}
//////////// ********** ABOVE THIS ****************/	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */