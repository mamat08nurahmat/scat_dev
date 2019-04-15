<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="">

		<script type="text/javascript">
			$(window).load(function() {
				$('#slider').nivoSlider();
			});
		</script>	
		<script type="text/javascript" src="aset-tabel/assets/js/jquery.validate.js"></script>
		<script type="text/javascript" src="aset-tabel/assets/js/messages_id.js"></script>		
		<!-- AKHIR NIVO SLIDER -->
	</head>
<?
// INCLUDE KONEKSI
require_once 'include/config.php';
// END OF INCLUDE KONEKSI
?>

	<div class="container" style="height:780px;width:100%;">
			<!-- <legend>
				
			</legend> -->
			<!-- MENAMBAHKAN FORM UNTUK PENCARIAN BERDASARKAN username -->
			<form name="user_form_search" action="" method="post" class="form-search">
				<input type="text" name="npp" placeholder="Masukkan NPP"/>
				<a href="?page=10" class="btn btn-primary" ><i class='icon-list'></i>All</a>
				<a href="?page=12" class="btn  btn-success"><i class="icon icon-plus"></i> Add</a>
			</form>
			<!-- END OF FORM PENCARIAN -->
			
<!-- MENAMBAHKAN KONFIRMASI JIKA UPDATE DATA BERHASIL -->
<?
if (isset($_GET['konfirmasi'])) {
	echo "<div id='form_alert' style='color:#DD1144' class='alert alert-success'>";
	echo "<a class='close' data-dismiss='alert' href='#'>x</a>Update Succesfull!";
	echo "</div>";
}
?>
<!-- END OF KONFIRMASI UPDATE DATA -->
<!--<div  style="width:100%;height:580px;overflow-y:hidden;overflow-x:scroll;">-->
<div  style="width:835px;height:545px;">
<table class="table table-bordered table-striped">
	<tr>
		<th style="width:90px;"><center>Aksi</center></th>
		
		<th><center>npp</center></th>
		<th><center>type</center></th>
		<th><center>nama</center></th>
		<th><center>status</center></th>
		<th><center>upliner</center></th>
		<th><center>keterangan</center></th>
		<th><center>alamat</center></th>
		<!--<th><center>kantor</center></th>
		<th><center>phone</center></th>
		<th><center>aktif</center></th>
		<th><center>resign</center></th>
		<th><center>Password</center></th>-->
		
	</tr>
	
	<?php
$batas=10;
$halaman=isset($_GET['halaman']) ? $_GET['halaman']: NULL;
$posisi=null;
if(empty($halaman)){
$posisi=0;
$halaman=1;
}else{
$posisi=($halaman-1)* $batas;
}

	$query_page="SELECT npp FROM sales";
if(isset($_POST['npp'])){
$npp=$_POST['npp'];
$query="SELECT * FROM sales WHERE npp LIKE '%$npp%'";
	$query_page="SELECT npp FROM sales WHERE npp LIKE '%$npp%'";
}
$result = mssql_query($query) or die(mysql_error());
$no=0;
//proses menampilkan data
while($rows=mssql_fetch_array($result)){

			?>

	<tr>
		<td>
			<a href="?page=15&npp=<?php echo $rows['npp']; ?>" class="btn btn-warning" >
				<i class="icon icon-pencil" style="100px;"></i></a>
			<a href="aset-tabel/user/user_act_delete.php?npp=<?php echo $rows['npp']; ?>" 
				onclick="return confirm('Apakah anda yakin akan menghapus data ini?')" class="btn btn-danger">
				<i class="icon icon-trash"></i></a>
		</td>
	
		
		<td><?php echo $rows['npp']; ?></td>
		<td><?php echo $rows['sales_type']; ?></td>
		<td><?php echo $rows['nama']; ?></td>
		<td><?php echo $rows['status']; ?></td>
		<td><?php echo $rows['upliner']; ?></td>
		<td><?php echo $rows['keterangan']; ?></td>
		<td><?php echo $rows['alamat']; ?></td>

		
	</tr>
	
	<?php
	}
	?>
	<!--
	<tr>
	<td colspan="14"><a href="?page=12" class="btn  btn-success"><i class="icon icon-plus"></i> Add</a></td>
	</tr>-->
</table>
</div>
<?php

$result_page = mssql_query($query_page);
$jmldata = mssql_num_rows($result_page);
$jmlhalaman = ceil($jmldata / $batas);
 
echo "<div class='pagination'><ul>"; 
for($i=1;$i<=$jmlhalaman;$i++) 
    echo "<li> <a href=$_SERVER[PHP_SELF]?halaman=$i>$i</a></li>"; 
?>
</ul>
</div>

<!-- MENAMPILKAN JUMLAH DATA -->
<div class="container" style=" height:60px; width:100%;">
	<div class="well">

	<?php
	echo "Jumlah Data : $jmldata";	
	?>
	</div>
</div>
<!-- END OF MENAMPILKAN JUMLAH DATA -->
</div>