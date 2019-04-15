<?php
include('include/config.php');

$kd_npp = $_GET['id'];
$query 	= mssql_query ("DELETE from contoh where id = '$kd_npp'");
$exe 	= mssql_query ("DELETE from history_sales where id = '$kd_npp'");
if ($exe)
  	{
		echo"
		<script> alert('Data Telah dihapus');
		window.history.back();
		</script>";
	}
	
	else
	{ 
		echo "Data belum terhapus!!" .mssql_get_last_message();
	}

?>




