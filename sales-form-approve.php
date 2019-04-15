<?php
// panggil file koneksi.php
//require 'koneksi.php';

// buat koneksi ke database mssql
include('include/config.php');

// tangkap variabel kd_npp

$kd_npp = $_POST['id'];

/*-------combo user group------*/
$pilihan = '';
$result = mssql_query("SELECT * FROM app_user_grup order by id_grup desc");
while($row = mssql_fetch_array($result))
{
  $pilihan .= "<option value='".$row['id_grup']."'>".$row['nama_grup']."</option>";
}
//-------------------------------------------

$sql="select max(npp) npp from temp_sales where len(npp) = 5 and id_grup in (8,9)"; /* selain sales harus lebih dari 5 digit */
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
	
	//ambil data kabupaten
	$query = mssql_query ("SELECT kode_cabang kode, nama_cabang nama FROM cabang WHERE id_area='$kode_prop' and tipe_cabang in ('KCU','KNW') ORDER BY nama_cabang");

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
	$npp = $data['npp'];
	$nama_grup = $data['nama_grup'];
	$nama_area = $data['nama_area'];
	$nama_cabang = $data['nama_cabang'];
	$id_grup = $data['id_grup'];
	$id_cabang = $data['kode_cabang'];
	$nama_sales = $data['nama'];
	$tanggal_lahir = $data['tanggal_lahir'];
	$alamat = $data['alamat'];

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
	$telepon = $data['telepon'];
	$keterangan = $data['keterangan'];
	$tanggal_aktif = $data['tanggal_aktif'];
	$tanggal_resign = $data['tanggal_resign'];
	$tanggal_buat = $data['tanggal_buat'];
	$pass = $data['pass'];
		
//-----------------combobox-status sales-----------------------//
	$kd_status_sales = $data['status_sales'];
	if($data['status_sales']==1) {
		$status_sales = "AKTIF";
	} 
	elseif($data['status_sales']==2) {
		$status_sales = "RESIGN";
	}
	elseif($data['status_sales']==3) {
		$status_sales = "CANCEL";
	}

	
//form tambah data
} else {
	$npp ="";
	$id_grup ="";
	$nama_grup = "";
	$id_cabang ="";
	$nama_sales ="";
	$tanggal_lahir ="";
	$alamat ="";
	$status ="";
	$id_vendor = "";
	$id_user_atasan = "";
	$id_user_leader = "";
	$grade = "";
	$telepon = "";
	$keterangan = "";
	$tanggal_aktif = "";
	$tanggal_resign = "";
	$tanggal_buat = "";
	$pass = "";
	$status_sales = "";
	//$sales_type = "";
	
}

?>
<form class="form-horizontal" id="form-mahasiswa">
	
		<div class="control-group">
		<label class="control-label" for="id_grup">Type</label>
		<div class="controls">
		<select name="id_grup" id="id_grup">
			<option value="<?php echo $id_grup ?>"><?php echo $nama_grup ?></option>
			<?php echo $pilihan;?>
			</select> *
		</div>
	</div>
	
	<div class="control-group">
		<label class="control-label" for="npp">NPP</label>
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
		<select id="id_cabang" name="id_cabang">
		<option value="<?php echo $id_cabang ?>"><?php echo $nama_cabang ?></option>
		</select> *
		</div>
		</div>

	<div class="control-group">
		<label class="control-label" for="nama_sales">Nama</label>
		<div class="controls">
			<input type="text" id="nama_sales" class="input-xlarge" name="nama_sales" value="<?php echo $nama_sales ?>"> *
		</div>
	</div>
	
	<div class="control-group">
		<label class="control-label" for="alamat">Alamat</label>
		<div class="controls">
			<textarea id="alamat" name="alamat"><?php echo $alamat ?></textarea>
		</div>
	</div>
	

	<div class="control-group">
		<label class="control-label" for="id_vendor">vendor</label>
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
				<option value="1">AKTIF</option>
				<option value="2">RESIGN</option>
				<option value="3">CANCEL</option>
				
			</select>
		</div>
	</div>
	
		<div class="control-group">
		<label class="control-label" for="id_user_atasan">atasan</label>
		<div class="controls">
			<input type="text" id="id_user_atasan" class="input-medium" name="id_user_atasan" value="<?php echo $id_user_atasan ?>"> * Pegawai BNI
		</div>
	</div>
		<div class="control-group">
		<label class="control-label" for="id_user_leader">leader</label>
		<div class="controls">
			<input type="text" id="id_user_leader" class="input-medium" name="id_user_leader" value="<?php echo $id_user_leader ?>"> * Pegawi Vendor
		</div>
	</div>
		<div class="control-group">
		<label class="control-label" for="grade">grade</label>
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
		<label class="control-label" for="telepon">phone</label>
		<div class="controls">
			<input type="text" id="telepon" class="input-medium" name="telepon" value="<?php echo $telepon ?>">
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="keterangan">keterangan</label>
		<div class="controls">
			<textarea id="keterangan" name="keterangan"><?php echo $keterangan ?></textarea>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="tanggal_aktif">tanggal aktif</label>
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
		<label class="control-label" for="tanggal_resign">tanggal resign</label>
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
		<label class="control-label" for="tanggal_buat">update</label>
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
					$.getJSON('mahasiswa.form-tempsales.php',{action:'getKab', kode_prop:$(this).val()}, function(json){
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
				 if(this.value == 9 || this.value == 8 || this.value == 7)
				 {
					 $('#npp').val('<?php echo $datax['npp'] + 1?>');
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
