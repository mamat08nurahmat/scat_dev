<?php 
include('include/config.php');
if($_POST['pilih']){
	$nama_perusahaan	= $_POST['nama_perusahaan'];	
	$alamat				= $_POST['alamat'];
	$kota				= $_POST['id_area'];
	$kodepos			= $_POST['kodepos'];		
	$no_telp			= $_POST['no_telp'];	
	$tgl_input			= $_POST['tgl_input'];	
	$nama_pemproses		= $_POST['nama_pemproses'];	

	$order = mssql_query("INSERT INTO perusahaan(nama_perusahaan,alamat,id_area,kodepos,no_telp,tgl_input,nama_pemproses)
					VALUES('$nama_perusahaan','$alamat','$kota','$kodepos','$no_telp',SYSDATETIME(),'$_SESSION[namauser]')");	
	if($order)
	{
	echo"
	<script> 
		alert('PERUSAHAAN DI TAMBAHKAN');
		window.location.replace('index.php?page=30'); </script> ";
	}
	else
	{
	echo "PERUSAHAAN GAGAL DI TAMBAHKAN".mssql_get_last_message();
	}	
}
?>

<?php 
include('include/config.php');
$id = $_GET['id_perusahaan'];
$query = mssql_query ("SELECT id_area, nama_area FROM area ORDER BY nama_area");
$arrpropinsi = array();
while ($row = mssql_fetch_array($query)) {
	$arrpropinsi [ $row['id_area'] ] = $row['nama_area'];
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
 <div align="center" style="border:1px solid;background-color:#00BFFF"><strong><p>DATA PERUSAHAAN</strong></p></div><br>
	<div class="row" style="width:98%;margin-left:10px;">
		<h3>
			<!--<div class="input-prepend pull-right">
				<form action="index.php?page=30" method="POST">
					<input type="text" value='' name="qcari" placeholder="Pencarian All">
					<input type="submit" value="cari">
				</form>
			</div>-->
			<!--<a href="index.php?page=30b"class="btn tambah" ><i class="icon-plus"></i> Tambah Data</a>-->	
			<div id="closed"></div>
			<a href="#popup"class="btn tambah"><i class="icon-plus"></i> Tambah data</a>
		</h3>	
	</div>
<table class="table table-condensed table-bordered table-hover" cellpadding="0" cellspacing="0">
<thead>
	<tr bgcolor='#666666' align='center'>
		<th><font color='white'><center>NO</center></font></th>
		<th><font color='white'><center>Nama Perusahaan </center></font></th>
        <th><font color='white'><center>Kota</center></font></th>
		<th><font color='white'><center>No Telp</center></font></th>
		<th style="width:45px;"><font color='white'><center>Aksi</center></font></th>
	</tr>
		<?php
		$i=1;
		if(isset($_POST['qcari'])){
		$qcari=$_POST['qcari'];
			echo "<b>Hasil pencarian : ".$qcari."</b>";
			$sql = mssql_query(" SELECT * FROM perusahaan a LEFT JOIN area d on a.id_area=d.id_area
                WHERE nama_perusahaan LIKE '%$qcari%'
                OR nama_area LIKE '%$qcari%'
                OR no_telp LIKE '%$qcari%'");
			} else {
			 $sql = mssql_query("SELECT * FROM perusahaan a LEFT JOIN area b on a.id_area=b.id_area ORDER BY nama_perusahaan ASC ");
        }
		while($data = mssql_fetch_array($sql)){
		?>
		<tr bgcolor="<?php echo $color ; ?>" >
			
			<td><font color='black'><?php echo $i++; ?></font></td>
			<td><font color='black'><?php echo $data['nama_perusahaan']; ?></font></td>
			<td><font color='black'><?php echo $data['nama_area']; ?></font></td>
			<td><font color='black'><?php echo $data['no_telp']; ?></font></td>
			<td><center><a class="icon-search" href="index.php?page=30a&id=<?php echo $data['id_perusahaan']; ?>"></a>
				<a class="icon-pencil" href="index.php?page=30b&id=<?php echo $data['id_perusahaan']; ?>"></a></center>
			</td>
		</tr>
		<?php } ?>
	</table>
<?php if(!isset($_POST['qcari'])) { ?>
<?php } ?>

		<div class="popup" id="popup">
			<div style="width:400px;"class="popup-container">
				<form action="" method="post">
				<table>
					<tr align="left"><th>Nama Perusahaan</th>
						<th><input name="nama_perusahaan" type="text" maxlength="20"></th>
					</tr>
					<tr align="left"><th>Alamat</th>
						<th><textarea name="alamat" type="text"></textarea></th>
					</tr>
					<tr align="left"><th>Kota</th>
						<th><select id="propinsi" name="id_area">
						<option value="<?php echo $id_area ?>"><?php echo $nama_area ?></option>
						<?php foreach ($arrpropinsi as $kode=>$nama) {
									echo "<option value='$kode'>$nama</option>"; }
						?>
							</select></th>
					</tr>
					<tr align="left"><th>Kodepos</th>
						<th><input name="kodepos" type="text" maxlength="5" onkeypress="return hanyaAngka(event)" ></th>
					</tr>
					<tr align="left"><th>No telp</th>
					<th><input type="text" name="no_telp"  onkeypress="return hanyaAngka(event)"></th>
					</tr>
					<input type="hidden" name="nama_pemproses"  value="<?php echo $_SESSION['namauser'] ?>">					
				</table>
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
</body>
</html>