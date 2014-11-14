<?php
//if($this->session->userdata('admin')=='')
   // header("Location:".base_url()."index.php/admin/");
?>
<div id="header">
				<div id="logo">
					<a href="<?php echo base_url();?>"><img src="<?php echo base_url();?>images/logo.png" alt="Galaxy Wines Ltd." /></a>
				</div>
			</div>
			<div id="menu">
				<ul>
					<li><a href="#">Dashboard</a></li>
					<li><a href="<?php echo base_url();?>index.php/admin/orders">Orders</a></li>
					<li><a href="<?php echo base_url();?>index.php/admin/customers">Customers</a></li>
					<li><a href="<?php echo base_url();?>index.php/admin/products">Products</a></li>
                    <li><a href="<?php echo base_url();?>index.php/admin/categories">Categories</a></li>
                    <?php if($this->session->userdata('admin')!='')
					{
					?>
                    <li><a href="<?php echo base_url();?>index.php/admin/signout">Signout</a></li>
                    <? } ?>
				</ul>
			</div>