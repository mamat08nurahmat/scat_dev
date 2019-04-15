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
elseif($level== 10)
{
	$cektipe='where id_grup in(8,9,11)';
}
else
{
	$ceklevel="and c.id_cabang =".$cbg."";
}
/*-------combo user group------*/
$pilihan = '';
$result = mssql_query("SELECT * FROM app_user_grup ".$cektipe." order by id_grup desc");
while($row = mssql_fetch_array($result))
{
  $pilihan .= "<option value='".$row['id_grup']."'>".$row['nama_grup']."</option>";
}
//-------------------------------------------

$sql="select max(npp) npp from temp_sales where len(npp) = 5 and id_grup in (8,9,11)"; /* selain sales harus lebih dari 5 digit */
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
$data = mssql_fetch_array(mssql_query("SELECT * FROM temp_sales a join app_user_grup b on a.id_grup = b.id_grup join cabang c on a.id_cabang=c.kode_cabang join area d on c.id_area=d.id_area WHERE kd_npp=".$kd_npp));
// jika kd_npp > 0 / form ubah data
if($kd_npp> 0) { 
	$npp 				= $data['npp'];
	$nama_grup 			= $data['nama_grup'];
	$nama_area 			= $data['nama_area'];
	$nama_cabang 		= $data['nama_cabang'];
	$id_grup 			= $data['id_grup'];
	$id_cabang 			= $data['kode_cabang'];
	$nama_sales			= $data['nama'];
	$nama_panggilan 	= $data['nama_panggilan'];
	$ec_nama			= $data['ec_nama'];
	$tempat_lahir		= $data['tempat_lahir'];
	$path 				= $data['path'];
	$tanggal_lahir 		= $data['tanggal_lahir'];
	$alamat 			= $data['alamat_1'];
	$kota_1				= $data['kota_1'];
	$kode_pos_1			= $data['kode_pos_1'];
	$lama_tinggal_1		= $data['lama_tinggal_1'];
	$status_tinggal		= $data['status_tinggal'];
	$agama				= $data['agama'];
	$telp_rumah			= $data['telp_rumah'];
	$ibu				= $data['ibu'];
	$telp_user_atasan 	= $data['telp_user_atasan'];
	$emailku 			= $data['email'];
	$kendaraan 			= $data['kendaraan'];
	$no_ktp 			= $data['no_ktp'];

//-----------------combobox-vendor-----------------------//
	$kd_id_vendor = $data['id_vendor'];
	if($data['id_vendor']==1) {
		$id_vendor = "PPU";
	} 
	elseif($data['id_vendor']==2) {
		$id_vendor = "AOS";
	}
	elseif($data['id_vendor']==3) {
		$id_vendor = "PERMATA";
	}

	$id_user_atasan = $data['id_user_atasan'];
	$id_user_leader = $data['id_user_leader'];
	
//-----------------combobox-----------------------//	
	$kd_grade = $data['grade'];
	if($data['grade']==4){
		$grade = "Trainee";
	}
	elseif($data['grade']==5){
		$grade = "Junior";
	}
	elseif($data['grade']==6){
		$grade = "Senior";
	}
//-----------------jenis-----------------------//	
	$kd_jenis			= $_data['jenis'];
	if($data['jenis']==1){
		$jenis = "laki-laki";
	}
	elseif($data['jenis']==2){
		$jenis = "perempuan";
	}
	
	$telepon 		= $data['telepon'];
	$keterangan 	= $data['keterangan'];
	$tanggal_aktif 	= $data['tanggal_aktif'];
	$tanggal_resign = $data['tanggal_resign'];
	$tanggal_buat 	= $data['tanggal_buat'];
	$pass 			= $data['pass'];
		
//-----------------combobox-status sales-----------------------//
	$kd_status_sales = $data['status_sales'];
	if($data['status_sales']==1) {
		$status_sales = "Aktif";
	} 
	elseif($data['status_sales']==2) {
		$status_sales = "Resign";
	}
	elseif($data['status_sales']==3) {
		$status_sales = "Cancel";
	}

	
//form tambah data
} else {
	$npp 			="";
	$id_grup 		="";
	$nama_grup 		="";
	$id_cabang 		="";
	$nama_sales 	="";
	$nama_panggilan ="";
	$ec_nama		="";
	$jenis			="";
	$tempat_lahir	="";
	$path 			="";
	$tanggal_lahir 	="";
	$alamat 		="";
	$kota_1			="";
	$kode_pos_1		="";
	$lama_tinggal_1	="";
	$status_tinggal	="";
	$agama			="";
	$telp_rumah		="";
	$ibu			="";
	$telp_user_atasan 	="";
	$emailku 			="";
	$kendaraan 		="";
	$no_ktp 		="";
	$status 		="";
	$id_vendor 		="";
	$id_user_atasan ="";
	$id_user_leader ="";
	$grade 			="";
	$telepon 		="";
	$keterangan 	="";
	$tanggal_aktif 	="";
	$tanggal_resign ="";
	$tanggal_buat 	="";
	$pass 			="";
	$status_sales 	="";
	//$sales_type = "";
	
}

?>
<script type="text/javascript">
				function PreviewImage() {
				var oFReader = new FileReader();
				oFReader.readAsDataURL(document.getElementById("uploadImage").files[0]);

				oFReader.onload = function (oFREvent) {
				document.getElementById("uploadPreview").src = oFREvent.target.result;
				};
				};
				</script>
<style type="text/css">
.tengah{
 position:absolute;
 margin-left:auto;
 margin-right:auto;
 margin-top:auto;
 margin-bottom:auto;
 left:0;
 right:0;
 top:0;
 bottom:50;
 background-color:#20B2AA;
 }
 .tengah_2{
 position:absolute;
 margin-left:auto;
 margin-right:auto;
 margin-top:auto;
 margin-bottom:auto;
 left:0;
 right:0;
 top:95;
 bottom:50;
 background-color:#FFE4C4;
 }
</style>

<div class="tengah">
<p><center><h3>REGISTRATION LENDING</h3></center></p>
</div></br>
<div>
<p>&nbsp;</p>
</div>
<form class="form-horizontal" id="form-mahasiswa">
	
		<div class="control-group">
		<label class="control-label" for="id_grup">Posisi</label>
		<div class="controls">
		<select name="id_grup" id="id_grup">
			<option value="<?php echo $id_grup ?>"><?php echo $nama_grup ?></option>
			<?php echo $pilihan;?>
			</select> *
		</div>
	</div>
	
	<div class="control-group">
		<label class="control-label" for="propinsi">Wilayah</label>
		<div class="controls">
		<select id="propinsi" name="propinsi">
			<option value="<?php echo $id_area ?>"><?php echo $nama_area ?></option>
			<?php
			foreach ($arrpropinsi as $kode=>$nama) {
				echo "<option value='$kode'>$nama</option>";
			}
			?>
		</select> *
		</div>
	</div>
	
	<div class="control-group">
		<label class="control-label" for="id_cabang">Cabang</label>
		<div class="controls">
		<select id="id_cabang" name="id_cabang" disabled="true">
		<option value="<?php echo $id_cabang ?>"><?php echo $nama_cabang ?></option>
		</select> *
		</div>
	</div>
	
	<div class="control-group">
		<label class="control-label" for="npp">Npp</label>
		<div class="controls">
			<?php
				if($kd_npp>0)
				{
			?>
			<input type="text" id="npp" class="input-medium" name="npp" value="<?php echo $npp ?>" readonly="readonly"/>
			<?php
				}
				else
				{
			?>
			<input type="text" id="npp" class="input-medium" name="npp" value="<?php echo $npp ?>"/>
			<?php
				}
			?>
		</div>
	</div>	

<div class="tengah_2">
<p><center><h3>PERSONAL DATA</h3></center></p>
</div></br>
<div>
<p>&nbsp;</p>
</div>

	<div class="control-group">
		<label class="control-label" for="nama_sales">Nama</label>
		<div class="controls">
			<input type="text" id="nama_sales" class="input-xlarge" name="nama_sales" value="<?php echo $nama_sales ?>"> * Wajib diisi nama sesuai KTP/SIM
		</div>
	</div>
	
	<div class="control-group">
		<label class="control-label" for="nama_panggilan">Nama Panggilan</label>
		<div class="controls">
			<input type="text" id="nama_panggilan" class="input-xlarge" name="nama_panggilan" value="<?php echo $nama_panggilan ?>"> * Wajib diisi
		</div>
	</div>
	
	<div class="control-group">
		<label class="control-label" for="ec_nama">Elektronik nama</label>
		<div class="controls">
			<input type="text" id="ec_nama" class="input-xlarge" name="ec_nama" value="<?php echo $ec_nama ?>"> * Wajib diisi
		</div>
	</div>
	
	<div class="control-group">
		<label class="control-label" for="jenis">Jenis kelamin</label>
		<div class="controls">
			<select class="input-medium" name="jenis">
				<?php 
				// tampilkan untuk form ubah mahasiswa
				if($kd_npp > 0) { ?>
					<option value="<?php echo $kd_jenis ?>"><?php echo $kd_jenis ?></option>
				<?php } ?>
				<option value="1">Laki-Laki</option>
				<option value="2">Perempuan</option>				
			</select>
		</div>
	</div>
	
	<div class="control-group">
		<label class="control-label" for="tempat_lahir">Tempat Lahir</label>
		<div class="controls">
			<input type="text" id="tempat_lahir" class="input-xlarge" name="tempat_lahir" value="<?php echo $tempat_lahir ?>"> * Wajib diisi
		</div>
	</div>
	
	<div class="control-group">
		<label class="control-label" for="kota_1">Kota</label>
		<div class="controls">
			<input type="text" id="kota_1" class="input-xlarge" name="kota_1" value="<?php echo $kota_1 ?>"> * Wajib diisi
		</div>
	</div>
	
	<div class="control-group">
		<label class="control-label" for="kode_pos_1">Kode pos</label>
		<div class="controls">
			<input type="text" id="kode_pos_1" class="input-xlarge" name="kode_pos_1" value="<?php echo $kode_pos_1 ?>"> * Wajib diisi
		</div>
	</div>
	
	<div class="control-group">
		<label class="control-label" for="lama_tinggal_1">Lama tinggal</label>
		<div class="controls">
			<input type="text" id="lama_tinggal_1" class="input-xlarge" name="lama_tinggal_1" value="<?php echo $lama_tinggal_1 ?>"> * Wajib diisi
		</div>
	</div>
	
	<div class="control-group">
		<label class="control-label" for="status_tinggal">status_tinggal</label>
		<div class="controls">
			<input type="text" id="status_tinggal" class="input-xlarge" name="status_tinggal" value="<?php echo $status_tinggal ?>"> * Wajib diisi
		</div>
	</div>
	
	<div class="control-group">
		<label class="control-label" for="agama">Agama</label>
		<div class="controls">
			<input type="text" id="agama" class="input-xlarge" name="agama" value="<?php echo $agama ?>"> * Wajib diisi
		</div>
	</div>
	
	<div class="control-group">
		<label class="control-label" for="telp_rumah">Telp rumah</label>
		<div class="controls">
			<input type="text" id="telp_rumah" class="input-xlarge" name="telp_rumah" value="<?php echo $telp_rumah ?>"> * Wajib diisi
		</div>
	</div>
	
	<div class="control-group">
		<label class="control-label" for="ibu">Ibu kandung</label>
		<div class="controls">
			<input type="text" id="ibu" class="input-xlarge" name="ibu" value="<?php echo $ibu ?>"> * Wajib diisi
		</div>
	</div>	

	<div class="control-group">
		<label class="control-label" for="telp_user_atasan">Telp Atasan</label>
		<div class="controls">
			<input type="text" id="telp_user_atasan" class="input-xlarge" name="telp_user_atasan" value="<?php echo $telp_user_atasan ?>"> * Wajib diisi
		</div>
	</div>		
	
	<div class="control-group">
		<label class="control-label" for="email">Email</label>
		<div class="controls">
			<input type="text" id="email" class="input-xlarge" name="email" value="<?php echo $emailku ?>"> * Wajib diisi
		</div>
	</div>
	

	<div class="control-group">
		<label class="control-label" for="kendaraan">Kendaraan</label>
		<div class="controls">
			<input type="text" id="kendaraan" class="input-xlarge" name="kendaraan" value="<?php echo $kendaraan ?>"> * Wajib diisi
		</div>
	</div>

	<div class="control-group">
		<label class="control-label" for="no_ktp">Nomer KTP</label>
		<div class="controls">
			<input type="text" id="no_ktp" class="input-xlarge" name="no_ktp" value="<?php echo $no_ktp ?>"> * Wajib diisi
		</div>
	</div>
	
		<div class="control-group">
		<label class="control-label" for="path">Foto</label>
		<div class="controls">
			<p>
				<img src="images/orang-1.PNG" id="uploadPreview" style="width: 150px; height:160px;border:1px solid;" /></br>
				<input id="uploadImage" type="file" name="path"  onchange="PreviewImage();" align="center" />
				<!--<input type="submit" width="110" height="24" color="000000" name="simpan" value="Simpan..." />-->
				</p>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="alamat_1">Alamat</label>
		<div class="controls">
			<textarea id="alamat_1" name="alamat_1"><?php echo $alamat ?></textarea> * Wajib diisi alamat lengkap
		</div>
	</div>
	
	<div class="control-group">
		<label class="control-label" for="id_vendor">Vendor</label>
		<div class="controls">
			<select class="input-medium" name="id_vendor">
				<?php 
				// tampilkan untuk form ubah mahasiswa
				if($kd_npp > 0) { ?>
					<option value="<?php echo $kd_id_vendor ?>"><?php echo $id_vendor ?></option>
				<?php } ?>
				<option value="1">PPU</option>
				<option value="2">AOS</option>
				<option value="3">PERMATA</option>
			</select> * Wajib diisi untuk user Sales dan Team Leader
		</div>
	</div>
	
	<div class="control-group">
		<label class="control-label" for="status_sales">Status</label>
		<div class="controls">
			<select class="input-medium" name="status_sales">
				<?php 
				// tampilkan untuk form ubah mahasiswa
				if($kd_npp > 0) { ?>
					<option value="<?php echo $kd_status_sales ?>"><?php echo $status_sales ?></option>
				<?php } ?>
				<option value="1">Aktif</option>
				<option value="2">Resign</option>
				<option value="3">Cancel</option>
				
			</select>
		</div>
	</div>
	
		<div class="control-group">
		<label class="control-label" for="id_user_atasan">Penyelia</label>
		<div class="controls">
			<input type="text" id="id_user_atasan" class="input-medium" name="id_user_atasan" value="<?php echo $id_user_atasan ?>"> * Wajib diisi NPP penyelia
		</div>
	</div>
		<div class="control-group">
		<label class="control-label" for="id_user_leader">Leader</label>
		<div class="controls">
			<input type="text" id="id_user_leader" class="input-medium" name="id_user_leader" value="<?php echo $id_user_leader ?>"> * Wajib diisi nama team leader
		</div>
	</div>
		<div class="control-group">
		<label class="control-label" for="grade">Grade</label>
		<div class="controls">
			<select class="input-medium" name="grade">
				<?php 
				// tampilkan untuk form ubah mahasiswa
				if($kd_npp > 0) { ?>
					<option value="<?php echo $kd_grade ?>"><?php echo $grade ?></option>
				<?php } ?>
				<option value="4">Trainee</option>
				<option value="5">Junior</option>
				<option value="6">Senior</option>
			</select> * Wajib diisi untuk user Sales
		</div>
	</div>
		
		<div class="control-group">
		<label class="control-label" for="telepon">Phone</label>
		<div class="controls">
			<input type="text" id="telepon" class="input-medium" name="telepon" value="<?php echo $telepon ?>"> *
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="keterangan">Keterangan</label>
		<div class="controls">
			<textarea id="keterangan" name="keterangan"><?php echo $keterangan ?></textarea>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="tanggal_aktif">Tanggal Aktif</label>
		<div class="controls">
			<?php
			if($kd_npp > 0)
			{?>
			<input type="text" id="tanggal_aktif" class="input-xlarge" name="tanggal_aktif" value="<?php echo $tanggal_aktif ?>" readonly="readonly"/>
			<?php
			}
			else
			{
				?>
					<input type="text" id="tanggal_aktif" class="input-xlarge" name="tanggal_aktif" value="<?php echo $tanggal_aktif ?>"> *
				<?php
			}
			?>
		</div>
	</div>
	<?php
	$date=date('Y/m/d');
	?>
	<div class="control-group">
		<label class="control-label" for="tanggal_resign">Tanggal Resign</label>
		<div class="controls">
			<?php
			if($kd_npp>0)
			{
			?>
			<input type="text" id="tanggal_resign" class="input-xlarge" name="tanggal_resign" value="<?php echo $tanggal_resign ?>">
			<?php
			}
			else
			{
				?>
				<input type="text" id="tanggal_resign" class="input-xlarge" name="tanggal_resign" value="<?php echo $tanggal_resign ?>" readonly="readonly"/>
				<?php
			}
			?>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="tanggal_buat">Update</label>
		<div class="controls">
			<input type="text" id="tanggal_buat" class="input-xlarge" name="tanggal_buat" value="<?php echo $date ?>">
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="pass"></label>
		<div class="controls">
			<input type="hidden" id="pass" class="input-xlarge" name="pass" value="bankbni">
		</div>
	</div>

</form>

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
					<?php if($kd_npp > 0)
					{?>
					  $('#npp').val('<?php echo $npp ?>');
					<?php } else { ?>
					 $('#npp').val('<?php echo $datax['npp'] + 1?>');
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
	jQuery.noConflict();
	jQuery(function() {
		jQuery( "#tanggal_lahir" ).datepicker({
			dateFormat: 'yy/mm/dd',
			changeMonth: true,
			changeYear: true
		});
		<?php
			if($kd_npp==0)
			{
		?>
		jQuery( "#tanggal_aktif" ).datepicker({
			dateFormat: 'yy/mm/dd',
			changeMonth: true,
			changeYear: true
		});
		<?php
			}
			?>
		
		<?php
			if($kd_npp>0)
			{
		?>
		jQuery( "#tanggal_resign" ).datepicker({
			dateFormat: 'yy/mm/dd',
			changeMonth: true,
			changeYear: true
		});
		<?php
			}
			?>
	});

	</script>
