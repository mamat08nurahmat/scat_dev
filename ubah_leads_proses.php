<?php 
include('include/config.php');
if($_POST['ubah']){
	$id					= $_POST['id'];
	$npp 				= $_POST['npp'];
	$nama_nasabah 		= $_POST['nama_nasabah'];
	$alamat 			= $_POST['alamat'];
	$no_telp 			= $_POST['no_telp'];
	$produk 			= $_POST['produk'];
	$nominal_pengajuan 	= $_POST['nominal_pengajuan'];
	$id_cabang			= $_POST['id_cabang'];
	$alamat_perusahaan	= $_POST['alamat_perusahaan'];
	$ket				= $_POST['ket'];
	$tgl_input			= date('d M Y H:i');

	$order=  mssql_query (" 
	UPDATE leads1 SET 
	npp 				='$npp',
	nama_nasabah		='$nama_nasabah', 
	alamat				='$alamat',
	no_telp		 		='$no_telp',
	produk 				='$produk',
	nominal_pengajuan	='$nominal_pengajuan',
	id_cabang			='$id_cabang',
	alamat_perusahaan	='$alamat_perusahaan',
	ket					='$ket',
	tgl_input			='$tgl_input'
	WHERE id ='$id'");		
	if($order)
	{
	echo"
	<script> 
		alert('LEADS SUKSES DIUBAH');
		window.location.replace('index.php?page=29g'); </script> ";
	}
	else
	{
	echo "LEADS GAGAL DIUBAH".mssql_get_last_message();
	}
	
}
?>