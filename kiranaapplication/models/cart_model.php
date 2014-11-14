<?php
class cart_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
	
		function getCartProducts()
		{
				if($this->session->userdata('cart_session')!='')
				{
				$sess = $this->session->userdata('cart_session');
				$this->db->select("*");
				$this->db->where("cart_session",$sess);
                                $this->db->where("order_id",'');
				$this->db->order_by('cart_id','DESC');
				$result = $this->db->get('ko_cart');
				if($result->num_rows()>0)
                                    return $result->result();
				else
                                    return 'empty';
				}
				else
				return 'empty';
				
		}
		
		function getCheckoutDetails()
		{
				if($this->session->userdata('cart_session')!='')
				{
				$sess = $this->session->userdata('cart_session');
				$this->db->select("*");
				$this->db->where("cart_session",$sess);
				$this->db->where("cart_status",'saved');
                                $this->db->where("order_id",'');
				$this->db->order_by('cart_id','DESC');
				$result = $this->db->get('ko_cart');
				if($result->num_rows()>0)
				return $result->result();
				else
				return 'empty';
				}
				else
				return 'empty';
				
		}
		
		function save_order($options)
		{
				
			$data = array(
			"user_id" 		=>	$this->session->userdata('user_id'),
                        "order_date"            =>      date("Y-m-d H:i:s"),
			"cart_session"          =>	$this->session->userdata('cart_session'),
			"sub_total"		=>	$options['sub_total'],
			"vat"			=>	$options['vat'],
			"total_price"           =>	$options['total_price'],
			"order_status"          =>	'new',
			"ipaddress"		=>	$this->input->ip_address()
			);
			
			$this->db->insert('ko_orders',$data);
			$this->session->set_userdata('order_id',$this->db->insert_id());
                        $this->update_cart_order();
		}
		
		function update_cart_order()
                {
                    
                    $this->db->where('cart_session',$this->session->userdata('cart_session'));
                    $this->db->where('order_id','');
                    $data   = array('order_id'   =>  $this->session->userdata('order_id'));
                    $this->db->update('ko_cart',$data);  
                    $this->session->set_userdata('cart_items_count','');
                    $this->session->set_userdata('total_price','');
                    
                }
		function save_address($options)
		{
				
			$data = array(
			"order_id" 		=>	$this->session->userdata('order_id'),
			"address1"		=>	$options['address1'],
			"address2"		=>	$options['address2'],
			"city"			=>	$options['city'],
			"county"		=>	$options['county'],
			"post_code"		=>	$options['post_code']);
			
			$this->db->insert('ko_address',$data);
			return $this->db->insert_id();	
		}
		
		
		function add2cart($pid)
		{
			
                                $product_exists = $this->checkProductInCart($pid);
				
				if($product_exists=='No')
					$this->add_product_in_cart($pid);	
				else
					
                                {
                                          $qty = $this->get_cart_product_quantity($pid);
                                          $this->update_quantity_in_cart($pid,($qty+1));
                                }
				
		}
                
                function get_cart_product_quantity($pid)
		{
			$session_cart	=	$this->session->userdata('cart_session');
			$this->db->select('*');
			$this->db->where('item_id',$pid);
			$this->db->where('cart_session',$session_cart);
                        $this->db->where('order_id','');
			$result	=	$this->db->get('ko_cart');
			if($result->num_rows()>0)
			return $result->row()->item_quantity;
			else 
			return "No";

		}
		
                
		
		function checkProductInCart($pid)
		{
			$session_cart	=	$this->session->userdata('cart_session');
			$this->db->select('*');
			$this->db->where('item_id',$pid);
			$this->db->where('cart_session',$session_cart);
                        $this->db->where('order_id','');
			$result	=	$this->db->get('ko_cart');
			if($result->num_rows()>0)
			return "Yes";
			else 
			return "No";

		}
		
		function add_product_in_cart($pid)
		{
			
			$product = $this->admin_model->getProductDetails($pid);
			$data = array(
			"item_id" => $product->item_id,
			"item_price" => $product->item_price,
			"item_name" => $product->item_name,
			"item_quantity" => '1',
			"item_total_price" => $product->item_price,
			"item_image" => $product->thumbnail,
			"cart_session" => $this->session->userdata('cart_session')
			);
			
			$this->db->insert('ko_cart',$data);
		}
			
		function getTotalCartProducts()
		{
			$session_cart	=	$this->session->userdata('cart_session');
			$this->db->select('*');
			$this->db->where('cart_session',$session_cart);
                        $this->db->where('order_id','');
			$result = $this->db->get('ko_cart');
			if($result->num_rows()>0)
			return $result->num_rows();
			else
			return "0";
		}
		function getTotalCartPrice()
		{
			$session_cart	=	$this->session->userdata('cart_session');
			$this->db->select('sum(item_total_price) as total');
			$this->db->where('cart_session',$session_cart);
                        $this->db->where('order_id','');
			$result = $this->db->get('ko_cart');
			if($result->num_rows()>0)
			{
				$total= $result->row()->total;
				$vat = $total*0.2;
				$total = $total + $vat;
				return $total;
				}
			else
			return "0";
		}
		
		
		function update_cart($options)
		{
			
			$items 	= 	$options['items'];
			$qty 	=	$options['qty'];
			
				for($i=0;$i<sizeof($items); $i++)
				{
                                    if($qty[$i]>=0)
                                    {
					if($qty[$i]=='0')
					$this->remove_product_from_cart($items[$i]);
					else
					$this->update_quantity_in_cart($items[$i],$qty[$i]);
                                    }      
				}
			
		}
		
		function remove_product_from_cart($pid)
		{
			
			$this->db->where('item_id',$pid);
			$this->db->where('cart_session',$this->session->userdata('cart_session'));	
			$this->db->delete('ko_cart');
			
			
			$total_items = $this->session->userdata('cart_items_count');
			if($total_items!='0')
			$total_items = $total_items-1;
			
			
			$this->session->set_userdata('cart_items_count', $total_items);
		}
		
		function update_quantity_in_cart($item_id,$qty)
		{
			$query = "update ko_cart set item_total_price = (item_price*$qty),item_quantity='$qty' where item_id = '$item_id' and cart_session='".$this->session->userdata('cart_session')."'";
			$this->db->query($query);
		}
		
		function saveCart()
		{
			
			if($this->session->userdata('cart_session')=='')
                        header("Location:".base_url());
							  
			$this->db->where('cart_session', $this->session->userdata('cart_session'));
			$this->db->set('cart_status',"saved");
			$this->db->update('ko_cart');
			
                        if($this->session->userdata('user_id')=='')
                            $url = base_url()."index.php/login";
                        else
                            $url = base_url()."index.php/order_step2";
                        
			header("Location:$url");
			
		}
		
		function getUserOrders()
		{
				$this->db->select("*");
				$this->db->where("user_id",$this->session->userdata('user_id'));
				$this->db->order_by('order_id','DESC');
				$result = $this->db->get('ko_orders');
				if($result->num_rows()>0)
				return $result->result();
				else
				return 'empty';
		}
		
		function getOrderDetails($order_id)
		{
				
				$this->db->select("*");
				$this->db->where("user_id",$this->session->userdata('user_id'));
				$this->db->where("order_id",$order_id);
				$result = $this->db->get('ko_orders');
				if($result->num_rows()>0)
				return $result->row();
				else
				return 'empty';

		}
		
		function getOrderAddress($order_id)
		{
				
				$this->db->select("*");
				$this->db->where("order_id",$order_id);
				$result = $this->db->get('ko_address');
				if($result->num_rows()>0)
				return $result->row();
				else
				return 'empty';

		}
		
		function getOrderProducts($cart_session)
		{
			
				$this->db->select("*");
				$this->db->where("cart_session",$cart_session);
				$this->db->where('order_id',$this->uri->segment(3));
                                $this->db->order_by('cart_id','DESC');
				$result = $this->db->get('ko_cart');
				if($result->num_rows()>0)
				return $result->result();
				else
				return 'empty';
		}
		
		function cancel_order($order_id)
		{
			
			$this->db->where('user_id',$this->session->userdata('user_id'));	
			$this->db->where('order_id',$order_id);
			$this->db->set('order_status','cancelled');
			$this->db->update('ko_orders');
			$url = base_url()."index.php/user";
			header("Location:$url");
			
		}



///////// Please above this //////////////		
}