<?php
session_start();
include('include/config.php');
$kd_npp = $_POST['id'];
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
else
{
	$ceklevel="and c.id_cabang =".$cbg."";
}
/*-------combo user group------*/
$pilihan = '';
$result = mssql_query("SELECT * FROM app_user_grup ".$cektipe." order by is_sales desc");
while($row = mssql_fetch_array($result))
{
  $pilihan .= "<option value='".$row['id_grup']."'>".$row['nama_grup']."</option>";
}
//-------------------------------------------NPP MUNCUL------

$sql="select max(npp) npp from sales where len(npp) = 5 and id_grup in (8,9,11)"; /* selain sales harus lebih dari 5 digit */
$datax=mssql_fetch_array(mssql_query($sql));
?> 
<?php
/*-------------------combo wilayah-----------------------------------------*/
$query = mssql_query ("SELECT id_area, nama_area FROM area ORDER BY nama_area");
$arrpropinsi = array();
while ($row = mssql_fetch_array($query)) {
	$arrpropinsi [ $row['id_area'] ] = $row['nama_area'];
}

if(isset($_GET['action']) && $_GET['action'] == "getKab") {
	$kode_prop = $_GET['kode_prop'];
	
/*-------------------combo cabang------------------------------------------*/
	$query = mssql_query ("SELECT kode_cabang kode, nama_cabang nama FROM cabang WHERE id_area='$kode_prop' and tipe_cabang in ('KCU') ORDER BY nama_cabang");

	$arrkab = array();
	while ($row = mssql_fetch_array($query)) {
		array_push($arrkab, $row);
	}
	echo json_encode($arrkab);
	exit;
}

// query untuk menampilkan mahasiswa berdasarkan kd_npp
$data = mssql_fetch_array(mssql_query("SELECT * FROM sales a join app_user_grup b on a.id_grup = b.id_grup join cabang c on a.id_cabang=c.kode_cabang join area d on c.id_area=d.id_area WHERE kd_npp=".$kd_npp));
// jika kd_npp > 0 / form ubah data
if($kd_npp> 0) {
	$npp 				= $data['npp'];
	$id_grup 			= $data['id_grup'];
	$id_cabang 			= $data['kode_cabang'];
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
	$status_tinggal 	= $data['tinggal'];
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
} else {
	$npp 				= "";
	$id_grup 			= "";
	$id_cabang 			= "";
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
	
}	
?>
<form action="file_upload/upload.php" method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload Image" name="submit">
</form>
	<!--
 <form id="form-data1" action="proses.registrasi.php" method="post" enctype="multipart/form-data" >  

<div align="center" style="border:1px solid;background-color:#96c052"><strong><p>REGISTRASI FORM LENDING - SGV</strong></p></div>
</tr><p></p>
		<tr><td>Posisi</td>
		<td><select name="id_grup" id="id_grup"  class="required" required >
			<option value="<?php echo $id_grup ?>"><?php echo $nama_grup ?></option>
			<?php echo $pilihan;?>
			</select></td></tr>
	
		<tr>
		<td>Wilayah</td>
		<td><select id="propinsi" name="propinsi" class="required" required >
			<option value="<?php echo $id_area ?>"><?php echo $nama_area ?></option>
			<?php
			foreach ($arrpropinsi as $kode=>$nama) {
				echo "<option value='$kode'>$nama</option>";
			}
			?>
			</select> </td></tr>
		<tr>
		<td>Cabang</td>
		<td><select id="id_cabang" name="id_cabang" class="required" required  >
			<option value="<?php echo $id_cabang ?>"><?php echo $nama_cabang ?></option>
		</select></td></tr>
	<table align = "center">
		<tr>
		<td >Npp</td>
		<td>
			<?php
				if($kd_npp>0)
				{
			?>
			<input type="text" class="input-medium" name="kd_npp" value="<?php echo $kd_npp ?>" readonly="readonly"/>
			<?php
				}
				else
				{
			?>
			<input type="text" id="npp" class="input-medium" name="npp" value="<?php echo $npp ?>"/>
			<?php
				}
			?>
		</td>
	</tr>
	
	
</table>
-->

<!--
<div align="center" style="border:1px solid;background-color:#96c052"><strong>PERSONAL DATA</strong></div>
<p></p>
<div class="control-group" align = "center" >
		<img src="images/orang-1.PNG" id="uploadPreview" style="width: 150px; height:160px;border:1px solid;" /></br>
				<input id="uploadImage" type="file" name="photo"  onchange="PreviewImage();" align="center" />
		</div>

<table align ="left">
		<tr><td>Nama Lengkap </td>
			<td><input name="nama_lengkap" title="Nama Lengkap harus diisi" size="40" type="text" class="required" required/> </td>
		</tr>

		<tr><td>Nama Panggil </td>
			<td><input name="nama_panggil"  title="Nama Panggil harus diisi" size="40" type="text" class="required" required />			</td>
		</tr>
		
		<tr><td>No KTP </td>
			<td><input name="no_ktp"  title="No KTP harus diisi" size="40" type="text"  class="required" required/>			</td>
		</tr>
		
		<tr><td>Tempat Lahir </td>
			<td><input name="tempat_lahir"  title="Tempat Lahir harus diisi" size="40" type="text" class="required" required/>			</td>
		</tr>
		
		<tr><td>Tanggal Lahir </td>
			<td><input name="tanggal_lahir"  id="tanggal_lahir" title="Tanggal Lahir harus diisi" size="40" type="date" class="required" required />			</td>
		</tr>
		
		<tr><td>Alamat Rumah Tinggal Saat Ini </td>
			<td><input name="alamat"  title="alamat rumah tinggal harus diisi" size="40" type="text" class="required" required />			</td>
		</tr>
		
		<tr><td>Kota</td>
			<td><input name="kota"  title="kota harus diisi" size="40" type="text" class="required" required  />			</td>
		</tr>
		
		<tr>
			<td>Kode Pos </td>
			<td><input name="kodepos" title="Kodepos harus diisi" size="40" type="text" class="required" required />			</td>
			
		</tr>
		
		<tr>
			<td>Lama Tinggal </td>
			<td><input style="width:8%;"name="lama"title="Lama Tinggal harus diisi" size="40" type="text" class="required" required />Tahun			</td>
		</tr>
		
		<tr><td>Status Tempat Tinggal* </td>
			<td>
			<input type="radio" name="status_tinggal" value="Orang Tua">Orang Tua
            <input type="radio" name="status_tinggal" value="Sendiri">Sendiri
			<input type="radio" name="status_tinggal" value="Sewa">Sewa
			 </td></tr>
</table>

	<table align="center">
		<tr><td>Status</td>
		<td><select name="status" class="required" required>
		<option value>Pilih status</option>
		<option value="lajang">lajang</option>
		<option value="menikah">menikah </option>
		<option value="bercerai">bercerai </option>
		</select></td></tr>
		
		<tr>
		<td>Agama</td>
		<td><select name="agama" class="required" required>
		<option value>Pilih agama</option>
		<option value="islam">islam</option>
		<option value="kristen">kristen</option>
		<option value="budha">budha </option>
		<option value="hindu">hindu </option>
		<option value="khongucu">khongucu </option>
		</select></td></tr>
		
		<tr>
		<td>Telp Rumah </td>
		<td><input name="telp"  title="Telp Rumah harus diisi"  type="text" />			</td>
		</tr>
		
		<tr>
		<td>No HP </td>
		<td><input name="hp"  title="No HP harus diisi" type="text" class="required" required />			</td>
		</tr>
		
		<tr>
		<td>Nama Ibu Kandung </td>
		<td><input name="ibu" title="Nama Ibu Kandung harus diisi" size="40" type="text" class="required" required />			</td>
		</tr>
		
		<tr>
		<td>Alamat Rumah Tinggal KTP </td>
		<td><input name="alamat_ktp"  title="Alamat Rumah Tinggal KTP harus diisi" size="40" type="text" class="required" required />			</td>
		</tr>
		<tr>
		<td>Kota </td>
		<td><input name="kota_ktp" title="kota harus diisi" size="40" type="text" class="required" required />			</td>
		</tr>
		
		<tr>
		<td>Kode Pos </td>
		<td><input name="kodepos_ktp"  title="Kodepos harus diisi" size="40" type="text" class="required" required/>			</td>
		</tr>
		
		<tr>
		<td>Lama Tinggal </td>
		<td><input name="tinggal_ktp"  style="width:8%;" title="Lama Tinggal KTP harus diisi" size="40" type="text" class="required" required/> Tahun			</td>
		</tr>
		
		<tr>
		<td>E-mail </td>
		<td><input name="email"title="E-mail harus diisi" size="40" type="text" class="required" required />			</td>
		</tr>
		
		<tr>
		<td>Kendaraan </td>
		<td><input class="required" required type="radio" name="kendaraan" value="Mobil">Mobil
            <input  class="required" required type="radio" name="kendaraan" value="Motor">Motor
			<input  class="required" required type="radio" name="kendaraan" value="Kendaraan Umum">Kendaraan Umum
			</td></tr>
  </table>
 
<div align="center" style="border:1px solid;background-color:#96c052"><strong>EMERGENCY CONTACT</strong></div>


<table align= "left">		
		<tr><td>Nama</td>
			<td><input name="nama2" title="Nama harus diisi" size="40" type="text"  class="required" required/></td>
		</tr>
		<tr><td>Alamat</td>
			<td><input name="alamat_emergency"  title="Alamat harus diisi" size="40" type="text"  class="required" required/>			</td>
		</tr>
		<tr>
</table>
	<table>
		<td>Hubungan</td>
			<td><input name="hubungan"  title="hubungan harus diisi" size="40" type="text"  class="required" required/>			</td>
		</tr>
		<tr>
			<td>Telp Rumah</td>
			<td><input name="telp2" title="Telp Rumah harus diisi" size="40" type="text"  />			</td>
		</tr>
		<tr>
			<td>No HP</td>
			<td><input name="hp2" title="Nomor HP harus diisi" size="40" type="text" class="required" required />			</td>
		</tr>
	</table>
		<tr>
			<td >
				<input type="submit" class="btn btn-primary" name="kirim" value="SIMPAN">
				<input type="reset" class="btn btn-inverse" value="Reset">
			</td>
		</tr>
		
</form>

-->		
<script src="jquery-1.8.3.min.js"></script>
<script src="sales-js/bootstrap.min.js"></script>
<!--<script src="aplikasi.createsales.js"></script>-->
<script src="aplikasi.createsaless.js"></script>
	
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
	<script type="text/javascript">
		$(document).ready(function(){
			$('#id_grup').change(function(){
				 if(this.value == 9 || this.value == 8 || this.value == 7 || this.value == 11)
				 {
					<?php if($npp > 0)
					{?>
					  $('#npp').val('<?php echo $npp ?>');
					<?php } else { ?>
<?php
$npp_new = $datax['npp'] + 1;	
?>					
				
					 $('#npp').val('<?php echo $npp_new ?>');
					<?php } ?>
					 $('#npp').attr('readonly', true);
				 }else
				 {
						$('#npp').attr('readonly', false);
					  $('#npp').val('');
				 }
			});
		});	
	</script>
	<script type="text/javascript">
		$(document).ready(function(){
				$( "#tanggal_lahir" ).datepicker({
			changeYear: true
			changeMonth: true,
			dateFormat: 'yyyy-mm-dd',
		});
			
			$('#ceksales').change(function(){
				
				//{
				$('#npp').val('<?php echo $datax['npp'] + 1?>');
				//}
			});
		});	
	</script>
	<link rel="stylesheet" href="themes/base/jquery.ui.all.css">
	<script src="js/jquery-1.7.2.js"></script>
	<script src="ui/jquery.ui.core.js"></script>
	<script src="ui/jquery.ui.widget.js"></script>
	<script src="ui/jquery.ui.datepicker.js"></script>
	<script>
/*
	jQuery.noConflict();
	jQuery(function() {
		jQuery( "#tanggal_lahir" ).datepicker({
			dateFormat: 'yy/mm/dd',
			changeMonth: true,
			changeYear: true
			console.log("tessss");
		});
*/	
	
	</script>
		
</html>

