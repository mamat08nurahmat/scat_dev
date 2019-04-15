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
<input type="hidden" name="id_perusahaan" value="<?php echo $id; ?>">
	<table align="left">
		<tr><th>Nama Perusahaan</th>
			<th><input name="nama_perusahaan" value="<?php echo $nama_perusahaan ?>" type="text" readonly></th>
		</tr>
		<tr><th>Alamat</th>
			<th><textarea name="alamat" type="text" readonly><?php echo $alamat ?></textarea></th>
		</tr>
	</table>
	<table align="center">
		<tr><th>Kota</th>
			<th><select id="propinsi" name="kota" readonly>
				<option value="<?php echo $id_area ?>"><?php echo $nama_area ?></option>
				<?php
				foreach ($arrpropinsi as $kode=>$nama) {
					echo "<option value='$kode'>$nama</option>";
				}
				?>
				</select></th>
		</tr>
		<tr><th>Kodepos</th>
			<th><input name="kodepos" type="text" value="<?php echo $kodepos ?>" onkeypress="return hanyaAngka(event)" maxlength="5" readonly ></th>
		</tr>
		<tr><th>No Telp</th>
			<th><input name="no_telp" type="text" value="<?php echo $no_telp ?>" onkeypress="return hanyaAngka(event)" maxlength="13" readonly ></th>
		</tr>
	</table><br><br>
		<?php $date=date('Y/m/d H:i:s'); ?>
	<input type="hidden" name="tgl_input" value="<?php echo $date ?>">
		
	<table align="center">
		<tr><th><a href="index.php?page=30" class="btn btn-danger" >BACK</a></th></tr>
	</table>

	</form>
</body>



