<?php 
session_start();
//$id = $_GET['id_developer'];
include('include/config.php');
if($_POST['ubah']){
	$id					= $_POST['id_developer'];
	$sisa_unit			= $_POST['sisa_unit'];	
	$status_developer	= $_POST['status_developer'];
	$keterangan			= $_POST ['keterangan'];
	$tanggal_berakhir	= $_POST['tanggal_berakhir'];
	$tgl_update			= $_POST['tgl_update'];	
	$order=  mssql_query (" 
	UPDATE data_developer SET 
	sisa_unit			='$sisa_unit', 
	status_developer	='$status_developer', 
	keterangan			='$keterangan', 
	tanggal_berakhir	='$tanggal_berakhir',
	tgl_update 			= SYSDATETIME()
	WHERE id_developer='$id'" );	
		if($order)
		{
		echo"
		<script> 
			alert('DATA DEVELOPER DI UBAH');
				window.location.replace('index.php?page=8a'); </script> ";
		}
		else
		{
		echo "DATA DEVELOPER GAGAL DI UBAH".mssql_get_last_message();
		}	
	}

?>

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
<script>
$(document).ready(function(){
     $("p").hide();
    $("#hide").click(function(){
        $("p").hide();
    });
    $("#show").click(function(){
        $("p").show();
    });
});
</script>
<body>

<form action="" method="post" enctype="multipart/form-data">  
<div align="center" style="border:1px solid;background-color:#00BFFF"><strong>DATA DEVELOPER</strong></div><br>
<input name="id_developer" value="<?php echo  $data['id_developer']; ?>" type="hidden" readonly  >
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
			<th><input name="sisa_unit" value="<?php echo $sisa_unit; ?>" type="text" onkeypress="return hanyaAngka(event)" ></th>
		</tr>
		<tr align="left"><th>Tanggal Mulai</th>
			<?php $format= date('d/m/Y',strtotime( $tanggal_mulai)); ?>
			<th><input name="tanggal_mulai" value="<?php echo $format ?>" type="text" readonly ></th>
		</tr>
		
		<tr align="left"><th>Status</th>
			<td><select name="status_developer" >
				<option <?php if ($status_developer=='1'){echo "selected=\"selected\""; } ?>  value='1' id="hide">AKTIF</option>
				<option <?php if ($status_developer=='2') {echo "selected=\"selected\""; } ?> value='2'  id="show">NON AKTIF</option>
				</select>
			</td>
			</tr>
		<tr align="left">
						<?php $date=date('Y/m/d H:i:s'); ?>
			<th><p><input type="hidden" name="tanggal_berakhir" value="<?php echo $date ?>" type="text" readonly ></p></th>
			<th><p>Keterangan</p><p><textarea name="keterangan" type="text" required></textarea></p><th>
			
		</tr><br>
		
		</table>
	<table align="center">
		<tr><th><input type="submit" class="btn btn-primary" name="ubah" value="SIMPAN">
		<a href="index.php?page=8a" class="btn btn-danger" >BACK</a>
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
	
		
	