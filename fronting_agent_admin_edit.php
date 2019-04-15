<?php 
include('include/config.php');
$id = $_GET['id'];
if($_POST['pilih']){
	$nama_perusahaan	= $_POST['nama_perusahaan'];	
	$alamat				= $_POST['alamat'];
	$kota				= $_POST['id_area'];
	$kodepos			= $_POST['kodepos'];		
	$no_telp			= $_POST['no_telp'];	
	$tgl_input			= $_POST['tgl_input'];	
	$nama_pemproses		= $_POST['nama_pemproses'];	

	$order = mssql_query("
	UPDATE perusahaan SET 
	nama_perusahaan		='$nama_perusahaan',
	alamat				='$alamat',
	id_area				='$kota',
	kodepos				='$kodepos',
	no_telp				='$no_telp',
	tgl_input			='$tgl_input',
	nama_pemproses		='$nama_pemproses'
	WHERE id_perusahaan='$id' ");	
	if($order)
	{
	echo"
	<script> 
		alert('PERUSAHAAN BERHASIL DI UBAH');
		window.location.replace('index.php?page=30'); </script> ";
	}
	else
	{
	echo "PERUSAHAAN GAGAL DI UBAH".mssql_get_last_message();
	}	
}
?>

<?php
session_start();
include('include/config.php');
//-------------------combo wilayah-----------------------------------------
$query = mssql_query ("SELECT id_area, nama_area FROM area ORDER BY nama_area");
$arrpropinsi = array();
while ($row = mssql_fetch_array($query)) {
	$arrpropinsi [ $row['id_area'] ] = $row['nama_area'];
}
									
?>
<?php
session_start();
include('include/config.php');
$id = $_GET['id'];
//-------------------combo wilayah-----------------------------------------
$query = mssql_query ("SELECT id_area, nama_area FROM area ORDER BY nama_area");
$arrpropinsi = array();
while ($row = mssql_fetch_array($query)) {
	$arrpropinsi [ $row['id_area'] ] = $row['nama_area'];
}								
?>
<?

$data = mssql_fetch_array(mssql_query("SELECT * FROM perusahaan a LEFT JOIN area b on a.id_area=b.id_area where a.id_perusahaan=".$id ));
// jika kd_npp > 0 / form ubah data
if($id>0) {
	$nama_perusahaan	= $data['nama_perusahaan'];
	$alamat 			= $data['alamat'];
	$nama_area 			= $data['nama_area'];
	$kodepos 			= $data['kodepos'];
	$no_telp 			= $data['no_telp'];
} else {
	$nama_perusahaan	= "";
	$alamat 			= "";
	$nama_area 			= "";
	$kodepos 			= "";
	$no_telp 			= "";
}

?>
<body>
<div align="center" style="border:1px solid;background-color:#00BFFF"><strong><p>FRONTING AGENT</strong></p></div><br>
<form id="form-data1" action="" method="post" enctype="multipart/form-data">
<input type="hidden" name="id_perusahaan" value="<?php echo $id; ?>">
	<table align="left">
		<tr><th>Nama Perusahaan</th>
			<th><input name="nama_perusahaan" value="<?php echo $nama_perusahaan ?>" type="text"  ></th>
		</tr>
		<tr><th>Alamat</th>
			<th><textarea name="alamat" type="text"  ><?php echo $alamat ?></textarea></th>
		</tr>
	</table>
	<table align="center">
		<tr><th>Kota</th>
			<th><select id="propinsi" name="id_area"  >
				<option value="<?php echo $id_area ?>"><?php echo $nama_area ?></option>
				<?php
				foreach ($arrpropinsi as $kode=>$nama) {
					echo "<option value='$kode'>$nama</option>";
				}
				?>
				</select></th>
		</tr>
		<tr><th>Kodepos</th>
			<th><input name="kodepos" type="text" value="<?php echo $kodepos ?>" onkeypress="return hanyaAngka(event)" maxlength="5"   ></th>
		</tr>
		<tr><th>No Telp</th>
			<th><input name="no_telp" type="text" value="<?php echo $no_telp ?>" onkeypress="return hanyaAngka(event)" maxlength="13"   ></th>
		</tr>
	</table><br><br>
		<?php $date=date('Y/m/d H:i:s'); ?>
	<input type="hidden" name="tgl_input" value="<?php echo $date ?>">
		
	<table align="center">
		<tr><th><input type="submit" class="btn btn-primary" name="pilih" value="SIMPAN"></th>
			<th><a href="index.php?page=30" class="btn btn-danger" >BACK</a>
			</th></tr>
	</table>

	</form>
</body>

<script>
		function hanyaAngka(evt) {
		  var charCode = (evt.which) ? evt.which : event.keyCode
		   if (charCode > 31 && (charCode < 48 || charCode > 57))
 
		    return false;
		  return true;
		}
</script>

