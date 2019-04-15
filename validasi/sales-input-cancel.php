<?php
// buat koneksi ke database mssql
include('include/config.php');
$kd_npp = $_POST['kd_npp'];
$keterangan_tolak = $_POST['keterangan'];
			mssql_query("UPDATE temp_sales SET ket_tolak = '$keterangan_tolak',ket=4
			WHERE kd_npp = $kd_npp
			");

?>
