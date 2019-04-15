<?php 
include('include/config.php');
if($_POST['pilih']){
	$no_aplikasi		= $_POST['no_aplikasi'];	
	$nama_nasabah		= $_POST['nama_nasabah'];
	$tanggal_booking	= $_POST['tanggal_booking'];
	$nama_produk		= $_POST['nama_produk'];		
	$nominal			= $_POST['nominal'];	
	$npp				= $_POST['npp'];	
	$bulan				= $_POST['bulan'];	
	$tahun				= $_POST['tahun'];
	$nama_pemproses		= $_POST['nama_pemproses'];
	$sumber				= $_POST['sumber'];

	$developer			= mssql_query("SELECT COUNT(*) AS total FROM data_developer where npp='61425'");
	$dev 				= mssql_fetch_assoc($developer);
	$d					= $dev['total'];

if($d >=2){
	echo"
	<script> 
		alert('TIDAK BISA DISIMPAN KARENA DATA DEVELOPER LEBIH DARI 2');
		window.location.replace('index.php?page=31b'); </script> ";	
}else{
	
	$order = mssql_query("INSERT INTO data_developer(no_aplikasi,nama_nasabah,tanggal_booking,nama_produk,nominal,npp,bulan,tahun,nama_pemproses,sumber)
					VALUES('$no_aplikasi','$nama_nasabah','$tanggal_booking','$nama_produk','$nominal','$npp','$bulan','$tahun','$nama_pemproses','$sumber')");	
	if($order)
	{
	echo"
	<script> 
		alert('DATA DEVELOPER DI TAMBAHKAN');
		window.location.replace('index.php?page=31b'); </script> ";
	}
	else
	{
	echo "DATA DEVELOPER GAGAL DI TAMBAHKAN".mssql_get_last_message();
	}	
  }
}
?>