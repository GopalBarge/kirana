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
			<div id="content">
				<div id="breadcrumb">
					<a href="#">Our Products</a>
				</div>
				<?php include("left.php"); ?>
				<div id="right">
					<h1 class="bar">Checkout</h1>
                    <?php if(validation_errors()) { ?><div id="errors"><?php echo validation_errors(); ?></div> <?php } ?>
					<form action="<?=base_url();?>index.php/front/order_step2" method="post" enctype="multipart/form-data" id="admin">
						<h2>Delivery Address</h2>

						<p>
							<label>Address:</label>
							<input name="address1" type="text" id="address1" value="<?=set_value('address1');?>"> 
							<input name="address2" type="text" id="address2" value="<?=set_value('address2');?>"> 
						</p>
						<p>
							<label>Town/City:</label>
							<input name="city" type="text" id="city" value="<?=set_value('city');?>"> 
						</p>
						<p>
							<label>County:</label>
							<select name="county" >
							<optgroup label="England">
							<option>Bedfordshire</option>
							<option>Berkshire</option>
							<option>Bristol</option>
							<option>Buckinghamshire</option>
							<option>Cambridgeshire</option>
							<option>Cheshire</option>
							<option>City of London</option>
							<option>Cornwall</option>
							<option>Cumbria</option>
							<option>Derbyshire</option>
							<option>Devon</option>
							<option>Dorset</option>
							<option>Durham</option>
							<option>East Riding of Yorkshire</option>
							<option>East Sussex</option>
							<option>Essex</option>
							<option>Gloucestershire</option>
							<option>Greater London</option>
							<option>Greater Manchester</option>
							<option>Hampshire</option>
							<option>Herefordshire</option>
							<option>Hertfordshire</option>
							<option>Isle of Wight</option>
							<option>Kent</option>
							<option>Lancashire</option>
							<option>Leicestershire</option>
							<option>Lincolnshire</option>
							<option>Merseyside</option>
							<option>Norfolk</option>
							<option>North Yorkshire</option>
							<option>Northamptonshire</option>
							<option>Northumberland</option>
							<option>Nottinghamshire</option>
							<option>Oxfordshire</option>
							<option>Rutland</option>
							<option>Shropshire</option>
							<option>Somerset</option>
							<option>South Yorkshire</option>
							<option>Staffordshire</option>
							<option>Suffolk</option>
							<option>Surrey</option>
							<option>Tyne and Wear</option>
							<option>Warwickshire</option>
							<option>West Midlands</option>
							<option>West Sussex</option>
							<option>West Yorkshire</option>
							<option>Wiltshire</option>
							<option>Worcestershire</option>
							</optgroup>
							<optgroup label="Wales">
							<option>Anglesey</option>
							<option>Brecknockshire</option>
							<option>Caernarfonshire</option>
							<option>Carmarthenshire</option>
							<option>Cardiganshire</option>
							<option>Denbighshire</option>
							<option>Flintshire</option>
							<option>Glamorgan</option>
							<option>Merioneth</option>
							<option>Monmouthshire</option>
							<option>Montgomeryshire</option>
							<option>Pembrokeshire</option>
							<option>Radnorshire</option>
							</optgroup>
							<optgroup label="Scotland">
							<option>Aberdeenshire</option>
							<option>Angus</option>
							<option>Argyllshire</option>
							<option>Ayrshire</option>
							<option>Banffshire</option>
							<option>Berwickshire</option>
							<option>Buteshire</option>
							<option>Cromartyshire</option>
							<option>Caithness</option>
							<option>Clackmannanshire</option>
							<option>Dumfriesshire</option>
							<option>Dunbartonshire</option>
							<option>East Lothian</option>
							<option>Fife</option>
							<option>Inverness-shire</option>
							<option>Kincardineshire</option>
							<option>Kinross</option>
							<option>Kirkcudbrightshire</option>
							<option>Lanarkshire</option>
							<option>Midlothian</option>
							<option>Morayshire</option>
							<option>Nairnshire</option>
							<option>Orkney</option>
							<option>Peeblesshire</option>
							<option>Perthshire</option>
							<option>Renfrewshire</option>
							<option>Ross-shire</option>
							<option>Roxburghshire</option>
							<option>Selkirkshire</option>
							<option>Shetland</option>
							<option>Stirlingshire</option>
							<option>Sutherland</option>
							<option>West Lothian</option>
							<option>Wigtownshire</option>
							</optgroup>
							<optgroup label="Northern Ireland">
							<option>Antrim</option>
							<option>Armagh</option>
							<option>Down</option>
							<option>Fermanagh</option>
							<option>Londonderry</option>
							<option>Tyrone</option>
							</optgroup>
							</select>
    					</p>
						<p>
							<label>Postcode:</label>
							<input name="post_code" type="text" id="post_code" value="<?=set_value('post_code');?>"> 
						</p>
					<br />
					<h2>Order Summary</h2>
                    <?php
					if($products!='empty')
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
						foreach($products as $product) {	
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
								<td>£<?=number_format(($total_price+$vat),2);?></td>
							<tr>
						</tbody>
					</table>
                    <?php } 
					else header("Location:".base_url()); ?>
					<input name="vat" type="hidden" id="vat" value="<?=$vat;?>" />
                    <input name="sub_total" type="hidden" id="sub_total" value="<?=$total_price;?>" />
                    <input name="total_price" type="hidden" id="total_price" value="<?=$total_price+$vat;?>" />
                    <input name="checkout_action" type="hidden" id="checkout_action" value="true" />
<br />
					<input type="submit" value="Send Order">
					</form>
				</div>		
				<div class="clear"></div>
				<?php include("footer.php"); ?>
			</div>
	
	</div>
</body>
</html>