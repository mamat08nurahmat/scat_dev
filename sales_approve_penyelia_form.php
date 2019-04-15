 <?php 
session_start();
include('include/config.php');
if(isset($_POST['simpan'])){
	// deklarasikan variabe
	$kd_npp 			= $_POST['kd_npp'];
	$ket				= $_POST['ket']; 
	$keterangan			= $_POST['keterangan'];

	$aprove = mssql_query ("UPDATE contoh SET ket='$ket',tgl=SYSDATETIME() WHERE id ='$kd_npp' ") ;
	$order 	= mssql_query ("INSERT INTO history_sales(id,ket,keterangan,tanggal,npp)
							VALUES('$kd_npp','$ket','$keterangan', SYSDATETIME(),'$_SESSION[namauser]')");	
	if($order && $aprove)
	{
	echo"
	<script> 
		alert('DATA SUKSES DIPROSES');
		window.location.replace('index.php?page=10m');
	</script>";
	}
	else
	{
		echo "    ERROR   ".mssql_get_last_message();
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
	$cektipe='and id_grup in (8,9,11,12)';
}
elseif($level==10)
{
	$cektipe="and a.id_vendor=".$_SESSION['id_vendor']." and b.is_sales=1 ";
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
	$jenis_kelamin		= $data['jenis_kelamin'];
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
	$keterangan			= $data['keterangan'];
	$tanggal			= $data['tanggal'];
	$upload				= $data['upload'];
	$komitmen			= $data['komitmen'];
} else {
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
	$jenis_kelamin		= "";
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
	$keterangan			= "";
	$tanggal			= "";
	$upload				= "";
	$komitmen			= "";
}

?>
<form id="form-data1" action="" method="post" enctype="multipart/form-data" >  
<input type="hidden" name="kd_npp" value="<?=$kd_npp;?>">
<div align="center" style="border:1px solid;background-color:#00BFFF"><strong><p>REGISTRASI FORM APPROVE</strong></p></div><br>
		<tr><td>Posisi</td>
		<td><select name="id_grup" id="id_grup" readonly="readonly">
			<option value="<?php echo $id_grup ?>"><?php echo $nama_grup ?></option>
			<?php echo $pilihan;?>
			</select></td></tr>
	
		<tr><td>Wilayah</td>
		<td><select id="propinsi" name="propinsi"  readonly="readonly" >
			<option value="<?php echo $id_area ?>"><?php echo $nama_area ?></option>
			<?php
			foreach ($arrpropinsi as $kode=>$nama) {
				echo "<option value='$kode'>$nama</option>";
			}
			?>
			</select> </td></tr>
		<tr><td>Cabang</td>
		<td><select id="id_cabang" name="id_cabang"  readonly="readonly"   >
			<option value="<?php echo $id_cabang ?>"><?php echo $nama_cabang ?></option>
			</select></td></tr>

<div align="center" style="border:1px solid;background-color:#00BFFF"><strong>PERSONAL DATA</strong></div><br>
<div class="control-group" align = "center" >
		<img src="uploads/photo/<?php echo $photo;?>" id="uploadPreview" style="width: 150px; height:160px;border:1px solid;" /></br>
		<?php echo $photo;?>
		</div>

<table align ="left">
		<tr><td>Nama Lengkap </td>
			<td><input name="nama_lengkap" value="<?php echo $nama_lengkap ?>" type="text" readonly="readonly"> </td>
		</tr>

		<tr><td>Nama Panggil </td>
			<td><input name="nama_panggil"  value="<?php echo $nama_panggil ?>" type="text" readonly="readonly"></td>
		</tr>
		
		<tr><td>No KTP </td>
			<td><input name="no_ktp" value="<?php echo $no_ktp ?>" type="text" readonly="readonly"></td>
		</tr>
		
		<tr><td>Tempat Lahir </td>
			<td><input name="tempat_lahir" value="<?php echo $tempat_lahir ?>" type="text" readonly="readonly"></td>
		</tr>
		
		<tr><td>Tanggal Lahir </td>
			<td><input name="tanggal_lahir"  value="<?php echo $tanggal_lahir ?>" type="date" readonly="readonly"></td>
		</tr>
		
		<tr><td>Alamat Rumah Tinggal Saat Ini </td>
			<td><textarea name="alamat" type="text" readonly="readonly"><?php echo $alamat ?></textarea></td>
		</tr>
		
		<tr><td>Kota</td>
			<td><input name="kota"  value="<?php echo $kota ?>" type="text" readonly="readonly"></td>
		</tr>
		
		<tr><td>Kode Pos </td>
			<td><input name="kodepos" value="<?php echo $kodepos ?>" type="text" readonly="readonly"></td>
		</tr>
		
		<tr><td>Lama Tinggal </td>
			<td><input style="width:8%;" name="lama"  value="<?php echo $lama_tinggal ?>" type="text" readonly="readonly">Tahun</td>
		</tr>
		
		<tr><td>Status Tempat Tinggal* </td>
			<td>
			<input name="status_tinggal" type="radio" value="orang tua" <? if($status_tinggal=='orang tua'){echo 'checked';}?>/>orang tua 
			<input name="status_tinggal" type="radio" value="sendiri" <? if($status_tinggal=='sendiri'){echo 'checked';}?>/>sendiri
			<input name="status_tinggal" type="radio" value="sewa" <? if($status_tinggal=='sewa'){echo 'checked';}?>/>sewa 
			</td></tr>
			
</table>

	<table align="center">
		<tr><td>Jenis Kelamin</td>
			<td><input name="jenis_kelamin" type="radio" value="l" <? if($jenis_kelamin=='l'){echo 'checked';}?> />Laki-laki
				<input name="jenis_kelamin" type="radio" value="p" <? if($jenis_kelamin=='p'){echo 'checked';}?>  />Perempuan
			</td></tr>
			
		<tr><td>Status</td>
			<td><select name="status" readonly="readonly">
				<option <?php if ($status=='lajang'){echo "selected=\"selected\""; } ?>  value='lajang'>lajang</option>
				<option <?php if ($status=='menikah') {echo "selected=\"selected\""; } ?> value='menikah'>menikah</option>
				<option <?php if ($status=='bercerai'){echo "selected=\"selected\""; } ?> value='bercerai'>bercerai</option>
				</select></td></tr>
		
		<tr><td>Agama</td>
			<td><select name="agama" readonly="readonly">
				<option value>Pilih agama</option>
				<option <?php if( $agama=='islam'){echo "selected"; } ?> value='islam'>Islam</option>
				<option <?php if( $agama=='kristen'){echo "selected"; } ?> value='kristen'>Kristen</option>
				<option <?php if( $agama=='budha'){echo "selected"; } ?> value='budha'>Budha</option>
				<option <?php if( $agama=='hindu'){echo "selected"; } ?> value='hindu'>hindu</option>
				<option <?php if( $agama=='khongucu'){echo "selected"; } ?> value='khongucu'>Khongucu</option>
				</select></td></tr>
		
		<tr><td>Telp Rumah </td>
			<td><input readonly="readonly" name="telp" value="<?php echo $telp_rumah ?>" type="text" /></td>
		</tr>
		
		<tr><td>No HP </td>
			<td><input name="hp"   value="<?php echo $no_hp ?>" type="text" readonly="readonly"></td>
		</tr>
		
		<tr><td>Nama Ibu Kandung </td>
			<td><input name="ibu"  value="<?php echo $nama_ibu ?>" type="text" readonly="readonly"></td>
		</tr>
		
		<tr><td>Alamat Rumah Tinggal KTP </td>
			<td><textarea name="alamat_ktp" type="text" readonly="readonly"><?php echo $alamat_ktp ?></textarea></td>
		</tr>
		
		<tr><td>Kota </td>
			<td><input name="kota_ktp" value="<?php echo $kota_ktp ?>" type="text" readonly="readonly"></td>
		</tr>
		
		<tr><td>Kode Pos </td>
			<td><input name="kodepos_ktp" value="<?php echo $kodepos_ktp ?>" type="text" readonly="readonly"></td>
		</tr>
		
		<tr><td>Lama Tinggal </td>
			<td><input name="tinggal_ktp"  value="<?php echo $tinggal_ktp ?>" style="width:8%;" type="text" readonly="readonly">Tahun</td>
		</tr>
		
		<tr><td>E-mail </td>
			<td><input name="email"  value="<?php echo $email ?>" type="text" readonly="readonly"></td>
		</tr>
		
		<tr><td>Kendaraan </td>
			<td readonly="readonly" >
			<input name="kendaraan" type="radio" value="mobil" <? if($kendaraan=='mobil'){echo 'checked';}?>/>mobil 
			<input name="kendaraan" type="radio" value="motor" <? if($kendaraan=='motor'){echo 'checked';}?>/>motor
			<input name="kendaraan" type="radio" value="kendaraan umun" <? if($kendaraan=='kendaraan umum'){echo 'checked';}?>/>kendaraan umum
			</td></tr>

  </table>
 
<div align="center" style="border:1px solid;background-color:#00BFFF"><strong>EMERGENCY CONTACT</strong></div><br>
<h3>*KELUARGA TIDAK SERUMAH</h3>

<table align= "left">		
		<tr><td>Nama</td>
			<td><input name="nama2"  value="<?php echo $nama2 ?>" type="text"  readonly="readonly"></td>
		</tr>
		<tr><td>Alamat</td>
			<td><textarea name="alamat_emergency" type="text"  readonly="readonly"><?php echo $alamat_emergency ?></textarea></td>
		</tr>
</table>
	<table>
		<tr>
		<td>Hubungan</td>
			<td><input name="hubungan" value="<?php echo $hubungan ?>" type="text"  readonly="readonly"></td>
		</tr>
		<tr>
			<td>Telp Rumah</td>
			<td><input name="telp2" value="<?php echo $telp ?>" type="text" readonly="readonly"></td>
		</tr>
		<tr>
			<td>No HP</td>
			<td><input name="hp2" value="<?php echo $hp ?>" type="text" readonly="readonly"></td>
		</tr>	
	</table>

<div align="center" style="border:1px solid;background-color:#00BFFF"><strong>PENDIDIKAN FORMAL</strong></div><br>
<h5> *Pendidikan Terakhir</h5>
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
        <td><input name="jenjang_pendidikan" style="width:125px;" type="text" value="<?php echo $jp ?>" readonly="readonly"/></td>
        <td><input name="nama_sekolah" style="width:200px;" type="text" value="<?php echo $ns ?>" readonly="readonly"/></td>
		<td><input name="kota_sekolah" style="width:100px;" type="text" value="<?php echo $ks ?>" readonly="readonly"/></td>
        <td><input name="program_study" style="width:100px;" type="text" value="<?php echo $ps ?>" readonly="readonly"/></td>
		<td><input name="ipk" style="width:100px;" type="text" value="<?php echo $ipk ?>" readonly="readonly"/></td>
		<td><input name="tahun_ijazah" style="width:100px;" type="text" value="<?php echo $ti ?>" readonly="readonly"/></td>
        
    </tr>
	<tr>
        <td><input name="jenjang_pendidikan1" style="width:125px;" type="text" value="<?php echo $jp1 ?>" readonly="readonly"/></td>
        <td><input name="nama_sekolah1" style="width:200px;" type="text"value="<?php echo $ns1 ?>" readonly="readonly"/></td>
		<td><input name="kota_sekolah1" style="width:100px;" type="text"value="<?php echo $ks1 ?>" readonly="readonly"/></td>
        <td><input name="program_study1" style="width:100px;" type="text" value="<?php echo $ps1 ?>" readonly="readonly"/></td>
		<td><input name="ipk1" style="width:100px;" type="text" value="<?php echo $ipk1 ?>" readonly="readonly"/></td>
		<td><input name="tahun_ijazah1" style="width:100px;" type="text" value="<?php echo $ti1 ?>" readonly="readonly"/></td>
        
    </tr>
	<tr>
        <td><input name="jenjang_pendidikan2" style="width:125px;" type="text" value="<?php echo $jp2 ?>" readonly="readonly" /></td>
        <td><input name="nama_sekolah2" style="width:200px;" type="text" value="<?php echo $ns2 ?>" readonly="readonly"/></td>
		<td><input name="kota_sekolah2" style="width:100px;" type="text" value="<?php echo $ks2 ?>" readonly="readonly"/></td>
        <td><input name="program_study2" style="width:100px;" type="text" value="<?php echo $ps2 ?>" readonly="readonly"/></td>
		<td><input name="ipk2" style="width:100px;" type="text" value="<?php echo $ipk2 ?>" readonly="readonly"/></td>
		<td><input name="tahun_ijazah2" style="width:100px;" type="text" value="<?php echo $ti2 ?>" readonly="readonly"/></td>
        
    </tr>
</table><br>

<div align="center" style="border:1px solid;background-color:#00BFFF"><strong>PENGALAMAN BEKERJA</strong></div><br>
<table border="1">
	<tr align ="center">
        <td>PERUSAHAAN</td>
		<td>POSISI/JABATAN</td>
		<td>TANGGAL MASUK</td>
		<td>TANGGAL RESIGN</td>
		<td>KETERANGAN</td>
    </tr>
	<tr>
        <td><input name="perusahaan" style="width:180px;" type="text" value="<?php echo $perusahaan ?>" readonly="readonly"></td>
		<td><input name="jabatan" style="width:120px;" type="text" value="<?php echo $jabatan ?>" readonly="readonly"></td>
		<td><input name="tgl_masuk" style="width:120px;" type="date" value="<?php echo $masuk ?>" readonly="readonly"></td>
		<td><input name="tgl_resign" style="width:120px;" type="date" value="<?php echo $resign ?>" readonly="readonly"></td>
        <td><input name="alasan" style="width:200px;" type="text" value="<?php echo $alasan ?>" readonly="readonly"></td>
	</tr>
	<tr>
        <td><input name="perusahaan1" style="width:180px;" type="text" value="<?php echo $perusahaan1 ?>" readonly="readonly"></td>
		<td><input name="jabatan1" style="width:120px;" type="text" value="<?php echo $jabatan1 ?>" readonly="readonly"></td>
		<td><input name="tgl_masuk1" style="width:120px;" type="date" value="<?php echo $masuk1 ?>" readonly="readonly"></td>
		<td><input name="tgl_resign1" style="width:120px;" type="date" value="<?php echo $resign1 ?>" readonly="readonly"></td>
        <td><input name="alasan1" style="width:200px;" type="text" value="<?php echo $alasan1 ?>" readonly="readonly"></td>
	</tr>
	<tr>
        <td><input name="perusahaan2" style="width:180px;" type="text" value="<?php echo $perusahaan2 ?>" readonly="readonly"></td>
		<td><input name="jabatan2" style="width:120px;" type="text" value="<?php echo $jabatan2 ?>" readonly="readonly"></td>
		<td><input name="tgl_masuk2" style="width:120px;" type="date" value="<?php echo $masuk2 ?>"readonly="readonly"></td>
		<td><input name="tgl_resign2" style="width:120px;" type="date" value="<?php echo $resign2 ?>" readonly="readonly"></td>
        <td><input name="alasan2" style="width:200px;" type="text" value="<?php echo $alasan2 ?>" readonly="readonly"></td>
	</tr>
	
</table><br>

<table>
	<tr><td>apakah saat ini sedang bekerja di tempat/perusahaan lain??</td>
		<td><input name="sedang_bekerja" type="radio" <? if($sb=='1'){echo 'checked';}?> value='1' readonly="readonly"/>ya 
		<input name="sedang_bekerja" type="radio" <? if($sb=='2'){echo 'checked';}?>  value='2' readonly="readonly"/>Tidak
		</td></tr>
</table><br>


<div align="center" style="border:1px solid;background-color:#00BFFF"><strong>Dokument Pendukung</strong></div><br>
<table>
		<tr><td><a href="uploads/photo/<?php echo $upload; ?>" id="uploadPreview" class="btn" style="width: 50px; height:50px;border:1px solid;" download><img src="uploads/photo/<?php echo $upload;?>" ></a><br>
		<?php echo $upload;?>
		</td>
		<td><a href="uploads/photo/<?php echo $komitmen; ?>" id="uploadPreview" class="btn" style="width: 50px; height:50px;border:1px solid;" download><img src="uploads/photo/<?php echo $komitmen;?>" ></a><br>
		<?php echo $komitmen;?>
		</td><tr>
</table><br>
		<?php
		$date=date('Y-m-d');
		?>
		<tr>
		<td><input type="hidden" name="tanggal" value="<?php echo $date ?>">
		</td></tr>
		<tr><td>
<table border="1" align="center">
	<tr align ="center">
        <th colspan=4" style="background:#00BFFF">HISTORY</th>
		</tr>
		<tr align ="center">
		<td style="width:170px;">KETERANGAN</td>
		<td style="width:170px;">ALASAN</td>
		<td style="width:170px;">TANGGAL</td>
		<td style="width:170px;">NAMA APPROVAL</td>
    </tr>
<?php
		
		$query_mssql = mssql_query("SELECT * FROM history_sales
									where id='$kd_npp' 
									ORDER BY tanggal ASC " );
		while($data = mssql_fetch_array($query_mssql)){
			
			if($data['ket']==1) {
                $ket = "penginputan";
            }
			elseif($data['ket']==2) {
                $ket = "approve penyelia";
            }
			elseif($data['ket']==3) {
                $ket = "approve sco";
            }
			elseif($data['ket']==4) {
                $ket = "cancel";
            }
			elseif($data['ket']==5) {
                $ket = "approve";
            }


?>
<?php
		$format=date('d-m-Y',strtotime($data['tanggal']));
?>
		
		<tr>
			<td><?php echo $ket; ?></td>
			<td><?php echo $data['keterangan']; ?></td>
			<td><center><?php echo $format; ?></center></td>
			<td><center><?php echo $data['npp']; ?></center></td>
		</tr>
		<?php } ?>
		</table>
<p></p>		
	<table align = "center">
		<tr >
		<td><select name="ket">
		<option <?php if( $ket=='2'){echo "selected"; } ?> value='2'>Approve</option>
		<option <?php if( $ket=='4'){echo "selected"; } ?> value='4'>cancel</option>
		
		</td>
		<tr>
		<td>
		<textarea id="keterangan" name="keterangan"  class="required" required></textarea>
		</td>
		</tr>
	</table>
		<tr>
			<td>
			<center><input type="submit" class="btn btn-primary" name="simpan" value="SIMPAN">
			<a href="index.php?page=10k" class="btn btn-danger" >kembali</a></center>
			</td>
		</tr>
		
</form>	
    <script type="text/javascript">
				function PreviewImage() {
				var oFReader = new FileReader();
				oFReader.readAsDataURL(document.getElementById("uploadImage").files[0]);

				oFReader.onload = function (oFREvent) {
				document.getElementById("uploadPreview").src = oFREvent.target.result;
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
	<link rel="stylesheet" href="themes/base/jquery.ui.all.css">
	<script src="js/jquery-1.7.2.js"></script>
	<script src="ui/jquery.ui.core.js"></script>
	<script src="ui/jquery.ui.widget.js"></script>
	<script src="ui/jquery.ui.datepicker.js"></script>
	<script>
	
	</script>
		
</html>

