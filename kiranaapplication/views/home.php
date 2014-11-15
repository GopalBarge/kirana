<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title></title>
	<link rel="stylesheet" href="<?php echo base_url();?>css/main.css" type="text/css">
    <link rel="stylesheet" href="<?php echo base_url();?>css/header.css" type="text/css">


    <link rel="stylesheet" href="<?php echo base_url();?>css/html5reset.css" media="all">
	<link rel="stylesheet" href="<?php echo base_url();?>css/responsivegridsystem.css" media="all">
    	<link rel="stylesheet" href="<?php echo base_url();?>css/3cols.css" media="all">
       <link rel="stylesheet" href="<?php echo base_url();?>css/col.css" media="all">
<!-- Responsive Stylesheets -->
	<link rel="stylesheet" media="only screen and (max-width: 1024px) and (min-width: 769px)" href="<?php echo base_url();?>css/1024.css">
	<link rel="stylesheet" media="only screen and (max-width: 768px) and (min-width: 481px)" href="<?php echo base_url();?>css/768.css">
	<link rel="stylesheet" media="only screen and (max-width: 480px)" href="<?php echo base_url();?>css/480.css">

    <style type="text/css">
    #maincontent .col {
		background: #ccc;
		background: rgba(204, 204, 204, 0.85);

	}
    </style>

</head>
<body>



<div id="wrapper">
	<div id="headcontainer">
			<?php include("header.php"); ?>
	</div>

	<div id="maincontentcontainer">
		<div class="standardcontainer" id="example">
			<div class="maincontent"> 
                        <?php
						$i=0;
                        	$j=0;
						foreach ($home_products as $product)
						{
							?>
                            <?php if($i%3==0 || $i== 0){  echo '<div class="section group">';}?>
                              <?php $j++;?>
                            <div class="col span_1_of_3 item">
							<div class="photo"><img src="<?php echo base_url().$product->medium_image;?>" alt="<?php echo $product->item_name; ?>" /></div>
							<div class="title"><a href="<?php echo base_url();?>index.php/details/<?php echo $product->item_id; ?>/<?php echo strtolower(url_title($product->item_name)); ?>">
							<?php echo $product->item_name; ?></a></div>
							<p><span>₹<?php echo $product->item_price; ?></span> per case</p>
							<div class="actions">
								<a href="<?php echo base_url();?>index.php/buy/<?php echo $product->item_id; ?>" class="add">Add to cart</a>
							</div>
                              	</div>
                       <?php if($j==3){$j=0;  echo '</div>';}?>
                        <?php $i++;} ?>
                      	</div>
				</div>
                </div>
                </div>



</body>
</html>