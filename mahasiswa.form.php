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
	$cektipe='where id_grup in (1,2,3,4,5,6,7,10,12,13,14,15)';
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

$sql="select max(npp) npp from sales where len(npp) = 5 and id_grup in (8,9,11,12)"; /* selain sales harus lebih dari 5 digit */
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
	
	//ambil data sales
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
	$npp 			= $data['npp'];
	$nama_grup 		= $data['nama_grup'];
	$nama_area 		= $data['nama_area'];
	$nama_cabang 	= $data['nama_cabang'];
	$id_grup 		= $data['id_grup'];
	$id_cabang 		= $data['kode_cabang'];
	$nama_sales 	= $data['nama'];
	$no_ktp 		= $data['no_ktp'];
	$tanggal_lahir	= $data['tanggal_lahir'];
	$alamat			= $data['alamat'];

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
	elseif($data['id_vendor']==4) {
		$id_vendor = "PERDANA PERKASA ELASTINDO";
	}

	$id_user_atasan = $data['id_user_atasan'];
	$id_user_leader = $data['id_user_leader'];
	
//-----------------combobox-----------------------//	
$kd_grade = $data['grade'];
	if($data['grade']==3){
		$grade = "Trainee";
	}
	elseif($data['grade']==4){
		$grade = "Level 1";
	}
	elseif($data['grade']==5){
		$grade = "Level 2";
	}
	elseif($data['grade']==6){
		$grade = "Level 3";
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
		elseif($data['status_sales']==4) {
		$status_sales = "CUTI";
	}

//-----------------combobox Perusahaan-----------------------//
	$kd_perusahaan = $data['id_perusahaan'];
	if($data['id_perusahaan']==1) {
		$perusahaan = "PT A";
	} 
	elseif($data['id_perusahaan']==2) {
		$perusahaan = "PT B";
	}
	elseif($data['id_perusahaan']==3) {
		$perusahaan = "PT C";
	}
	elseif($data['id_perusahaan']==4) {
		$perusahaans = "PT D";
	}
	elseif($data['id_perusahaan']==5) {
		$perusahaan = "PT E";
	}
	elseif($data['id_perusahaan']==6) {
		$perusahaan = "PT F";
	}
	
//form tambah data
} else {
	$npp 			="";
	$id_grup 		="";
	$nama_grup 		="";
	$id_cabang 		="";
	$nama_sales		="";
	$no_ktp 		="";
	$tanggal_lahir	="";
	$alamat 		="";
	$status 		="";
	$id_vendor 		= "";
	$id_user_atasan = "";
	$id_user_leader = "";
	$grade 			= "";
	$telepon		= "";
	$keterangan		= "";
	$tanggal_aktif 	= "";
	$tanggal_resign = "";
	$tanggal_buat 	= "";
	$pass 			= "";
	$status_sales 	= "";
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
		<label class="control-label" for="no_ktp">No KTP</label>
		<div class="controls">
			<input type="text" id="no_ktp" class="input-xlarge" name="no_ktp" value="<?php echo $no_ktp ?>"> *
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
				<option value=""></option>
				<option value="1">PPU</option>
				<option value="2">AOS</option>
				<option value="3">PERMATA</option>
				<option value="4">PERDANA PERKASA ELASTINDO</option>
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
				<option value="4">CUTI</option>
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
		<label class="control-label" for="grade">Grade</label>
		<div class="controls">
			<select class="input-medium" name="grade">
				<?php 
				// tampilkan untuk form ubah mahasiswa
				if($kd_npp > 0) { ?>
					<option value="<?php echo $kd_grade ?>"><?php echo $grade ?></option>
				<?php } ?>
				<option value=""></option>
				<option value="3">Trainee</option>
				<option value="4">Level 1</option>
				<option value="5">Level 2</option>
				<option value="6">Level 3</option>
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
		<label class="control-label" for="id_perusahaan">Perusahaan</label>
		<div class="controls">
			<select class="input-medium" name="id_perusahaan">
				<?php 
				// tampilkan untuk form ubah mahasiswa
				if($kd_npp > 0) { ?>
					<option value="<?php echo $kd_perusahaan ?>"><?php echo $perusahaan ?></option>
				<?php } ?>
				<option value=""></option>
				<option value="1">PT A</option>
				<option value="2">PT B</option>
				<option value="3">PT C</option>
				<option value="4">PT D</option>
				<option value="5">PT E</option>
				<option value="6">PT D</option>
			</select> * Wajib diisi untuk user Sales
		</div>
	</div>

	<div class="control-group">
		<label class="control-label" for="tanggal_aktif">tanggal aktif</label>
		<div class="controls">
			<?php
			if($kd_npp > 0)
			{?>
			<input type="text" id="tanggal_aktif" class="input-xlarge" name="tanggal_aktif" value="<?php echo $tanggal_aktif ?>"/>
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
		<label class="control-label" for="keterangan">keterangan</label>
		<div class="controls">
			<textarea id="keterangan" name="keterangan"><?php echo $keterangan ?></textarea>
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
				 if(this.value == 9 || this.value == 8 || this.value == 11 || this.value == 12)
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
