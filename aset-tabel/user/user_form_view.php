<?
// INCLUDE KONEKSI
require_once 'include/config.php';
// END OF INCLUDE KONEKSI

//INCLUDE TEMPLATE YANG BERISI FILE bootstrap
include '../template/header.php';
//END OF INCLUDE FILE bootstrap
?>
	<div class="container" style="border:1px solid; height:840px;">
			<!-- <legend>
				
			</legend> -->
			<!-- MENAMBAHKAN FORM UNTUK PENCARIAN BERDASARKAN username -->
			<form name="user_form_search" action="" method="post" class="form-search">
				<input type="text" name="npp" placeholder="Masukkan NPP"/>
				<a href='user_form_view.php' class="btn btn-primary" ><i class='icon-list'></i>All</a>
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
<div  style="border:3px solid white;width:70%;height:650px;overflow-y:hidden;overflow-x:scroll; border:1px solid;">
<table class="table table-bordered table-striped">
	<tr>
		<th><center>Aksi</center></th>
		
		<th><center>npp</center></th>1
		<th><center>type</center></th>2
		<th><center>nama</center></th>3
		<th><center>status</center></th>4
		<th><center>upliner</center></th>5
		<!--<th><center>keterangan</center></th>-->
		<!--<th><center>alamat</center></th>-->
		<!--<th><center>kantor</center></th>-->
		<!--<th><center>phone</center></th>-->
		<!--<th><center>aktif</center></th>-->
		<!--<th><center>resign</center></th>-->
		<!--<th><center>Password</center></th>-->	
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
$query="select * from sales
order by id asc
OFFSET $posisi ROWS 
FETCH NEXT $batas ROWS ONLY ";
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
			<a href="user_form_update.php?npp=<?php echo $rows['npp']; ?>" class="btn btn-warning" >
				<i class="icon icon-pencil"></i> Update</a>
			<a href="user_act_delete.php?npp=<?php echo $rows['npp']; ?>" 
				onclick="return confirm('Apakah anda yakin akan menghapus data ini?')" class="btn btn-danger">
				<i class="icon icon-trash"></i> Delete</a>
		</td>
	
		
		<td><?php echo $rows['npp']; ?></td>
		<td><?php echo $rows['sales_type']; ?></td>
		<td><?php echo $rows['nama']; ?></td>
		<td><?php echo $rows['status']; ?></td>
		<td><?php echo $rows['upliner']; ?></td>
		
	</tr>
	
	<?php
	}
	?>
	<tr>
	<td colspan="14"><a href="?page=12" class="btn  btn-success"><i class="icon icon-plus"></i> Add</a></td>
	</tr>
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
<div class="container" style="border:1px solid; height:60px;">
	<div class="well">

	<?php
	echo "Jumlah Data : $jmldata";	
	?>
	</div>
</div>
<!-- END OF MENAMPILKAN JUMLAH DATA -->
