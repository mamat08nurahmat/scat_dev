<?php
include('include/config.php');
	$id = $_GET['id'];

$query = mssql_query ("DELETE from leads where id = '$id'");
if ($query)
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




