<?php
include('include/config.php');
$npp=$_GET["npp"]; 

$reset = "DELETE FROM sales_target where npp='$npp'";
$reset2 = "DELETE FROM performances where npp='$npp'";


$sql = mssql_query($reset);
$sql2 = mssql_query($reset2);
 ?>
	<script>alert("DATA BERHASIL DIDELETE");
	window.location.replace('index.php?page=10a');
</script>