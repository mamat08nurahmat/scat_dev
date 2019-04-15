 <?php 
session_start();
include('include/config.php');
$eror		= false;
$folder 	= "uploads/photo/";
$file_type	= array('pdf','jpg','jpeg','JPG','JPEG','PDF');
$max_size	= 2000000; // 2MB
if(isset($_POST['kirim'])){
	$id_grup 			= $_POST['id_grup'];
	$id_cabang 			= $_POST['id_cabang'];
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
	$jenis_kelamin		= $_POST['jenis_kelamin'];
	$status 			= $_POST['status'];
	$agama				= $_POST['agama'];
	$telp_rumah 		= $_POST['telp'];
	$no_hp 				= $_POST['hp'];
	$nama_ibu 			= $_POST['ibu'];
	$alamat_ktp 		= $_POST['alamat_ktp'];
	$kota_ktp			= $_POST['kota_ktp'];
	$kodepos_ktp		= $_POST['kodepos_ktp'];
	$tinggal_ktp		= $_POST['tinggal_ktp'];
	$email 				= $_POST['email'];
	$kendaraan 			= $_POST['kendaraan'];
	$nama2 				= $_POST['nama2'];
	$alamat_emergency 	= $_POST['alamat_emergency'];
	$hubungan			= $_POST['hubungan'];
	$telp 				= $_POST['telp2'];
	$hp 				= $_POST['hp2'];
	$ket				= $_POST ['ket'];
	$jp					= $_POST['jenjang_pendidikan'];
	$ns					= $_POST['nama_sekolah'];
	$ks					= $_POST['kota_sekolah'];
	$ps					= $_POST['program_study'];
	$ipk				= $_POST['ipk'];
	$ti					= $_POST['tahun_ijazah'];
	$jp1				= $_POST['jenjang_pendidikan1'];
	$ns1				= $_POST['nama_sekolah1'];
	$ks1				= $_POST['kota_sekolah1'];
	$ps1				= $_POST['program_study1'];
	$ipk1				= $_POST['ipk1'];
	$ti1				= $_POST['tahun_ijazah1'];
	$jp2				= $_POST['jenjang_pendidikan2'];
	$ns2				= $_POST['nama_sekolah2'];
	$ks2				= $_POST['kota_sekolah2'];
	$ps2				= $_POST['program_study2'];
	$ipk2				= $_POST['ipk2'];
	$ti2 				= $_POST['tahun_ijazah2'];
	$perusahaan			= $_POST['perusahaan'];
	$jabatan			= $_POST['jabatan'];
	$masuk				= $_POST['tgl_masuk'];
	$resign				= $_POST['tgl_resign'];
	$alasan				= $_POST['alasan'];
	$perusahaan1		= $_POST['perusahaan1'];
	$jabatan1			= $_POST['jabatan1'];
	$masuk1				= $_POST['tgl_masuk1'];
	$resign1			= $_POST['tgl_resign1'];
	$alasan1			= $_POST['alasan1'];
	$perusahaan2		= $_POST['perusahaan2'];
	$jabatan2			= $_POST['jabatan2'];
	$masuk2				= $_POST['tgl_masuk2'];
	$resign2			= $_POST['tgl_resign2'];
	$alasan2			= $_POST['alasan2'];
	$sb					= $_POST['sedang_bekerja'];
	$tgl				= $_POST['tgl'];
	//upload foto
	$file_name	= $_FILES['photo']['name'];
	$file_size	= $_FILES['photo']['size'];
	$explode	= explode('.',$file_name);
	$extensi	= $explode[count($explode)-1];
	//upload ktp
	$file_name1	= $_FILES['upload']['name'];
	$file_size1	= $_FILES['upload']['size'];
	$explode1	= explode('.',$file_name1);
	$extensi1	= $explode[count($explode1)-1];
	//upload komitmen
	$file_name2	= $_FILES['komitmen']['name'];
	$file_size2	= $_FILES['komitmen']['size'];
	$explode2	= explode('.',$file_name2);
	$extensi2	= $explode2[count($explode2)-1];
	//check apakah type file sudah sesuai
	if(!in_array($extensi,$file_type)){
		$eror   = true;
		$pesan .= '- Type file yang anda upload tidak sesuai , harus jpg atau jpeg <br />';
	}
	if($file_size > $max_size){
		$eror   = true;
		$pesan .= '- Ukuran file melebihi batas maximum<br />';
	}
	//check ukuran file apakah sudah sesuai

	if($eror == true){
		echo '<div id="eror">'.$pesan.'</div>';
	}
	else{
		//mulai memproses upload file
		move_uploaded_file($_FILES['photo']['tmp_name'], $folder.$file_name);
		move_uploaded_file($_FILES['upload']['tmp_name'], $folder.$file_name1);
		move_uploaded_file($_FILES['komitmen']['tmp_name'], $folder.$file_name2);	
			//catat nama file ke database
			$order = mssql_query("INSERT INTO contoh(
			id_grup,
			id_cabang,
			photo,
			nama_lengkap,
			nama_panggil,
			no_ktp,
			tempat_lahir,
			tanggal_lahir,
			alamat,
			kota,
			kodepos,
			lama,
			status_tinggal,
			jenis_kelamin,
			status,
			agama,
			telp,
			hp,
			ibu,
			alamat_ktp,
			kota_ktp,
			kodepos_ktp,
			tinggal_ktp,
			email,
			kendaraan,
			nama2,
			alamat_emergency,
			hubungan,
			telp2,
			hp2,
			ket,
			id_vendor,
			jenjang_pendidikan,
			nama_sekolah,
			kota_sekolah,
			program_study,
			ipk,
			tahun_ijazah,
			jenjang_pendidikan1,
			nama_sekolah1,
			kota_sekolah1,
			program_study1,
			ipk1,
			tahun_ijazah1,
			jenjang_pendidikan2,
			nama_sekolah2,
			kota_sekolah2,
			program_study2,
			ipk2,
			tahun_ijazah2,
			perusahaan,
			jabatan,
			tgl_masuk,
			tgl_resign,
			alasan,
			perusahaan1,
			jabatan1,
			tgl_masuk1,
			tgl_resign1,
			alasan1,
			perusahaan2,
			jabatan2,
			tgl_masuk2,
			tgl_resign2,
			alasan2,
			sedang_bekerja,
			tgl,
			nama_pemproses,
			upload,
			komitmen
			)
							VALUES(
							'$id_grup',
							'$id_cabang',
							'$file_name',
							'$nama_lengkap',
							'$nama_panggil',
							'$no_ktp',
							'$tempat_lahir',
							'$tanggal_lahir',
							'$alamat',
							'$kota',
							'$kodepos',
							'$lama_tinggal',
							'$status_tinggal',
							'$jenis_kelamin',
							'$status',
							'$agama',
							'$telp_rumah',
							'$no_hp',
							'$nama_ibu',
							'$alamat_ktp',
							'$kota_ktp',
							'$kodepos_ktp',
							'$tinggal_ktp',
							'$email',
							'$kendaraan',
							'$nama2',
							'$alamat_emergency',
							'$hubungan',
							'$telp',
							'$hp',
							'$ket',
							'$_SESSION[id_vendor]',
							'$jp',
							'$ns',
							'$ks',
							'$ps',
							'$ipk',
							'$ti',
							'$jp1',
							'$ns1',
							'$ks1',
							'$ps1',
							'$ipk1',
							'$ti1',
							'$jp2',
							'$ns2',
							'$ks2',
							'$ps2',
							'$ipk2',
							'$ti2',
							'$perusahaan',
							'$jabatan',
							'$masuk',
							'$resign',
							'$alasan',
							'$perusahaan1',
							'$jabatan1',
							'$masuk1',
							'$resign1',
							'$alasan1',
							'$perusahaan2',
							'$jabatan2',
							'$masuk2',
							'$resign2',
							'$alasan2',
							'$sb',
							 SYSDATETIME(),
							'$_SESSION[namauser]',
							'$file_name1',
							'$file_name2'
							)");				
		$approve= mssql_query ("INSERT INTO history_sales(id,ket,tanggal,npp)
									SELECT id,ket,tgl,nama_pemproses from contoh where no_ktp='$no_ktp'");
	if($order && $approve)
	{
	echo"
	<script> 
		alert('DATA SUKSES DITAMBAHKAN');
		window.location.replace('index.php?page=10b'); </script> ";
	}
	else
	{
	echo "Gagal di tambah ulangi lagi".mssql_get_last_message();
	} 
  }
}
?>