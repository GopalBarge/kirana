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
					<div id="product-left">
						<img src="<?php echo base_url().$product->big_image;?>" alt="" />
					</div>
					<div id="product-right">
						<h1><?php echo $product->item_name;?></h1>
						<p><span class="large">£<?php echo number_format($product->item_price,2);?></span> per case</p><br />
						<?php if($product->item_stock>0)
						{
							?>
                        <p><strong>Stock Remaining:</strong> <?php echo $product->item_stock;?> Pieces</strong>
						<br /><br />
                        <?php } 
						else
						{
							?>
						<div id="errors">
							<ul>
								<li>Out of stock</li>
							</ul>
						</div>
                        <?php } ?>
						<div id="description">
							<p><?php echo $product->item_desc;?></p>
						</div>
						<div id="actions">
							<a href="<?php echo base_url();?>index.php/buy/<?php echo $product->item_id; ?>" class="add">Add to cart</a>
						</div>
					</div>
				</div>		
				<div class="clear"></div>
				<?php include("footer.php"); ?>
			</div>
	
	</div>
</body>
</html>