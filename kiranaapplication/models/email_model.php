<?php
class email_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
	
		

    function order_confirmation()
    {
            
        
        $msg    = '<P> Dear '. $this->session->userdata('user_name').'</p>';
        $msg    .='<p> Thank you for placing order online at WineGate. Your order has been received and will be processed shortly</p>';
        $msg    .='<p>Your order ID :'.$this->session->userdata('order_id').'</p>';
        $msg    .='<p><a href="'.base_url().'index.php/front/login">Login & Check Order Details Online</a></p>';
        $msg    .='<p> Thank You<br /> WineGate.com</p>';
        $subject = "Thank you for your order @ WineGate";
        $this->send_email($this->session->userdata('email'),$subject,$msg);
        
    }
    
    function email_header()
    {
 
            $headers  = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            $headers .= 'From: WineGate <info@winegate.com>' . "\r\n";
            return $headers;
     }
	
    
    function send_email($email,$subject,$msg)
    {
            
        $headers = $this->email_header();
        @mail($email,$subject,$msg,$headers);
        
    }
	


///////// Please above this //////////////		
}