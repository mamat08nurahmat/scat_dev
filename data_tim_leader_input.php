<?php
session_start();
// buat koneksi ke database mssql
include('include/config.php');

if($_POST['pilih']){
	// deklarasikan variabel
	$id				= $_POST['id'];
	$nama_nasabah	= $_POST['nama_nasabah'];
	$pp				= $_POST['persetujuan_pengalihan'];
	$nominal		= str_replace ("Rp","",str_replace(".","",$_POST['nominal']));
	$tgl_outstanding= $_POST['tgl_outstanding'];
	$no_perjanjian	= $_POST['no_perjanjian'];
	$no_rekening	= $_POST['no_rekening'];
	$npp			= $_POST['npp'];
	$perusahaan		= $_POST['perusahaan'];
	$keterangan		= $_POST['keterangan'];
	$ket			= $_POST['ket'];
	$tgl_update		= $_POST['tgl_update'];

	$order = mssql_query("UPDATE report_tl SET 
			nama_nasabah			= '$nama_nasabah',
			persetujuan_pengalihan 	= '$pp',
			nominal				 	= '$nominal',
			tgl_outstanding		 	= '$tgl_outstanding',
			no_perjanjian	 		= '$no_perjanjian',
			no_rekening				= '$no_rekening',
			npp						= '$npp',
			perusahaan				= '$perusahaan',
			keterangan			 	= '$keterangan',
			ket			 			= '$pp',
			tgl_update	 			= SYSDATETIME(),
			nama_pemproses			= '$_SESSION[namauser]'
			WHERE id_report ='$id'");
//var_dump($_POST); die();				
				if($order)
		{
		echo"
			<script> 
				alert('DATA SUDAH DI PROSES');
				window.location.replace('index.php?page=33'); </script> ";
		}
		else
		{
		echo "LEADS GAGAL DIPROSES ".mssql_get_last_message();
		}
  }
?>
