<?php
include('include/config.php');
$npp=$_GET["npp"]; 

$reset = "update sales set status=0,pass=dbo.md5('bankbni') where npp='$npp'";

$sql = mssql_query($reset);
 ?>
	<script>alert("DATA BERHASIL DIRESET");
	window.location.replace('index.php?page=10a');
</script>