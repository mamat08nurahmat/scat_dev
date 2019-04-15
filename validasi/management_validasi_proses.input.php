<?php
// buat koneksi ke database mssql
include('include/config.php');

// proses menghapus data mahasiswa
if(isset($_POST['hapus'])) {
	mssql_query("DELETE FROM sales WHERE kd_npp=".$_POST['hapus']);
} else {
	// deklarasikan variabel
	$kd_npp			= $_POST['id'];
	$npp			= $_POST['npp'];
	$id_grup		= $_POST['id_grup'];
	$id_cabang		= $_POST['id_cabang'];
	$nama			= $_POST['nama'];
	$tanggal_lahir	= $_POST['tanggal_lahir'];
	$alamat			= $_POST['alamat'];
	$status			= $_POST['status'];
	$id_vendor 		= $_POST['id_vendor'];
	$id_user_atasan = $_POST['id_user_atasan'];
	$id_user_leader = $_POST['id_user_leader'];
	$grade 			= $_POST['grade'];
	$telepon 		= $_POST['telepon'];
	$keterangan 	= $_POST['keterangan'];
	$tanggal_aktif	= $_POST['tanggal_aktif'];
	$tanggal_resign	= $_POST['tanggal_resign'];
	$tanggal_buat	= $_POST['tanggal_buat'];
	$pass			= $_POST['pass'];
	$status_sales	= $_POST['status_sales'];
	$ket			= $_POST['ket'];

	
	// validasi agar tidak ada data yang kosong
	if($npp!="" && $nama!="") {
		// proses tambah data mahasiswa
		if($kd_npp==0) {
			mssql_query("INSERT INTO temp_sales(npp,id_grup,id_cabang,nama,tanggal_lahir,alamat,status,id_vendor,id_user_atasan,id_user_leader,grade,telepon,keterangan,tanggal_aktif,tanggal_resign,tanggal_buat,pass,status_sales,ket) 
			VALUES('$npp','$id_grup','$id_cabang','$nama','$tanggal_lahir','$alamat','$status','$id_vendor','$id_user_atasan','$id_user_leader','$grade','$telepon','$keterangan','$tanggal_aktif','$tanggal_resign','$tanggal_buat','$pass','$status_sales',1)");
		// proses ubah data mahasiswa
		} else {
			mssql_query("UPDATE sales SET 
			npp 			= '$npp',
			id_grup 		= '$id_grup',
			id_cabang 		= '$id_cabang',
			nama 			= '$nama',
			tanggal_lahir 	= '$tanggal_lahir',
			alamat 			= '$alamat',
			status 			= '$status',
			id_vendor 		= '$id_vendor',
			id_user_atasan 	= '$id_user_atasan',
			id_user_leader 	= '$id_user_leader',
			grade 			= '$grade',
			telepon 		= '$telepon',
			keterangan 		= '$keterangan',
			tanggal_aktif	= '$tanggal_aktif',
			tanggal_resign 	= '$tanggal_resign',
			tanggal_buat 	= '$tanggal_buat',
			pass 			= '$pass',
			status_sales	= '$status_sales',
			ket				= '$ket'
			WHERE kd_npp = $kd_npp
			");
		}
	}
}

?>
