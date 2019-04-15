 <?php
// buat koneksi ke database mssql
include('include/config.php');

// proses menghapus data mahasiswa
if(isset($_POST['hapus'])) {
	mssql_query("DELETE FROM temp_sales WHERE kd_npp=".$_POST['hapus']);
} else {
	// deklarasikan variabel
	$kd_npp			= $_POST['id'];
	$npp			= $_POST['npp'];
	$id_grup		= $_POST['id_grup'];
	$id_cabang		= $_POST['id_cabang'];
	$nama			= $_POST['nama'];
	$panggilan		= $_POST['nama_panggilan'];
	$ec_nama		= $_POST['ec_nama'];
	$jenis			= $_POST['jenis'];
	$tempat_lahir	= $_POST['tempat_lahir'];
	$fileName 		= $_FILES['path']['name'];
	$tanggal_lahir	= $_POST['tanggal_lahir'];
	$alamat			= $_POST['alamat_1'];
	$kota_1			= $_POST['kota_1'];
	$kode_pos_1		= $_POST['kode_pos_1'];
	$lama_tinggal_1	= $_POST['lama_tinggal_1'];
	$status_tinggal	= $_POST['status_tinggal'];
	$agama			= $_POST['agama'];
	$telp_rumah		= $_POST['telp_rumah'];
	$ibu			= $_POST['ibu'];
	$telp_user_atasan 	= $_POST['telp_user_atasan'];
	$email 			= $_POST['email'];
	$kendaraan 		= $_POST['kendaraan'];
	$no_ktp 		= $_POST['no_ktp'];
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
	$ket_tolak		= $_POST['ket_tolak'];

	
	// validasi agar tidak ada data yang kosong
	if($npp!="" && $nama!="") {
		// proses tambah data mahasiswa
		if($kd_npp==0) {
			mssql_query("INSERT INTO temp_sales
			(
			npp,
			id_grup,
			id_cabang,
			nama,
			nama_panggilan,
			ec_nama,
			jenis,
			tempat_lahir,
			path,
			tanggal_lahir,
			alamat_1,
			kota_1,
			kode_pos_1,
			lama_tinggal_1,
			status_tinggal,
			agama,
			telp_rumah,
			ibu,
			telp_user_atasan,
			email,
			kendaraan,
			no_ktp,
			status,
			id_vendor,
			id_user_atasan,
			id_user_leader,
			grade,telepon,
			keterangan,
			tanggal_aktif,
			tanggal_resign,
			tanggal_buat,
			pass,
			status_sales,
			ket,
			ket_tolak
			) 
			VALUES
			(
			'$npp',
			'$id_grup',
			'$id_cabang',
			'$nama',
			'$panggilan',
			'$ec_nama',
			'$jenis',
			'$tempat_lahir',
			'$fileName',
			'$tanggal_lahir',
			'$alamat',
			'$kota_1',
			'$kode_pos_1',
			'$lama_tinggal_1',
			'$status_tinggal',
			'$agama',
			'$telp_rumah',
			'$ibu',
			'$telp_user_atasan',
			'$email',
			'$kendaraan',
			'$no_ktp',
			'$status',
			'$id_vendor',
			'$id_user_atasan',
			'$id_user_leader',
			'$grade','$telepon',
			'$keterangan',
			'$tanggal_aktif',
			'$tanggal_resign',
			'$tanggal_buat',
			'$pass',
			'$status_sales',
			1,
			'$ket_tolak'
			)");
			move_uploaded_file($_FILES['path']['tmp_name'], "images/".$_FILES['path']['name']);
		// proses ubah data mahasiswa
		} else {
			mssql_query("UPDATE temp_sales SET 
			npp 			= '$npp',
			id_grup 		= '$id_grup',
			id_cabang 		= '$id_cabang',
			nama 			= '$nama',
			nama_panggilan 	= '$panggilan',
			ec_nama		 	= '$ec_nama',
			jenis		 	= '$jenis',
			tempat_lahir	= '$tempat_lahir',
			path			= '$fileName',
			tanggal_lahir 	= '$tanggal_lahir',
			alamat_1 		= '$alamat',
			kota_1			= '$kota_1',
			kode_pos_1		= '$kode_pos_1',
			lama_tinggal_1  = '$lama_tinggal_1',
			status_tinggal	= '$status_tinggal',
			agama			= '$agama',
			telp_rumah		= '$telp_rumah',
			ibu				= '$ibu',
			telp_user_atasan= '$telp_user_atasan',
			email			= '$email',
			kendaraan		= '$kendaraan',
			no_ktp			= '$no_ktp',
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
			ket				= '1',
			ket_tolak		= '$ket_tolak'
			WHERE kd_npp = $kd_npp
			");
		}
	}
}

?>
