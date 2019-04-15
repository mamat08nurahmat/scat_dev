<?php 
include('include/config.php');
if($_POST['pilih']){
	$npp				= $_POST['npp'];	
	$nama_sales			= $_POST['nama_sales'];
	$nama_developer		= $_POST['nama_developer'];
	$project_developer	= $_POST['project_developer'];		
	$alamat_developer	= $_POST['alamat_developer'];	
	$id_cabang			= $_POST['id_cabang'];
	$jml_unit			= $_POST['jml_unit'];	
	$sisa_unit			= $_POST['sisa_unit'];	
	$tanggal_mulai		= $_POST['tanggal_mulai'];	
	$tanggal_berakhir	= $_POST['tanggal_berakhir'];	
	$tgl_input			= $_POST['tgl_input'];	
	$nama_pemproses		= $_POST['nama_pemproses'];	
	$status_developer	= $_POST['status_developer'];
	$developer			= mssql_query("SELECT COUNT(*) AS total FROM data_developer where npp='$_SESSION[npp]' and status_developer='1'");
	$dev 				= mssql_fetch_assoc($developer);
	$d					= $dev['total'];
	if($d > 1){
			echo"
			<script> 
			alert('DATA TIDAK DAPAT DIPROSES KARENA SUDAH LEBIH DARI 2 DATA DEVELOPER');
			window.location.replace('index.php?page=8a'); </script> ";
		 }
		    else
		 {	
		$order = mssql_query("INSERT INTO data_developer(npp,nama_sales,nama_developer,project_developer,alamat_developer,id_cabang,jml_unit,sisa_unit,tanggal_mulai,tgl_input,nama_pemproses,status_developer)
							VALUES('$npp','$nama_sales','$nama_developer','$project_developer','$alamat_developer','$id_cabang','$jml_unit','$sisa_unit','$tanggal_mulai',SYSDATETIME(),'$_SESSION[namauser]','$status_developer')");	
	
		if($order)
		{
		echo"
		<script> 
			alert('DATA DEVELOPER DI TAMBAHKAN');
				window.location.replace('index.php?page=8a'); </script> ";
		}
		else
		{
		echo "DATA DEVELOPER GAGAL DI TAMBAHKAN".mssql_get_last_message();
		}	
	}
}
?>
<?php 
include('include/config.php');
$id = $_GET['id_developer'];
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
$data = mssql_fetch_array(mssql_query("SELECT * FROM data_developer a 
join cabang c on a.id_cabang=c.kode_cabang and c.tipe_cabang='KCU'
join area d on c.id_area=d.id_area WHERE a.id_developer=".$id));
if($id> 0) {
	$id_cabang 			= $data['kode_cabang'];
	} else {
	$id_cabang 			= "";
	}	

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>scat</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="shortcut icon" href="favicon.png"/>
	<link href="sales-css/bootstrap.min.css" rel="stylesheet" media="screen">
	<link href="css/style-popup.css" rel="stylesheet">
</head>
<body>
 <div align="center" style="border:1px solid;background-color:#00BFFF"><strong><p>DATA DEVELOPER</strong></p></div><br>
	  <div class="row" style="width:98%;margin-left:10px;">
		<h3>
			<div class="input-prepend pull-right">
				<form action="index.php?page=8a" method="POST">
					<input type="text" value='' name="qcari" placeholder="Pencarian All">
					<input type="submit" value="cari">
				</form>
			</div>
			<div id="closed"></div>
			<a href="#popup"class="btn tambah"><i class="icon-plus"></i> Tambah data</a>
		</h3>	
	</div>	
<table class="table table-condensed table-bordered table-hover" cellpadding="0" cellspacing="0">
<thead>
	<tr bgcolor='#666666' align='center'>
		<th><font color='white'><center>NO</center></font></th>
		<th><font color='white'><center>Nama Developer</center></font></th>
		<th><font color='white'><center>Wilayah</center></font></th>
		<th><font color='white'><center>Project Developer</center></font></th>
		<th><font color='white'><center>Tanggal Mulai</center></font></th>
		<th><font color='white'><center>Tanggal Berakhir</center></font></th>
		<th><font color='white'><center>Status</center></font></th>
		<th style="width:45px;"><font color='white'><center>Aksi</center></font></th>
	</tr>
		<?php
		$i=1;
		if(isset($_POST['qcari'])){
		$qcari=$_POST['qcari'];
			echo "<b>Hasil pencarian : ".$qcari."</b>";
			$sql = mssql_query(" SELECT * FROM data_developer a LEFT JOIN (SELECT KODE_cabang,ID_AREA,nama_cabang FROM CABANG WHERE tipe_cabang = 'KCU') c on a.id_cabang=c.kode_cabang LEFT JOIN area d on c.id_area=d.id_area
                WHERE nama_developer LIKE '%$qcari%'
                OR project_developer LIKE '%$qcari%'
                OR alamat_developer LIKE '%$qcari%'
				OR nama_cabang LIKE '%$qcari%'");
			} else {
			 $sql = mssql_query("SELECT * FROM data_developer a LEFT JOIN (SELECT KODE_cabang,ID_AREA,nama_cabang FROM CABANG WHERE tipe_cabang = 'KCU') c on a.id_cabang=c.kode_cabang LEFT JOIN area d on c.id_area=d.id_area where npp='$_SESSION[npp]' ORDER BY status_developer,tanggal_mulai DESC ");
        }
		while($data = mssql_fetch_array($sql)){
			if($data['status_developer']==2) {
                $status = "NON AKTIF";
				$tombol =""; 
				$tombol .="<center><a class='icon-search' href='index.php?page=8c&id=".$data['id_developer']."'></a></center>"; 
				$color = "";	
				$color .= '#FF6347';	
            }
			elseif($data['status_developer']==1) {
                $status = "AKTIF";
				$tombol ="";
				$tombol .="<a class='icon-pencil' href='index.php?page=8b&id=".$data['id_developer']."'></a>|";	
				$tombol .="<a class='icon-search' href='index.php?page=8c&id=".$data['id_developer']."'></a>";
				$color 	 = 'white';
            }
		?>
		<tr bgcolor="<?php echo $color ; ?>" >
			
			<td><font color='black'><?php echo $i++; ?></font></td>
			<td><font color='black'><?php echo $data['nama_developer']; ?></font></td>
			<td><font color='black'><?php echo $data['nama_cabang']; ?></font></td>
			<td><font color='black'><?php echo $data['project_developer']; ?></font></td>
			<?php $format=date('d-m-Y',strtotime($data['tanggal_mulai'])); ?>
			<td><center><font color='black'><?php echo $format; ?></font></center></td>
			<?php $format1=date('d-m-Y',strtotime($data['tanggal_berakhir'])); ?>
			<td><center><font color='black'><?php echo $format1; ?></font></center></td>
			<td><center><font color='black'><?php echo $status; ?></font></center></td>
			<td><?=$tombol;?></td>
		</tr>
		<?php } ?>
	</table>
<?php if(!isset($_POST['qcari'])) { ?>
<?php } ?>

		<div class="popup" id="popup">
			<div style="width:750px; height:300px;"class="popup-container">
				<form action="" method="post">
				<table align="left">
				<input name="status_developer" type="hidden"  value="1" maxlength="20" readonly >
					<tr align="left"><th>NPP</th>
						<th><input name="npp" type="text"  value="<?php echo $_SESSION['npp'] ?>" maxlength="20" readonly ></th>
					</tr>
					<tr align="left"><th>Nama Sales</th>
						<th><input name="nama_sales" type="text"  value="<?php echo $_SESSION['namauser'] ?>" maxlength="20" readonly></th>
					</tr>
					<tr align="left"><th>Nama Developer</th>
						<th><input name="nama_developer" type="text" maxlength="20"></th>
					</tr>
					<tr align="left"><th>Project Developer</th>
						<th><input name="project_developer" type="text" maxlength="20"></th>
					</tr>
					<tr align="left"><th>Alamat Developer</th>
						<th><textarea name="alamat_developer" type="text"></textarea></th>
					</tr>
				</table>
				<table align="center">
					<tr align="left"><th>Wilayah</th>
						<th><select id="propinsi" name="propinsi" class="required" required >
							<option value="<?php echo $id_area ?>"><?php echo $nama_area ?></option>
							<?php
							foreach ($arrpropinsi as $kode=>$nama) {
							echo "<option value='$kode'>$nama</option>";
							}
							?>
							</select></th>
					</tr>
					<tr align="left"><th>Cabang</th>
						<th><select id="id_cabang" name="id_cabang" class="required" required  >
							<option value="<?php echo $id_cabang ?>"><?php echo $nama_cabang ?></option>
							</select></th>
					</tr>
					<tr align="left"><th>Jumlah Unit</th>
						<th><input name="jml_unit" type="text" maxlength="5" onkeypress="return hanyaAngka(event)" ></th>
					</tr>
					<tr align="left"><th>Sisa Unit</th>
						<th><input type="text" name="sisa_unit"  onkeypress="return hanyaAngka(event)"></th>
					</tr>
					<tr align="left"><th>Tanggal Mulai</th>
						<th><input type="date" name="tanggal_mulai"  onkeypress="return hanyaAngka(event)"></th>
					</tr>				
				</table><br><br>
				
				<table align="center">
					<tr><th><input type="submit" class="btn btn-primary" name="pilih" value="SIMPAN"></th>
						<th><a href="#closed" class="btn btn-danger" >BACK</a></th>
					</tr>
					<a class="popup-close" href="#closed">x</a>
				</form>
				</table>
			</div>	
		</div>
	<script>
		function hanyaAngka(evt) {
		  var charCode = (evt.which) ? evt.which : event.keyCode
		   if (charCode > 31 && (charCode < 48 || charCode > 57))
 
		    return false;
		  return true;
		}
	</script>	
<script src="jquery-1.8.3.min.js"></script>
<script src="sales-js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="../combobox/libs/bootstrap.css" media="screen" />
<script type="text/javascript" src="../combobox/libs/jquery.min.js"></script>
	<script type="text/javascript">
		var j = jQuery.noConflict();
			$(document).ready(function(){
				$('#propinsi').change(function(){
					$.getJSON('data_developer.php',{action:'getKab', kode_prop:$(this).val()}, function(json){
						$('#id_cabang').html('');
						$.each(json, function(index, row) {
							$('#id_cabang').append('<option value='+row.kode+'>'+row.nama+'</option>');
						});
					});
				});
			});
	</script>
	
</body>
</html>
