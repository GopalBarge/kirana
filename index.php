


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
 <head>
  <title> Mobile Paint Charts </title>
  <meta name="Generator" content="EditPlus">
  <meta name="Author" content="">
  <meta name="Keywords" content="">
  <meta name="Description" content="">
<style>
</style>

<script>

</script>
</head>
<body>
<?php
$item_varities = "100 gm:100,150 gm:150,500 gm:400";
$item_verity = explode(",",$item_varities);
foreach($item_verity as $category)
					 {
					$abc =  explode(":",$category);
					echo $abc[0]. '---'. $abc[1];?><br><?php
					}
					 
?>

 </body>
</html>
