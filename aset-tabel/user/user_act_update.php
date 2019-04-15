<?php

require_once 'C:\xampp\htdocs\html\include/config.php';

$npp = $_POST['npp'];
$sales_type = $_POST['sales_type'];
$nama = $_POST['nama'];
$status = $_POST['status'];
$upliner = $_POST['upliner'];
$keterangan = $_POST['keterangan'];
$alamat = $_POST['alamat'];
$officeID = $_POST['officeID'];
$phone = $_POST['phone'];
$tanggal_aktif = $_POST['tanggal_aktif'];
$tanggal_resign = $_POST['tanggal_resign'];
$password = $_POST['password'];

$query = 
		"UPDATE sales set npp = '$npp', sales_type = '$sales_type', nama = '$nama', status = '$status', upliner = '$upliner', keterangan = '$keterangan', alamat = '$alamat', officeID = '$officeID', phone = '$phone', tanggal_aktif ='$tanggal_aktif', tanggal_resign = '$tanggal_resign', password='$password'
							WHERE npp = '$npp'";
$result = mssql_query($query) or die(mysql_error());

mysql_close();

if ($result > 0) {
	header('Location:../../index.php?page=10');
} else {
	header('Location:../../index.php?page=10');
}
?>