<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title></title>
	<link rel="stylesheet" href="<?php echo base_url();?>css/main.css" type="text/css">
<script type="text/javascript">
function addSizeVariant(){
 var name = document.getElementById("variant_name").value;
  var price = document.getElementById("variant_price").value;
 var x = document.getElementById("variant");
var option = document.createElement("option");
option.text = name;
x.add(option);

document.getElementById("variant_name").value='';
 document.getElementById("variant_price").value='';
 var item_varity = document.getElementById("item_verity").value;
 if(item_varity == '')
 {
    item_varity =  name+':'+price;
 } else{
 item_varity = item_varity + ','+  name+':'+price;
 }
  document.getElementById("item_verity").value = item_varity;
}
</script>
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
				  <h1 class="bar">Add New Product</h1>
                  	
					<?php if(validation_errors()) { ?><div id="errors"><?php echo validation_errors(); ?></div> <?php } ?>
                	<?php if($this->uri->segment(4)!='') { ?><div id="errors"> Sorry - Category Already Exists</div> <?php } ?>
                    
				  <form action="<?php echo base_url();?>index.php/admin/add_product" method="post" enctype="multipart/form-data" id="admin">
				    <p>
				      <label>Product Title:</label>
				      <input name="title" type="text" id="title"  value="<?=set_value('title');?>"/>
			        </p>
                    <p>
				      <label>Manufacturer:</label>
				      <select name="mfg_id" id="mfg_id" class="big">
                      <?php

					 $manufacturers = $this->admin_model->getAllManufacturers();
					 foreach($manufacturers as $manufacturer)
					 {
					 ?>
				      	<option value="<?php echo $manufacturer->Id; ?>"><?php echo $manufacturer->mfg_name; ?></option>

                      <?php
					  }
					  ?>
			          </select>
			        </p>
				    <p>
				      <label>Product Sale Price:</label>
				      <input name="price" type="text" id="price" value="<?=set_value('price');?>"/>
                      per
                      <input name="prod_unit" id="prod_unit" class="small"/>
                      
			        </p>
                    <p>
				      <label>Product List Price:</label>
				      <input name="list_price" type="text" id="list_price" value="<?=set_value('list_price');?>"/>
                    </p>
                    <p>
				      <label>Stock:</label>
				      <input name="stock" type="text" id="stock" value="<?=set_value('stock');?>" />
			        </p>
				    <p>
				      <label>Photo:</label>
				      <input type="file" name="file" id="file" />
			        </p>
				    <p>
				      <label>Category:</label>
				      <select name="cat_id" id="cat_id" class="big">
                      <?php

					 $categories = $this->admin_model->getAllCategories();
					 foreach($categories as $category)
					 {
					 ?>
				      	<option value="<?php echo $category->cat_id; ?>"><?php echo $category->cat_name; ?></option>

                      <?php
					  }
					  ?>
			          </select>
			        </p>
				    <p>
				      <label>Short Description:</label>
				      <textarea name="short_desc" id="short_desc"><?=set_value('short_desc');?></textarea>
			        </p>
                    <p>
				      <label>Detailed Description:</label>
				      <textarea name="detailed_desc" id="detailed_desc"><?=set_value('detailed_desc');?></textarea>
			        </p>
					<p>
				      <label>Product Variant:</label>
				      <textarea name="item_verity" id="item_verity"><?=set_value('item_verity');?></textarea>
			        </p>
                     <p>
				      <label>Product Variant:</label>
                      <select name="variant" id="variant" class="big"></select>    <br />
                      <input type="text" id="variant_name" placeholder="Item size" /> <input type="text" id="variant_price" placeholder="Item price"/> <input type="button" value="+add" onclick="addSizeVariant();"/>
			        </p>

				    <input type="submit" name="submit" value="Add Product" />
                                    <input type="hidden" name="action" value="1" />
			      </form>
			  </div>
<div class="clear"></div>
				<div id="footer">
			</div>
			</div>
	
	</div>
</body>
</html>