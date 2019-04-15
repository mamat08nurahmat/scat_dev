<?php
session_start();
// buat koneksi ke database mssql
include('include/config.php');

if($_POST['pilih']){
	// deklarasikan variabel
	$id						= $_POST['id'];
	$pp						= $_POST['persetujuan_pengalihan'];
	//$nominal				= str_replace ("Rp","",str_replace(".","",$_POST['nominal']));
	$tgl_outstanding		= $_POST['tgl_outstanding'];
	$no_perjanjian			= $_POST['no_perjanjian'];
	$no_rekening			= $_POST['no_rekening'];
	$angsuran				= $_POST['angsuran'];
	$npp					= $_POST['npp'];
	$perusahaan				= $_POST['perusahaan'];
	$keterangan				= $_POST['keterangan'];
	$ket					= $_POST['ket'];


	$order = mssql_query("UPDATE report_tl SET 
			persetujuan_pengalihan 	= '$pp',
			tgl_outstanding		 	= '$tgl_outstanding',
			no_perjanjian	 		= '$no_perjanjian',
			no_rekening				= '$no_rekening',
			angsuran				= '$angsuran',
			npp						= '$npp',
			perusahaan				= '$perusahaan',
			keterangan			 	= '$keterangan',
			ket			 			= '2',
			tgl_update	 			= SYSDATETIME(),
			nama_pemproses2			= '$_SESSION[namauser]'
			WHERE id_report ='$id'");
//var_dump($_POST); die();		
	if($order)
		{
		echo"
			<script> 
				alert('DATA REPORT SUDAH DI PROSES');
				window.location.replace('index.php?page=33'); </script> ";
		}
		else
		{
		echo "DATA REPORT GAGAL DPROSES ".mssql_get_last_message();
		}
  }
?>
