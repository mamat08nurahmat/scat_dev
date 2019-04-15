 <?php
// buat koneksi ke database mssql
include('include/config.php');

// proses menghapus data mahasiswa
if(isset($_POST['hapus'])) {
	mssql_query("DELETE FROM history_sales WHERE kd_npp=".$_POST['hapus']);
} else {

	// deklarasikan variabel
	$kd_npp				= $_POST['id'];
	$npp 				= $_POST['npp'];
	$id_grup 			= $_POST['id_grup'];
	$id_cabang 			= $_POST['id_cabang'];
	//$nama_foto 			= $_FILES['photo']['name'];
	$nama_lengkap		= $_POST['nama_lengkap'];
	$nama_panggil		= $_POST['nama_panggil'];
	$no_ktp 			= $_POST['no_ktp'];
	$tempat_lahir 		= $_POST['tempat_lahir'];
	$tanggal_lahir 		= $_POST['tanggal_lahir'];
	$alamat 			= $_POST['alamat'];
	$kota 				= $_POST['kota'];
	$kodepos 			= $_POST['kodepos'];
	$lama_tinggal 		= $_POST['lama'];
	$status_tinggal 	= $_POST['status_tinggal'];
	$agama				= $_POST['agama'];
	$telp_rumah 		= $_POST['telp'];
	$no_hp 				= $_POST['hp'];
	$nama_ibu 			= $_POST['ibu'];
	$id_vendor			= $_POST['id_vendor'];
	$status 			= $_POST['status'];
	$id_user_atasan     = $_POST['id_user_atasan'];
	$id_user_leader     = $_POST['id_user_leader'];
	$grade              = $_POST['grade'];
	$tanggal_aktif		= $_POST['tanggal_aktif'];
	$tanggal_resign		= $_POST['tanggal_resign'];
	$tanggal_buat		= $_POST['tanggal_buat'];
	$pass				= $_POST['pass'];
	$ket				= $_POST['ket'];
	$ket_tolak			= $_POST['ket_tolak'];

	
	// validasi agar tidak ada data yang kosong
	if($npp!="" && $nama!="") {
		
	// deklarasikan variabel
$target_dir = "uploads/photo/";
$nama_foto1 = $_FILES['photo']['name'];
$nama_foto = time()."_".$nama_foto1;
$target_file = $target_dir . basename($nama_foto);
$temp = $_FILES["photo"]["tmp_name"];	
$upload = move_uploaded_file($temp, $target_file);	
if(!$upload){
echo"GAGAL Upload Foto";	

}
		// proses tambah data mahasiswa
		
	if($kd_npp==0) {
	$order = "INSERT INTO history_sales
			(kd_npp,npp,id_grup,id_cabang,photo,nama_lengkap,nama_panggil,no_ktp,tempat_lahir,tanggal_lahir,
			alamat,kota,kodepos,lama,status_tinggal,agama,telp,hp,ibu,id_vendor,status,id_user_atasan,
			id_user_leader,grade,tanggal_aktif,tanggal_resign,tanggal_buat,pass,ket,ket_tolak)
	
	VALUES('$npp','$id_grup','$id_cabang','$nama_foto','$nama_lengkap','$nama_panggil','$no_ktp','$tempat_lahir',
			'$tanggal_lahir','$alamat','$kota','$kodepos','$lama_tinggal','$status_tinggal','$agama','$telp_rumah','$no_hp','$nama_ibu',
			'$id_vendor','$status','$id_user_atasan','$id_user_leader', '$grade','$tanggal_aktif','$tanggal_resign', '$tanggal_buat','$pass','$ket','$ket_tolak')";
			
	}
		// proses ubah data mahasiswa
		} else {
			mssql_query("UPDATE history_sales SET 
				kd_npp 			= '$kd_npp'
				npp  			= '$npp'
	            id_grup			= '$id_grup'
				id_cabang		= '$id_cabang'
				nama_lengkap 	= '$nama_lengkap'
				nama_panggil	= '$nama_panggil'
				no_ktp			= '$no_ktp'
				tempat_lahir	= '$tempat_lahir'
				tanggal_lahir	= '$tanggal_lahir'
				alamat			= '$alamat'
				kota			= '$kota'
				kodepos			= '$kodepos'
				lama			= '$lama_tinggal'
				status_tinggal	= '$status_tinggal'
				agama			= '$agama'
				telp			= '$telp_rumah '
				hp				= '$no_hp'
				ibu				= '$nama_ibu'
				id_vendor		= '$id_vendor'
				status			= '$status'
				id_user_atasan	= '$id_user_atasan'
				id_user_leader	= '$id_user_leader'
				grade			= '$grade'
				tanggal_aktif	= '$tanggal_aktif'
				tanggal_resign  = '$tanggal_resign'
				tanggal_buat	= '$tanggal_buat'
				pass			= '$pass'
				ket				= '$ket'
				ket_tolak		= '$ket_tolak'
			");
		}
		
	$result = mssql_query($order);	
	if($result)
	{
	echo"
	<script> 
		alert('DATA SUKSES DITAMBAHKAN');
		window.history.back();
		
	</script>";
	}
	else
	{
	//echo("<script> alert('DATA GAGAL DITAMBAHKAN');
		//window.location.replace('index.php?page=10a'); </script>");
		echo "    ERROR   ".mssql_get_last_message();
	}

}


?>
