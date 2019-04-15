<?php
require_once 'C:\xampp\htdocs\html\include/config.php';
//MENANGKAP VARIABLE FIELD DITABLE YANG DIKIRIM DENGAN METHODE POST
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

$query_validasi = "SELECT * FROM sales WHERE npp='".$npp."'";
$result_validasi = mssql_query($query_validasi);

$query_validasi_final = mssql_fetch_array($result_validasi);
echo $query_validasi_final['npp'];

if ($query_validasi_final['npp']!="") {
echo "<script>alert('Data sudah ada!');
		location.href='user_form_insert.php';
		</script>";
		
} else if ($query_validasi_final['npp']=="") {

$query =
"INSERT INTO sales 
(npp,sales_type,nama,status,upliner,keterangan,alamat,officeID,phone,tanggal_aktif,tanggal_resign,password) 
VALUES('$npp','$sales_type','$nama','$status','$upliner','$keterangan','$alamat','$officeID','$phone','$tanggal_aktif','$tanggal_resign','$password')";

$result = mssql_query($query);
header('Location:../../index.php?page=10');

}
?>