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
	$no_ktp			= $_POST['no_ktp'];
	$tanggal_lahir	= $_POST['tanggal_lahir'];
	$alamat			= $_POST['alamat'];
	$status			= $_POST['status'];
	$id_vendor 		= $_POST['id_vendor'];
	$id_user_atasan = $_POST['id_user_atasan'];
	$id_user_leader = $_POST['id_user_leader'];
	$grade 			= $_POST['grade'];
	$telepon 		= $_POST['telepon'];
	$perusahaan		= $_POST['id_perusahaan'];
	$tanggal_aktif	= $_POST['tanggal_aktif'];
	$tanggal_resign	= $_POST['tanggal_resign'];
	$keterangan 	= $_POST['keterangan'];
	$tanggal_buat	= $_POST['tanggal_buat'];
	$pass			= $_POST['pass'];
	$passen			= md5($pass);
	$status_sales	= $_POST['status_sales'];

	
	// validasi agar tidak ada data yang kosong
	if($npp!="" && $nama!="" && $alamat!="") {
		// proses tambah data mahasiswa
		if($kd_npp==0) {
			$babi=mssql_query("INSERT INTO sales(npp,id_grup,id_cabang,nama,no_ktp,tanggal_lahir,alamat,status,id_vendor,id_user_atasan,id_user_leader,grade,telepon,id_perusahaan,tanggal_aktif,tanggal_resign,keterangan,tanggal_buat,pass,status_sales) 
			VALUES('$npp','$id_grup','$id_cabang','$nama','$no_ktp','$tanggal_lahir','$alamat','$status','$id_vendor','$id_user_atasan','$id_user_leader','$grade','$telepon','$perusahaan','$tanggal_aktif','$tanggal_resign','$keterangan','$tanggal_buat','$passen','$status_sales')");
		// proses ubah data mahasiswa
		} else {
			mssql_query("UPDATE sales SET 
			npp 			= '$npp',
			id_grup 		= '$id_grup',
			id_cabang 		= '$id_cabang',
			nama 			= '$nama',
			no_ktp			= '$no_ktp',
			tanggal_lahir 	= '$tanggal_lahir',
			alamat 			= '$alamat',
			status 			= '$status',
			id_vendor 		= '$id_vendor',
			id_user_atasan 	= '$id_user_atasan',
			id_user_leader 	= '$id_user_leader',
			grade 			= '$grade',
			telepon 		= '$telepon',
			id_perusahaan	= '$perusahaan',
			tanggal_aktif	= '$tanggal_aktif',
			tanggal_resign 	= '$tanggal_resign',
			keterangan 		= '$keterangan',
			tanggal_buat 	= '$tanggal_buat',
			pass 			= '$passen',
			status_sales	= '$status_sales'
			WHERE kd_npp = $kd_npp
			");
		}
	}
}
echo $babi;
?>
