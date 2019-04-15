<?php 
session_start();
include('include/config.php');
if($_POST['pilih']){
	$id		 			= $_POST['id'];
	$nama_nasabah		= $_POST['nama_nasabah'];	
	$id_cabang			= $_POST['id_cabang'];	
		
	$order= mssql_query("
	UPDATE report_tl SET 
	nama_nasabah		='$nama_nasabah',
	id_cabang			='$id_cabang',
	WHERE id_report ='$id' ");	
	
	if($order )
	{	
	echo"
	<script> 
		alert('DATA SUKSES DIUBAH');
		window.location.replace('index.php?page=32a');
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
$id= $_GET['id_report'];
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

$data = mssql_fetch_array(mssql_query("SELECT * FROM report_tl a 
										left join cabang c on a.id_cabang=c.kode_cabang and c.tipe_cabang='KCU'
										left join area d on c.id_area=d.id_area
										WHERE a.id_report=".$id));
if($id> 0) {
	$nama_nasabah		= $data['nama_nasabah'];
	$id_area			= $data['id_area'];
	$nama_area			= $data['nama_area'];
	$id_cabang			= $data['kode_cabang'];
	$nama_cabang		= $data['nama_cabang'];
} else {
	$nama_nasabah 		= "";
	$id_area			= "";
	$nama_area			= "";
	$id_cabang			= "";
	$nama_cabang		= "";
}
?>
<body>
<form id="form-data1" action="" method="post" enctype="multipart/form-data">
<input type="hidden" name="id" value="<?php echo $id ?>">
<input type="hidden" name="nama_user" value="<?php echo $_SESSION['namauser'] ?>">
	<table align="left">	
		<tr><td>Nama Nasabah</td>
			<td><input name="nama_prospek" value="<?php echo $nama_nasabah ?>"type="text"   /></td>
		</tr>
		<tr><td>Wilayah</td>
			<td><select id="propinsi" name="propinsi" class=" "   >
				<option value="<?php echo $id_area ?>"><?php echo $nama_area ?></option>
				<?php
				foreach ($arrpropinsi as $kode=>$nama) {
					echo "<option value='$kode'>$nama</option>";
				}
				?>
				</select></td>
		</tr>
		<tr><td>Cabang</td>
			<td><select id="id_cabang" name="id_cabang" class=" "  >
				<option value="<?php echo $id_cabang ?>"><?php echo $nama_cabang ?></option>
				</select></td>
		</tr>
	</table><br>
		
	<table align="center">
		<tr><td><input type="submit" class="btn btn-primary" name="pilih" value="SIMPAN"></td>
			<td><a href="index.php?page=31a" class="btn btn-danger" >BACK</a>
			</td></tr>
	</table>
</form>
</body>
 <link rel="stylesheet" type="text/css" href="../combobox/libs/bootstrap.css" media="screen" />
		<script type="text/javascript" src="../combobox/libs/jquery.min.js"></script>
		<script type="text/javascript">
		var j = jQuery.noConflict();
			$(document).ready(function(){
				$('#propinsi').change(function(){
					$.getJSON('data_tim_leader_update.php',{action:'getKab', kode_prop:$(this).val()}, function(json){
						$('#id_cabang').html('');
						$.each(json, function(index, row) {
							$('#id_cabang').append('<option value='+row.kode+'>'+row.nama+'</option>');
						});
					});
				});
			});
	</script>

