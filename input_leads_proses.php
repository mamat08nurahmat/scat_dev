<?php 
error_reporting(0);
include('include/config.php');
if($_POST['kirim']){
	$id_user_atasan		= $_POST['id_user_atasan'];
	$npp 				= $_POST['npp'];
	$nama_prospek 		= $_POST['nama_prospek'];
	$alamat 			= $_POST['alamat'];
	$no_telp 			= $_POST['no_telp'];
	$produk 			= $_POST['produk'];
	$nominal_pengajuan 	= $_POST['nominal_pengajuan'];
	$id_cabang			= $_POST['id_cabang'];
	$alamat_perusahaan	= $_POST['alamat_perusahaan'];
	$sumber_data	 	= $_POST['sumber_data'];
	$ket				= $_POST['ket'];
	$tgl_input			= date('d M Y H:i');
	$tgl_exp			= $tgl_input + 7;
	$is_expired			= $_POST['is_expired'];
var_dump($_POST);die();
	$order = "INSERT INTO leads VALUES 
			('$npp','$npp','$nama_prospek','$alamat',$no_telp,'$produk',$nominal_pengajuan,'$id_cabang','$alamat_perusahaan','$sumber_data','$ket','$tgl_input','$tgl_exp','$is_expired')";

	//declare in the order variable
	$result = mssql_query($order);	//order executes	
	if($result)
	{
	echo"
	<script> 
		alert('LEADS SUKSES DITAMBAHKAN');
		window.location.replace('index.php?page=29g'); </script> ";
	}
	else
	{
	echo "Gagal di tambah ulangi lagi".mssql_get_last_message();
	}
	
}
?>