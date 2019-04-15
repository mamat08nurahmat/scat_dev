<?php 
include('include/config.php');
$leads = $_POST['pilih'];
$jumlah_dipilih = count($leads);
 
for($x=0;$x<$jumlah_dipilih;$x++){
	mssql_query("update leads set ket=2 WHERE id='$leads[$x]'");
}
 
header("location:index.php?page=29a");
 
?>