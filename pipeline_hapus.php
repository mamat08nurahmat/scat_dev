<?php
include('include/config.php');
	$id_pipeline= $_GET['id'];

$query = mssql_query ("DELETE from pipeline_vendor where id_pipeline = '$id_pipeline'");
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