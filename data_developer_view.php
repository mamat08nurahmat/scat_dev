<?php
session_start();
include('include/config.php');
$id = $_GET['id'];
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
?>
<?
$data = mssql_fetch_array(mssql_query("SELECT * FROM data_developer a 
join cabang c on a.id_cabang=c.kode_cabang and c.tipe_cabang='KCU'
join area d on c.id_area=d.id_area WHERE a.id_developer=".$id));
if($id>0) {
	$npp				= $data['npp'];
	$nama_sales			= $data['nama_sales'];
	$nama_developer	 	= $data['nama_developer'];
	$project_developer	= $data['project_developer'];
	$alamat_developer	= $data['alamat_developer'];
	$nama_area 			= $data['nama_area'];
	$id_cabang 			= $data['kode_cabang'];
	$nama_cabang 		= $data['nama_cabang'];
	$jml_unit			= $data['jml_unit'];
	$sisa_unit			= $data['sisa_unit'];
	$tanggal_mulai		= $data['tanggal_mulai'];
	$tanggal_berakhir	= $data['tanggal_berakhir'];
	$tgl_input			= $data['tgl_input'];
	$nama_pemproses		= $data['nama_pemproses'];
	$status_developer	= $data['status_developer'];
	if($data['status_developer']==1) {
		$status_developer = "AKTIF";
	} 
	elseif($data['status_developer']==0) {
		$status_developer = "NON AKTIF";
	}
	$keterangan			= $data['keterangan'];
	
} else {
	$npp				= "";
	$nama_sales			= "";
	$nama_developer	 	= "";
	$project_developer	= "";
	$alamat_developer	= "";
	$nama_area 			= "";
	$id_cabang 			= "";
	$nama_cabang 		= "";
	$jml_unit			= "";
	$sisa_unit			= "";
	$tanggal_mulai		= "";
	$tanggal_berakhir	= "";
	$tgl_input			= "";
	$nama_pemproses		= "";
	$status_developer	= "";
	$keterangan			= "";
}
?>
<body>
<div align="center" style="border:1px solid;background-color:#00BFFF"><strong><p>DATA DEVELOPER</strong></p></div><br>
<table align="left">
		<tr align="left"><th>NPP</th>
			<th><input name="npp" value="<?php echo  $npp; ?>" type="text" readonly  ></th>
		</tr  align="left">
		<tr align="left"><th>Nama Sales</th>
			<th><input name="nama_sales" value="<?php echo $nama_sales; ?>" type="text" readonly  ></th>
		</tr>
		<tr align="left"><th>Nama Developer</th>
			<th><input name="nama_developer" value="<?php echo $nama_developer; ?>" type="text" readonly  ></th>
		</tr>
		<tr align="left"><th>Project Developer</th>
			<th><input name="project_developer" value="<?php echo $project_developer; ?>" type="text" readonly  ></th>
		</tr>
		<tr  align="left"><th>Alamat Developer</th>
			<th><textarea name="alamat_developer" type="text" readonly ><?php echo $alamat_developer; ?></textarea></th>
		</tr>
		<tr align="left"><th>Wilayah</th>
			<th><select id="propinsi" name="propinsi"  readonly   >
			<option value="<?php echo $id_area ?>"><?php echo $nama_area ?></option>
			<?php
			foreach ($arrpropinsi as $kode=>$nama) {
				echo "<option value='$kode'>$nama</option>";
			}
			?>
			</select> </th></tr>
		<tr align="left"><th>Cabang</th>
			<th><select id="id_cabang" name="id_cabang" readonly  >
			<option value="<?php echo $id_cabang ?>"><?php echo $nama_cabang ?></option>
			</select></th></tr>
</table>
<table align="center">
		<tr align="left"><th>Jumlah Unit</th>
			<th><input name="jml_unit" value="<?php echo $jml_unit; ?>" type="text" readonly  ></th>
		</tr>
		<tr align="left"><th>Sisa Unit</th>
			<th><input name="sisa_unit" value="<?php echo $sisa_unit; ?>" type="text" readonly  ></th>
		</tr>
		<tr align="left"><th>Tanggal Mulai</th>
			<?php $format= date('d/m/Y',strtotime( $tanggal_mulai)); ?>
			<th><input name="tanggal_mulai" value="<?php echo $format ?>" type="text" readonly ></th>
		</tr>
		<tr align="left"><th>Status</th>
			<td><select name="status_developer" readonly >
				<option <?php if ($status_developer=='1'){echo "selected"; } ?>  value='1'>AKTIF</option>
				<option <?php if ($status_developer=='2'){echo "selected"; } ?> value='2'>NON AKTIF</option>			
				</select>
			</td>
		</tr>
		<tr align="left"><th>Keterangan</th>
			<th><textarea name="keterangan" type="text" readonly ><?php echo $keterangan; ?></textarea></th>
		</tr>
		<tr align="left"><th>Tanggal Berakhir</th>
			<?php $format1= date('d/m/Y',strtotime($tanggal_berakhir)); ?>
			<th><input name="tanggal_berakhir" value="<?php echo $format1 ?>" type="text" readonly ></th>
		</tr>
</table>
	<table align="center">
		<tr><th><input type="button" value="Back" class="btn btn-danger" onclick="goBack()">
			</th></tr>
	</table>		
</body>

<script>
function goBack() {
    window.history.back()
}
</script>
	