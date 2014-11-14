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
                                    			<h1 class="bar">Order No: <?=$this->uri->segment(3);?></h1>
<?php
if($order->order_status=='new')
$color='green';
if($order->order_status=='cancelled')
$color='red';
else
$color='orange';
?>
					<h2>Status: <span style="color:<?=$color;?>"><?=ucwords($order->order_status);?></span></h2>

					<h2>Delivery Address</h2>
					<p><?=$address->address1;?><br /><?=$address->address2;?><br /><?=$address->city;?><br /><?=$address->county;?><br /><?=$address->post_code;?></p>
					<br />
					<h2>Order Summary</h2>
						<?php
					if($cart_products!='empty')
					{
					?>
					<table id="cart">
						<thead>
							<th>Product</th>
							<th class="qty-column">Qty</th>
							<th>Price</th>
							<th>Total</th>
						</thead>
						<tbody>
                        <?php 
						$total_price	=	0;
						foreach($cart_products as $product) {	
						$total_price += $product->item_total_price;
						?>
							<tr>
								<td><?=$product->item_name;?></td>
								<td><?=$product->item_quantity;?></td>
								<td>£ <?=number_format($product->item_price,2);?></td>
								<td>£ <?=number_format($product->item_total_price,2);?></td>
							</tr>
                          <?php } ?>  
							<tr>
								<td colspan="2" class="hidden"></td>
								<td><strong>Sub Total</strong></td>
								<td>£<?=number_format($total_price,2);?></td>
							<tr>
							<tr>
								<td colspan="2" class="hidden"></td>
								<td><strong>VAT (20%)</strong></td>
								<td>£ <?php $vat = ($total_price*(0.2)); echo number_format($vat,2);?></td>
							<tr>
							<tr>
								<td colspan="2" class="hidden"></td>
								<td><strong>Total</strong></td>
								<td>£<?=number_format($total_price+$vat,2);?></td>
							<tr>
						</tbody>
					</table>
                    <?php  } ?>
		
				</div>		
				<div class="clear"></div>
				<div id="footer">
			</div>
			</div>
	
	</div>
</body>
</html>