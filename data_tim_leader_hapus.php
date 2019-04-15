<?php
include('include/config.php');
	$id = $_GET['id_report'];

$query = mssql_query ("DELETE from report_tl where id_report ='$id'");
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




