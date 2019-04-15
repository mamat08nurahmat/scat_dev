<?php
SESSION_START();
include('include/config.php');

if($_POST['kirim']){
	$npp = $_POST['npp'];
	$nama_prospek = $_POST['nama_prospek'];
	$periode = $_POST['periode'];
	$no_telp = $_POST['no_telp'];
	$produk = $_POST['produk'];
	$nominal = $_POST['nominal'];
	$developer = $_POST['developer'];
	$keterangan = $_POST['keterangan'];
	
	if (empty($npp) || empty($nama_prospek) || empty($periode) || empty($no_telp) || empty($produk) || empty($nominal) || empty($developer) || empty($keterangan)) {
		echo "<strong>data harus di isi.</strong>";
	} else {
		//proses
	}
}

$order = "INSERT INTO pipeline VALUES ('$npp','$nama_prospek','$periode',$no_telp,'$produk',$nominal,'$developer','$keterangan','$tgl_input')";

//declare in the order variable
$result = mssql_query($order);	//order executes
if($result)
{
	echo"
<script> 
		alert('PIPELINE SUKSES DITAMBAHKAN');
		window.location.replace('index.php?page=28'); </script> ";
}
else
{
	echo("<br>Input data is fail");
}
?>