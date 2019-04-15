<?php
session_start();
include('include/config.php');
	$id 			= $_GET['id'];
	$npp			= $_POST['npp'];
	$ket			= $_POST['ket'];
    $keterangan		= $_POST['keterangan'];
	$tgl			= date('d M Y H:i:s');
	
$order = mssql_query("INSERT INTO history_leads(id,npp,ket,keterangan,sumber_data,tgl,nama_pemproses)
		VALUES('$id','$_SESSION[npp]','1','keluar dari cart','$sumber_data',SYSDATETIME(),'$_SESSION[namauser]')");
$leads = mssql_query("update leads set npp=null, ket=1, tgl_input= SYSDATETIME() where id='$id'") ;	
$query = mssql_query ("DELETE from cart where id ='$id'");
if ($order && $leads && $query)
  	{
		echo"<script> alert('Data Telah dihapus');
		window.history.back();
		</script>";
	}
	
	else
	{ 
		echo "Data belum terhapus!!" .mssql_get_last_message();
	}

?>




