<?php
include('include/config.php');
if(isset($_POST['hapus'])) {
	$hapus= mssql_query("DELETE FROM berita WHERE id_berita=".$_POST['hapus']);
} 
if($_POST['pilih']){
	$id				= $_POST['id_berita'];
	$judul			= $_POST['judul'];
	$isi			= $_POST['isi'];
	$tanggal		= $_POST['tanggal'];
	$aksi			= $_POST['aksi'];
	
		// proses tambah berita
		if($id==0) {
			$tambah= mssql_query("INSERT INTO berita(judul,isi,tanggal,aksi) 
			VALUES('$judul','$isi',SYSDATETIME(),'$aksi')");
		// proses ubah berita
		} else {
			$ubah= mssql_query("UPDATE berita SET 
			judul 			= '$judul',
			isi		 		= '$isi',
			tanggal			= SYSDATETIME(),
			aksi 			= '$aksi'
			WHERE id_berita = $id
			");
		}
	}
if($tambah || $ubah || $hapus)
		{
		echo"
			<script> 
				alert('BERITA BERHASIL DI PROSES');
				window.location.replace('index.php?page=26'); </script> ";
		}
		else
		{
		echo "BERITA GAGAL DI PROSES ".mssql_get_last_message();
		}
		
?>
