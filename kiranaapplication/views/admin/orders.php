<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title></title>
	<link rel="stylesheet" href="<?php echo base_url();?>css/main.css" type="text/css">
	</head>
<body>
	<div id="wrapper">
			<?php include("header.php"); ?>
			<div id="content" class="checkout">
				<div id="breadcrumb">
					<a href="#">Our Products</a>
				</div>
				<?php include("left.php"); ?>
                
				<div id="right">
				<h1 class="bar">Orders</h1>
					 <?php if($orders!='empty')
				{
					?>
			    <table id="cart">
			      <thead>

			      <tr>
			        <th>Order No</th>
			        <th>Order Time</th>
			        <th>Status</th>
			        <th>Actions</th>
			         </tr>
                  </thead>
			      <tbody>
                  <?php foreach($orders as $order)
				  {
					  ?>
			        <tr>
			          <td><?=$order->order_id;?></td>
			          <td><?=$order->order_date;?></td>
			          <td>
                      <?php
					  
					 if($order->order_status=='dispatched')
					 		echo '<span style="color:green"><strong>Dispatched</strong></span>';
							
					 if($order->order_status=='cancelled')
					  		echo '<span style="color:red"><strong>Cancelled</strong></span>';
					  
					 if($order->order_status=='new')
					 		echo '<span style="color:orange"><strong>Order Received</strong></span>';
					 
					  ?>
					  </td>
			          <td><a href="<?=base_url();?>index.php/admin/view_order/<?=$order->order_id;?>">View</a>
                      <?php if($order->order_status=='new') { ?>
					  | <a href="<?=base_url();?>index.php/admin/cancel_order/<?=$order->order_id;?>">Cancel Order</a>
                                          | <a href="<?=base_url();?>index.php/admin/dispatch_order/<?=$order->order_id;?>">Mark as Dispatched</a>
                      <?php } ?>
                      </td>
		            </tr>
                    <?php }?>
			        
		          </tbody>
		        </table>
		
                          <?php 
                                        if($total>RECORDS_PER_PAGE)
                                        {
                                        $pages = ceil($total/RECORDS_PER_PAGE);
                                        
                                        ?>
					<div id="actions">
						<div id="pagination">
							<a href="">&laquo;</a>
							<?php for($i=1; $i<=$pages;$i++)
                                                        {
                                                            ?><a class="<?php if($this->uri->segment(3)==$i) echo 'active';?>" href="<?php 
                                                            echo base_url();?>index.php/admin/orders/<?=$i;?>"><?php echo $i;?></a>
                                                            
                                                          <?php } ?>  
							<a href="">&raquo;</a>
						</div>
                                           <?php } ?>       
                <?php } else echo "No Record"; ?>
	  
					</div>	
				</div>		
				<div class="clear"></div>
				<div id="footer">
			</div>
			</div>
	
	</div>
</body>
</html>