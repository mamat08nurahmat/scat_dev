<?php
session_start();
include('include/config.php');
	// deklarasikan variabel
	$kd_npp			= $_POST['id'];
	$tanggal_aktif	= $_POST['tanggal_aktif'];
	$tanggal_resign	= $_POST['tanggal_resign'];
	$keterangan 	= $_POST['keterangan'];
	$tanggal_buat	= $_POST['tanggal_buat'];
	$status_sales	= $_POST['status_sales'];
			mssql_query("UPDATE sales_penyelia SET 
			tanggal_aktif	= '$tanggal_aktif',
			tanggal_resign 	= '$tanggal_resign',
			keterangan 		= '$keterangan',
			tanggal_buat 	= SYSDATETIME(),
			status_sales	= '$status_sales'
			WHERE kd_npp ='$kd_npp'
			");
?>
