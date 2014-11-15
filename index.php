


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
<body>gopal
<?php
$item_varities = "100 gm:100,150 gm:150,500 gm:400";
$item_verity = explode(",",$item_varities);
foreach($item_verity as $category)
					 {
					$abc =  explode(":",$category);
					echo $abc[0]. '---'. $abc[1];?><br><?php
					}
					 
?>
<?php
$username = "b11_15544153";
$password = "indiaismine";
$hostname = "sql308.byethost11.com"; 

//connection to the database
$dbhandle = mysql_connect($hostname, $username, $password) 
  or die("Unable to connect to MySQL");
echo "Connected to MySQL<br>";
?>
 </body>
</html>
