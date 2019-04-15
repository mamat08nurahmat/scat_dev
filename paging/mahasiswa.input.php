<?php
require 'koneksi.php';
include('koneksi.php');
// proses menghapus data mahasiswa
if(isset($_POST['hapus'])) {
	mssql_query("DELETE FROM sales WHERE npp=$_POST['hapus']");
} else {
	// deklarasikan variabel
	$npp			= $_POST['npp'];
	$id_grup		= $_POST['id_grup'];
	$id_vendor		= $_POST['id_vendor'];
	$id_cabang		= $_POST['id_cabang'];
	$nama			= $_POST['nama'];
	$tanggal_lahir 	= $_POST['tanggal_lahir'];
	$status 		= $_POST['status'];
	$id_user_atasan	= $_POST['id_user_atasan'];
	$id_user_leader	= $_POST['id_user_leader'];
	$grade			= $_POST['grade'];
	$alamat			= $_POST['alamat'];
	$telepon		= $_POST['telepon'];
	$keterangan		= $_POST['keterangan'];
	$tanggal_aktif	= $_POST['tanggal_aktif'];
	$tanggal_resign	= $_POST['tanggal_resign'];
	$tanggal_buat	= $_POST['tanggal_buat'];
	
	// validasi agar tidak ada data yang kosong
	if($npp!="" && $id_group!="" && $id_vendor!="" && $id_cabang!="" && $nama!="" && $grade!="" && $tanggal_aktif!="" && $tanggal_resign!="") {
		// proses tambah data mahasiswa
		if($npp == 0) {
			mssql_query("INSERT INTO sales VALUES('$npp','$id_grup','$id_vendor','$id_cabang','$nama','$tanggal_lahir','$status','$id_user_atasan','$id_user_leader','$grade'
			,'$alamat','$telepon','$keterangan','$tanggal_aktif','$tanggal_resign','$tanggal_buat')");
		// proses ubah data mahasiswa
		} else {
			mssql_query("UPDATE sales SET 
	npp 			= '$npp',
	id_group		= '$id_grup',
	id_vendor		= '$id_vendor',
	id_cabang		= '$id_cabang',
	nama 			= '$nama',
	tanggal_lahir 	= '$tanggal_lahir',
	status 			= '$status',
	id_user_atasan 	= '$id_user_atasan',
	id_user_leader 	= '$id_user_leader',
	grade			= '$grade',
	alamat 			= '$alamat',
	telepon 		= '$telepon',
	keterangan 		= '$keterangan',
	tanggal_aktif 	= '$tanggal_aktif',
	tanggal_resign	= '$tanggal_resign',
	tanggal_buat	= '$tanggal_buat',
	where npp = $npp
			");
		}
	}
}


?>
