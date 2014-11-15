<?php
class main_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
		
                
                function getAllCategories()
		{
				
				$this->db->select("*");
				$result = $this->db->get('ko_categories');
				if($result->num_rows()>0)
				return $result->result();
				else
				return 'empty';
				
		}
		
		function getLatestProducts()
		{
				
				$this->db->select("*");
			   	$this->db->limit(50,0);  
				$this->db->order_by('item_id','DESC');
				$result = $this->db->get('ko_items');
				if($result->num_rows()>0)
				return $result->result();
				else
				return 'empty';
				
		}	
		
		function getCategoryProducts($cat_id)
		{
				
				$this->db->select("*");
				$this->db->where("cat_id",$cat_id);
				$this->db->limit(9,0);
				$this->db->order_by('item_id','DESC');
				$result = $this->db->get('ko_items');
				if($result->num_rows()>0)
				return $result->result();
				else
				return 'empty';
				
		}
		
		function check_login($options)
		{
				
				
				$this->db->select("*");
				$this->db->where("email",$options['username']);
				$this->db->where("user_pass",$options['password']);
				$result = $this->db->get('ko_users');
				if($result->num_rows()>0)
				{
				$row = $result->row();
						
						$sess_array = array(
						"user_name"             =>      $row->full_name,
						"email" 		=>	$row->email,
						"company_name"  	=>	$row->company_name,
						"user_pass"		=>	$row->user_pass,
						"account_type"          =>	$row->account_type,
						"user_id"		=>	$row->user_id);
						
						$this->session->set_userdata($sess_array);
						if($this->session->userdata('total_price')!='')
                                                $url = base_url()."index.php/order_step2";
                                                else
                                                $url = base_url()."index.php/user";    
						header("Location:$url");
						exit();
				}
				else
				{
					$url = base_url()."index.php/login/failed";
					header("Location:$url");
					exit();
				}
				
		}
		
	function register($options)
	{
		
		$data = array(
		"full_name"	 	=> $options['full_name'],
		"email"			=> $options['email'],	
		"account_type" 		=> $options['account_type'],
                "date_joined"           =>  date("Y-m-d H:i:s"),
		"company_name" 		=> $options['company_name'],
		"user_pass" 		=> $options['password'],
		);
		
		$email_exist = $this->check_if_email_exists($options['email']);
		if($email_exist=='0')
		{
			
			$this->db->insert('ko_users',$data);
						
			$this->session->set_userdata($data);
			$this->session->set_userdata('user_id',$this->db->insert_id());
			$url = base_url()."index.php/order_step2";
			header("Location:$url");

		}
		else
		{
				$url = base_url()."index.php/register/failed";
				header("Location:$url");
				
		}
		
	}
	
	function check_if_email_exists($email)
	{
		
				$this->db->select("*");
				$this->db->where("email",$email);
				$result = $this->db->get('ko_users');
				if($result->num_rows()>0)
				return "1";
				else
				return "0";
	}	
	
	
	function update_user($options)
	{
		if($_POST['password']!='')
		$data = array(
		"full_name"	 	=> $options['full_name'],
		"email"			=> $options['email'],	
		"account_type" 		=> $options['account_type'],
		"company_name" 		=> $options['company_name'],
		"user_pass" 		=> $options['password'],
		);
		else
		$data = array(
		"full_name"	 	=> $options['full_name'],
		"email"			=> $options['email'],	
		"account_type" 		=> $options['account_type'],
		"company_name" 		=> $options['company_name']);
		
		$this->db->where('user_id',$this->session->userdata('user_id'));
		$this->db->update('ko_users',$data);
		$this->session->set_userdata($data);
		header("Location:".base_url()."index.php/user/account/success");	
		
		
	}
	
///////// Please above this //////////////		
}