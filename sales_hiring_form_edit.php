 <?php 
include('include/config.php');
$eror		= false;
$folder 	= "uploads/photo/";
$file_type	= array('pdf','jpg','jpeg','JPG','JPEG','PDF');
$max_size	= 1000000; // 1MB	
if(isset($_POST['ubah'])){
	// deklarasikan variabel
	$kd_npp 			= $_POST['id'];
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
	$ket				= $_POST['ket'];
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
	
	//upload photo
	$file_name			= $_FILES['photo']['name'];
	$file_size			= $_FILES['photo']['size'];
	$explode			= explode('.',$file_name);
	$extensi			= $explode[count($explode)-1];
	//upload ktp
	$file_name1			= $_FILES['upload']['name'];
	$file_size1			= $_FILES['upload']['size'];
	$explode1			= explode('.',$file_name1);
	$extensi1			= $explode[count($explode1)-1];
	//upload komitmen
	$file_name2			= $_FILES['komitmen']['name'];
	$file_size2			= $_FILES['komitmen']['size'];
	$explode2			= explode('.',$file_name2);
	$extensi2			= $explode2[count($explode2)-1];
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
		
	$approve= mssql_query ("INSERT INTO history_sales(id,ket,keterangan,tanggal,npp)
			VALUES('$kd_npp','$ket','$keterangan',SYSDATETIME(),'$_SESSION[namauser]')");
	$order=  mssql_query (" 
	UPDATE contoh SET 
	id_grup 			='$id_grup', 
	id_cabang			='$id_cabang', 
	photo				='$file_name', 
	nama_lengkap		='$nama_lengkap',
	nama_panggil 		='$nama_panggil',
	no_ktp 				='$no_ktp',
	tempat_lahir		='$tempat_lahir',
	tanggal_lahir		='$tanggal_lahir',
	alamat				='$alamat',
	kota				='$kota',
	kodepos				='$kodepos',
	lama				='$lama_tinggal',
	status_tinggal		='$status_tinggal',
	jenis_kelamin		='$jenis_kelamin',
	status 				='$status',
	agama 				='$agama',
	telp				='$telp_rumah',
	hp					='$no_hp',
	ibu					='$nama_ibu',
	alamat_ktp			='$alamat_ktp',
	kota_ktp			='$kota_ktp',
	kodepos_ktp			='$kodepos_ktp',
	tinggal_ktp			='$tinggal_ktp',
	email				='$email',
	kendaraan			='$kendaraan' , 
	nama2				='$nama2', 
	alamat_emergency	='$alamat_emergency',
	hubungan			='$hubungan',
	telp2				='$telp', 
	hp2					='$hp',
	ket					='$ket',
	jenjang_pendidikan  ='$jp',
	nama_sekolah		='$ns',
	kota_sekolah		='$ks',
	program_study		='$ps',
	ipk					='$ipk',
	tahun_ijazah		='$ti',
	jenjang_pendidikan1 ='$jp1',
	nama_sekolah1		='$ns1',
	kota_sekolah1		='$ks1',
	program_study1		='$ps1',
	ipk1				='$ipk1',
	tahun_ijazah1		='$ti1',
	jenjang_pendidikan2 ='$jp2',
	nama_sekolah2		='$ns2',
	kota_sekolah2		='$ks2',
	program_study2		='$ps2',
	ipk2				='$ipk2',
	tahun_ijazah2		='$ti2',
	perusahaan			='$perusahaan',
	jabatan				='$jabatan',
	tgl_masuk			='$masuk',
	tgl_resign			='$resign',
	alasan				='$alasan',
	perusahaan1			='$perusahaan1',
	jabatan1			='$jabatan1',
	tgl_masuk1			='$masuk1',
	tgl_resign1			='$resign1',
	alasan1				='$alasan1',
	perusahaan2			='$perusahaan2',
	jabatan2			='$jabatan2',
	tgl_masuk2			='$masuk2',
	tgl_resign2			='$resign2',
	alasan2				='$alasan2',
	sedang_bekerja		='$sb',
	tgl					= SYSDATETIME(),
	upload				='$file_name1',
	komitmen			='$file_name2'	
	WHERE id ='$kd_npp' " );	
	
if($approve && $order )
	{	
	echo"
	<script> 
		alert('DATA SUKSES DIUBAH');
		window.location.replace('index.php?page=10b');
	</script>";
	}
	else
	{
		echo "    ERROR   ".mssql_get_last_message();
	}
  }
}
?>

<?php
session_start();
include('include/config.php');
$kd_npp = $_GET['id'];
$level=$_SESSION['user_level'];
if($level==1)
	{
	$ceklevel='';
	$cektipe='';
}
elseif($level==2)
	{
	$ceklevel='';
}
elseif($level== 2 ||$level== 3)
{
	$cektipe='where id_grup in (8,9,11,12)';
}
elseif($level==10)
{
	$cektipe='where is_sales=1';
}
else
{
	$ceklevel="and c.id_cabang =".$cbg."";
}
//-------combo user group------
$pilihan = '';
$result = mssql_query("SELECT * FROM app_user_grup ".$cektipe." order by is_sales desc");
while($row = mssql_fetch_array($result))
{
  $pilihan .= "<option value='".$row['id_grup']."'>".$row['nama_grup']."</option>";
}
//-------------------------------------------NPP MUNCUL------

$sql="select max(npp) npp from sales where len(npp) = 5 and id_grup in (8,9,11)"; // selain sales harus lebih dari 5 digit 
$datax=mssql_fetch_array(mssql_query($sql));
?> 
<?php
//-------------------combo wilayah-----------------------------------------
$query = mssql_query ("SELECT id_area, nama_area FROM area ORDER BY nama_area");
$arrpropinsi = array();
while ($row = mssql_fetch_array($query)) {
	$arrpropinsi [ $row['id_area'] ] = $row['nama_area'];
}

if(isset($_GET['action']) && $_GET['action'] == "getKab") {
	$kode_prop = $_GET['kode_prop'];
	
//-------------------combo cabang------------------------------------------
	$query = mssql_query ("SELECT kode_cabang kode, nama_cabang nama FROM cabang WHERE id_area='$kode_prop' and tipe_cabang in ('KCU') ORDER BY nama_cabang");

	$arrkab = array();
	while ($row = mssql_fetch_array($query)) {
		array_push($arrkab, $row);
	}
	echo json_encode($arrkab);
	exit;
}

// query untuk menampilkan mahasiswa berdasarkan kd_npp
$data = mssql_fetch_array(mssql_query("SELECT * FROM contoh a join app_user_grup b on a.id_grup = b.id_grup join cabang c on a.id_cabang=c.kode_cabang join area d on c.id_area=d.id_area WHERE id=".$kd_npp));
// jika kd_npp > 0 / form ubah data
if($kd_npp> 0) {
	$npp 				= $data['npp'];
	$id_grup 			= $data['id_grup'];
	$nama_grup 			= $data['nama_grup'];
	$nama_area 			= $data['nama_area'];
	$id_cabang 			= $data['kode_cabang'];
	$nama_cabang 		= $data['nama_cabang'];
	$photo				= $data['photo'];
	$nama_lengkap		= $data['nama_lengkap'];
	$nama_panggil		= $data['nama_panggil'];
	$no_ktp 			= $data['no_ktp'];
	$tempat_lahir 		= $data['tempat_lahir'];
	$tanggal_lahir 		= $data['tanggal_lahir'];
	$alamat 			= $data['alamat'];
	$kota 				= $data['kota'];
	$kodepos 			= $data['kodepos'];
	$lama_tinggal 		= $data['lama'];
	$status_tinggal 	= $data['status_tinggal'];
	$jenis_kelamin	 	= $data['jenis_kelamin'];
	$status 			= $data['status'];
	$agama				= $data['agama'];
	$telp_rumah 		= $data['telp'];
	$no_hp 				= $data['hp'];
	$nama_ibu 			= $data['ibu'];
	$alamat_ktp 		= $data['alamat_ktp'];
	$kota_ktp 			= $data['kota_ktp'];
	$kodepos_ktp		= $data['kodepos_ktp'];
	$tinggal_ktp 		= $data['tinggal_ktp'];
	$email 				= $data['email'];
	$kendaraan 			= $data['kendaraan'];
	$nama2 				= $data['nama2'];
	$alamat_emergency 	= $data['alamat_emergency'];
	$hubungan			= $data['hubungan'];
	$telp 				= $data['telp2'];
	$hp 				= $data['hp2'];
	$ket				= $data['ket'];
	$jp					= $data['jenjang_pendidikan'];
	$ns					= $data['nama_sekolah'];
	$ks					= $data['kota_sekolah'];
	$ps					= $data['program_study'];
	$ipk				= $data['ipk'];
	$ti					= $data['tahun_ijazah'];
	$jp1				= $data['jenjang_pendidikan1'];
	$ns1				= $data['nama_sekolah1'];
	$ks1				= $data['kota_sekolah1'];
	$ps1				= $data['program_study1'];
	$ipk1				= $data['ipk1'];
	$ti1				= $data['tahun_ijazah1'];
	$jp2				= $data['jenjang_pendidikan2'];
	$ns2				= $data['nama_sekolah2'];
	$ks2				= $data['kota_sekolah2'];
	$ps2				= $data['program_study2'];
	$ipk2				= $data['ipk2'];
	$ti2 				= $data['tahun_ijazah2'];
	$perusahaan			= $data['perusahaan'];
	$jabatan			= $data['jabatan'];
	$masuk				= $data['tgl_masuk'];
	$resign				= $data['tgl_resign'];
	$alasan				= $data['alasan'];
	$perusahaan1		= $data['perusahaan1'];
	$jabatan1			= $data['jabatan1'];
	$masuk1				= $data['tgl_masuk1'];
	$resign1			= $data['tgl_resign1'];
	$alasan1			= $data['alasan1'];
	$perusahaan2		= $data['perusahaan2'];
	$jabatan2			= $data['jabatan2'];
	$masuk2				= $data['tgl_masuk2'];
	$resign2			= $data['tgl_resign2'];
	$alasan2			= $data['alasan2'];
	$sb					= $data['sedang_bekerja'];
	$upload				= $data['upload'];
	$komitmen			= $data['komitmen'];
	
} else {
	$npp 				= "";
	$id_grup 			= "";
	$nama_grup 			= "";
	$nama_area 			= "";
	$id_cabang 			= "";
	$nama_cabang 		= "";
	$photo				= "";
	$nama_lengkap		= "";
	$nama_panggil		= "";
	$no_ktp 			= "";
	$tempat_lahir 		= "";
	$tanggal_lahir 		= "";
	$alamat 			= "";
	$kota 				= "";
	$kodepos 			= "";
	$lama_tinggal 		= "";
	$status_tinggal 	= "";
	$jenis_kelamin	 	= "";
	$status 			= "";
	$agama				= "";
	$telp_rumah 		= "";
	$no_hp 				= "";
	$nama_ibu 			= "";
	$alamat_ktp 		= "";
	$kota_ktp			= "";
	$kodepos_ktp		= "";
	$tinggal_ktp 		= "";
	$email 				= "";
	$kendaraan 			= "";
	$nama2 				= "";
	$alamat_emergency 	= "";
	$hubungan			= "";
	$telp 				= "";
	$hp 				= "";
	$ket				= "";
	$jp					= "";
	$ns					= "";
	$ks					= "";
	$ps					= "";
	$ipk				= "";
	$ti					= "";
	$jp1				= "";
	$ns1				= "";
	$ks1				= "";
	$ps1				= "";
	$ipk1				= "";
	$ti1				= "";
	$jp2				= "";
	$ns2				= "";
	$ks2				= "";
	$ps2				= "";
	$ipk2				= "";
	$ti2 				= "";
	$perusahaan			= "";
	$jabatan			= "";
	$masuk				= "";
	$resign				= "";
	$alasan				= "";
	$perusahaan1		= "";
	$jabatan1			= "";
	$masuk1				= "";
	$resign1			= "";
	$alasan1			= "";
	$perusahaan2		= "";
	$jabatan2			= "";
	$masuk2				= "";
	$resign2			= "";
	$alasan2			= "";
	$sb					= "";
	$upload				= "";
	$komitmen			= "";
}

?>
 
 <form id="form-data1" action="" method="post" enctype="multipart/form-data">  
 
<!--inputan posisi , cabang , npp -->
<div align="center" style="border:1px solid;background-color:#00BFFF"><strong><p>UBAH DATA FORM</strong></p></div>
</tr><p></p>
		<tr><td>Posisi</td>
			<td><select name="id_grup" id="id_grup"  class="required" required >
			<option value="<?php echo $id_grup ?>"><?php echo $nama_grup ?></option>
			<?php echo $pilihan;?>
			</select></td></tr>
	
		<tr><td>Wilayah</td>
			<td><select id="propinsi" name="propinsi" class="required" required >
			<option value="<?php echo $id_area ?>"><?php echo $nama_area ?></option>
			<?php
			foreach ($arrpropinsi as $kode=>$nama) {
				echo "<option value='$kode'>$nama</option>";
			}
			?>
			</select> </td></tr>
		<tr><td>Cabang</td>
			<td><select id="id_cabang" name="id_cabang" class="required" required  >
			<option value="<?php echo $id_cabang ?>"><?php echo $nama_cabang ?></option>
			</select></td></tr>

<div align="center" style="border:1px solid;background-color:#00BFFF"><strong>PERSONAL DATA</strong></div><br>
		<div class="control-group" align = "center" >
			<img src="uploads/photo/<?php echo $photo;?>" id="uploadPreview" style="width: 150px; height:160px;border:1px solid;" /></br>
			<input id="uploadImage" type="file" name="photo"  onchange="PreviewImage();" align="center" value="<?php echo $photo;?>" class="required" required />
		</div>
<table align ="left">
		<input type="hidden" name="id" value="<?php echo $data['id'] ?>">
		<tr><td>Nama Lengkap </td>
			<td><input name="nama_lengkap" value="<?php echo $nama_lengkap ?>" type="text" class="required" required/></td>
		</tr>

		<tr><td>Nama Panggil </td>
			<td><input name="nama_panggil"  value="<?php echo $nama_panggil ?>" type="text" class="required" required /></td>
		</tr>
		
		<tr><td>No KTP </td>
			<td><input name="no_ktp" value="<?php echo $no_ktp ?>"  onkeypress="return hanyaAngka(event)" type="text" readonly="readonly"/></td>
		</tr>
		
		<tr><td>Tempat Lahir </td>
			<td><input name="tempat_lahir" value="<?php echo $tempat_lahir ?>" type="text" class="required" required/></td>
		</tr>
		
		<tr><td>Tanggal Lahir </td>
			<td><input name="tanggal_lahir"  value="<?php echo $tanggal_lahir ?>"id="tanggal_lahir"  type="date" class="required" required /></td>
		</tr>
		
		<tr><td>Alamat Rumah Tinggal Saat Ini </td>
			<td><textarea name="alamat" type="text" class="required" required /><?php echo $alamat ?></textarea></td>
		</tr>
		
		<tr><td>Kota</td>
			<td><input name="kota" value="<?php echo $kota ?>" type="text" class="required" required /></td>
		</tr>
		
		<tr><td>Kode Pos </td>
			<td><input name="kodepos" value="<?php echo $kodepos ?>" onkeypress="return hanyaAngka(event)" type="text" class="required" required /></td>
			
		</tr>
		
		<tr><td>Lama Tinggal </td>
			<td><input style="width:8%;" name="lama"  value="<?php echo $lama_tinggal ?>" onkeypress="return hanyaAngka(event)" type="text" class="required" required />Tahun</td>
		</tr>
		
		<tr><td>Status Tempat Tinggal* </td>
			<td><input name="status_tinggal" type="radio" value="orang tua" <? if($status_tinggal=='orang tua'){echo 'checked';}?>/>orang tua 
			<input name="status_tinggal" type="radio" value="sendiri" <? if($status_tinggal=='sendiri'){echo 'checked';}?>/>sendiri
			<input name="status_tinggal" type="radio" value="sewa" <? if($status_tinggal=='sewa'){echo 'checked';}?>/>sewa 
		</td></tr>
		
</table>

	<table align="center">
		<tr><td>Jenis Kelamin</td>
			<td><input name="jenis_kelamin" type="radio" value="l" <? if($jenis_kelamin=='jenis_kelamin'){echo 'checked';}?> />Laki-laki
			<input name="jenis_kelamin" type="radio" value="p" <? if($jenis_kelamin=='jenis_kelamin'){echo 'checked';}?>  />Perempuan
			</td></tr>
	
		<tr><td>Status</td>
			<td><select name="status" >
			<option <?php if ($status=='lajang'){echo "selected=\"selected\""; } ?>  value='lajang'>lajang</option>
			<option <?php if ($status=='menikah') {echo "selected=\"selected\""; } ?> value='menikah'>menikah</option>
			<option <?php if ($status=='bercerai'){echo "selected=\"selected\""; } ?> value='bercerai'>bercerai</option>
		</select></td></tr>
		
		<tr><td>Agama</td>
			<td><select name="agama" >
			<option value>Pilih agama</option>
			<option <?php if( $agama=='islam'){echo "selected"; } ?> value='islam'>Islam</option>
			<option <?php if( $agama=='kristen'){echo "selected"; } ?> value='kristen'>Kristen</option>
			<option <?php if( $agama=='budha'){echo "selected"; } ?> value='budha'>Budha</option>
			<option <?php if( $agama=='hindu'){echo "selected"; } ?> value='hindu'>hindu</option>
			<option <?php if( $agama=='khongucu'){echo "selected"; } ?> value='khongucu'>Khongucu</option>
			</select></td></tr>
		
		<tr><td>Telp Rumah </td>
			<td><input name="telp" value="<?php echo $telp_rumah ?>" onkeypress="return hanyaAngka(event)"  type="text" /></td>
		</tr>
		
		<tr><td>No HP </td>
			<td><input name="hp"   value="<?php echo $no_hp ?>"  onkeypress="return hanyaAngka(event)" type="text" class="required" required /></td>
		</tr>
		
		<tr><td>Nama Ibu Kandung </td>
			<td><input name="ibu"  value="<?php echo $nama_ibu ?>" type="text" class="required" required /></td>
		</tr>
		
		<tr><td>Alamat Rumah Tinggal KTP </td>
			<td><input name="alamat_ktp"   value="<?php echo $alamat_ktp ?> " type="text" class="required" required /></td>
		</tr>
		
		<tr><td>Kota </td>
			<td><input name="kota_ktp"  value="<?php echo $kota_ktp ?>" type="text" class="required" required /></td>
		</tr>
		
		<tr><td>Kode Pos </td>
			<td><input name="kodepos_ktp"   value="<?php echo $kodepos_ktp ?>" onkeypress="return hanyaAngka(event)" type="text" class="required" required/></td>
		</tr>
		
		<tr><td>Lama Tinggal </td>
			<td><input name="tinggal_ktp"  value="<?php echo $tinggal_ktp ?>" style="width:8%;" onkeypress="return hanyaAngka(event)" type="text" class="required" required/>Tahun</td>
		</tr>
		
		<tr><td>E-mail </td>
			<td><input name="email"  value="<?php echo $email ?>" type="text" class="required" required /></td>
		</tr>
		
		<tr><td>Kendaraan </td>
			<td><input name="kendaraan" type="radio" <? if($kendaraan=='mobil'){echo 'checked';}?> value='mobil'/>mobil 
			<input name="kendaraan" type="radio" <? if($kendaraan=='motor'){echo 'checked';}?>  value='motor'/>motor
			<input name="kendaraan" type="radio" <? if($kendaraan=='kendaraan umum'){echo 'checked';}?> value='kendaraan umun'/>kendaraan umum
		</td></tr>

  </table>
 
<!--inputan emergency contact--> 

<div align="center" style="border:1px solid;background-color:#00BFFF"><strong>EMERGENCY CONTACT</strong></div><br>
<h3>*KELUARGA TIDAK SERUMAH</h3>
<table align= "left">		
		<tr><td>Nama</td>
			<td><input name="nama2"  value="<?php echo $nama2 ?>" type="text" class="required" required/></td>
		</tr>
		<tr><td>Alamat</td>
			<td><textarea name="alamat_emergency" type="text" class="required" required/><?php echo $alamat_emergency ?></textarea></td>
		</tr>
		<tr>
</table>
	<table>
		<td>Hubungan</td>
			<td><input name="hubungan" value="<?php echo $hubungan ?>" type="text" class="required" required/></td>
		</tr>
		<tr>
			<td>Telp Rumah</td>
			<td><input name="telp2" value="<?php echo $telp ?>" onkeypress="return hanyaAngka(event)" type="text"  /></td>
		</tr>
		<tr>
			<td>No HP</td>
			<td><input name="hp2"  value="<?php echo $hp ?>" onkeypress="return hanyaAngka(event)" type="text" class="required" required /></td>
		</tr>
		
	</table>
	</table>
	<div align="center" style="border:1px solid;background-color:#00BFFF"><strong>PENDIDIKAN FORMAL</strong></div>
	<p></p>
	<table border="1">
    <tr align ="center">
        <td>JENJANG PENDIDIKAN</td>
        <td>NAMA SEKOLAH</td>
        <td>KOTA</td>
		<td>PROGRAM STUDY</td>
		<td>NEM/IPK</td>
		<td>TAHUN IJAZAH</td>
    </tr>
    <tr>
        <td><input name="jenjang_pendidikan" style="width:125px;" type="text" value="<?php echo $jp ?>"class="required" required /></td>
        <td><input name="nama_sekolah" style="width:200px;" type="text" value="<?php echo $ns ?>"class="required" required /></td>
		<td><input name="kota_sekolah" style="width:100px;" type="text" value="<?php echo $ks ?>"class="required" required /></td>
        <td><input name="program_study" style="width:100px;" type="text" value="<?php echo $ps ?>"class="required" required /></td>
		<td><input name="ipk" style="width:100px;" type="text" value="<?php echo $ipk ?>" onkeypress="return hanyaAngka(event)" class="required" required /></td>
		<td><input name="tahun_ijazah" style="width:100px;" type="text" value="<?php echo $ti ?>" onkeypress="return hanyaAngka(event)" class="required" required /></td>
        
    </tr>
	<tr>
        <td><input name="jenjang_pendidikan1" style="width:125px;" type="text" value="<?php echo $jp1 ?>" /></td>
        <td><input name="nama_sekolah1" style="width:200px;" type="text"value="<?php echo $ns1 ?>" /></td>
		<td><input name="kota_sekolah1" style="width:100px;" type="text"value="<?php echo $ks1 ?>" /></td>
        <td><input name="program_study1" style="width:100px;" type="text" value="<?php echo $ps1 ?>" /></td>
		<td><input name="ipk1" style="width:100px;" type="text" value="<?php echo $ipk1 ?>" onkeypress="return hanyaAngka(event)"/></td>
		<td><input name="tahun_ijazah1" style="width:100px;" type="text" value="<?php echo $ti1 ?>" onkeypress="return hanyaAngka(event)" /></td>
        
    </tr>
	<tr>
        <td><input name="jenjang_pendidikan2" style="width:125px;" type="text" value="<?php echo $jp2 ?>" /></td>
        <td><input name="nama_sekolah2" style="width:200px;" type="text" value="<?php echo $ns2 ?>" /></td>
		<td><input name="kota_sekolah2" style="width:100px;" type="text" value="<?php echo $ks2 ?>" /></td>
        <td><input name="program_study2" style="width:100px;" type="text" value="<?php echo $ps2 ?>" /></td>
		<td><input name="ipk2" style="width:100px;" type="text" value="<?php echo $ipk2 ?>" onkeypress="return hanyaAngka(event)" /></td>
		<td><input name="tahun_ijazah2" style="width:100px;" type="text" value="<?php echo $ti2 ?>" onkeypress="return hanyaAngka(event)" /></td>
        
    </tr>
</table>
<p></p>
<div align="center" style="border:1px solid;background-color:#00BFFF"><strong>PENGALAMAN BEKERJA</strong></div>
<p></p>
<table border="1">
	<tr align ="center">
        <td>PERUSAHAAN</td>
		<td>POSISI/JABATAN</td>
		<td>TANGGAL MASUK</td>
		<td>TANGGAL RESIGN</td>
		<td>KETERANGAN</td>
    </tr>
	<tr>
        <td><input name="perusahaan" style="width:170px;" type="text" value="<?php echo $perusahaan ?>"></td>
		<td><input name="jabatan" style="width:110px;" type="text" value="<?php echo $jabatan ?>" ></td>
		<td><input name="tgl_masuk" style="width:130px;" type="date" value="<?php echo $masuk ?>" ></td>
		<td><input name="tgl_resign" style="width:130px;" type="date" value="<?php echo $resign ?>" ></td>
        <td><input name="alasan" style="width:200px;" type="text" value="<?php echo $alasan ?>" ></td>
	</tr>
	<tr>
        <td><input name="perusahaan1" style="width:170px;" type="text" value="<?php echo $perusahaan1 ?>" ></td>
		<td><input name="jabatan1" style="width:110px;" type="text" value="<?php echo $jabatan1 ?>" ></td>
		<td><input name="tgl_masuk1" style="width:130px;" type="date" value="<?php echo $masuk1 ?>" ></td>
		<td><input name="tgl_resign1" style="width:130px;" type="date" value="<?php echo $resign1 ?>" ></td>
        <td><input name="alasan1" style="width:200px;" type="text" value="<?php echo $alasan1 ?>" ></td>
	</tr>
	<tr>
        <td><input name="perusahaan2" style="width:170px;" type="text" value="<?php echo $perusahaan2 ?>" ></td>
		<td><input name="jabatan2" style="width:110px;" type="text" value="<?php echo $jabatan2 ?>" ></td>
		<td><input name="tgl_masuk2" style="width:130px;" type="date" value="<?php echo $masuk2 ?>"></td>
		<td><input name="tgl_resign2" style="width:130px;" type="date" value="<?php echo $resign2 ?>" ></td>
        <td><input name="alasan2" style="width:200px;" type="text" value="<?php echo $alasan2 ?>" ></td>
	</tr>
	
</table>
<p></p>
<table>
	<tr>
	<td>apakah saat ini sedang bekerja di tempat/perusahaan lain??</td>
	<td><input name="sedang_bekerja" type="radio" <? if($sb=='1'){echo 'checked';}?> value='1'/>ya 
		<input name="sedang_bekerja" type="radio" <? if($sb=='2'){echo 'checked';}?>  value='2'/>Tidak
	</tr>
</table>

		<div class="control-group" align = "left" >
		<img src="uploads/photo/<?php echo $upload;?>" id="uploadPreview1" style="width: 200px; height:150px;border:1px solid;" /></br>
				<input id="uploadImage1" type="file" name="upload"  onchange="PreviewImage1();" align="center" value="<?php echo $upload;?>" class="required" required />
		</div>
		<div class="control-group" align = "left" >
		<img src="uploads/photo/<?php echo $komitmen;?>" id="uploadPreview2" style="width: 200px; height:150px;border:1px solid;" /></br>
				<input id="uploadImage2" type="file" name="komitmen"  onchange="PreviewImage2();" align="center" value="<?php echo $komitmen;?>" class="required" required />
		</div>
		
		<?php
		$date=date('Y/m/d');
		?>
		<tr>
		<td><input type="hidden" name="tgl" value="<?php echo $date ?>">
		</td></tr>
		<tr><td>	
	<table align="center">
		<tr><td>
		<select name="ket" >
		<option <?php if ($ket=='2'){echo "selected=\"selected\""; } ?>  class="required" required value='2'>waiting approve </option>
		<option <?php if ($ket=='4'){echo "selected=\"selected\""; } ?>  value='4'>cancel</option>
		</select>
		</td></tr>
	</table>

		<tr>
		<td>
				<input type="submit" class="btn btn-primary" name="ubah" value="SIMPAN">
				<a href="index.php?page=10b" class="btn btn-danger" >kembali</a>
		</td>
		</tr>
		
</form>

<!--Script yang dibutuhkan-->	

<script src="jquery-1.8.3.min.js"></script>
<script src="sales-js/bootstrap.min.js"></script>

<script type="text/javascript">
	function PreviewImage() {
	var oFReader = new FileReader();
	oFReader.readAsDataURL(document.getElementById("uploadImage").files[0]);

	oFReader.onload = function (oFREvent) {
	document.getElementById("uploadPreview").src = oFREvent.target.result;
		};
	};

	function PreviewImage1() {
	var oFReader = new FileReader();
	oFReader.readAsDataURL(document.getElementById("uploadImage1").files[0]);

	oFReader.onload = function (oFREvent) {
	document.getElementById("uploadPreview1").src = oFREvent.target.result;
		};
	};
				
	function PreviewImage2() {
	var oFReader = new FileReader();
	oFReader.readAsDataURL(document.getElementById("uploadImage2").files[0]);

	oFReader.onload = function (oFREvent) {
	document.getElementById("uploadPreview2").src = oFREvent.target.result;
		};
	};
</script>
	  
	<link rel="stylesheet" type="text/css" href="../combobox/libs/bootstrap.css" media="screen" />
		<script type="text/javascript" src="../combobox/libs/jquery.min.js"></script>
		<script type="text/javascript">
		var j = jQuery.noConflict();
			$(document).ready(function(){
				$('#propinsi').change(function(){
					$.getJSON('mahasiswa.form.php',{action:'getKab', kode_prop:$(this).val()}, function(json){
						$('#id_cabang').html('');
						$.each(json, function(index, row) {
							$('#id_cabang').append('<option value='+row.kode+'>'+row.nama+'</option>');
						});
					});
				});
			});
	</script>
	
	<script>
		function hanyaAngka(evt) {
		  var charCode = (evt.which) ? evt.which : event.keyCode
		   if (charCode > 31 && (charCode < 48 || charCode > 57))
 
		    return false;
		  return true;
		}
	</script>
	<link rel="stylesheet" href="themes/base/jquery.ui.all.css">
	<script src="js/jquery-1.7.2.js"></script>
	<script src="ui/jquery.ui.core.js"></script>
	<script src="ui/jquery.ui.widget.js"></script>
	<script src="ui/jquery.ui.datepicker.js"></script>
	<script>
	
	</script>
		
</html>

