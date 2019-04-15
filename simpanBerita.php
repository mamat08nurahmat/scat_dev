<?php
error_reporting(0);
include('include/config.php');

$judul_berita	= $_POST['judul'];
$isi_berita		= $_POST['isi'];
//$tgl_berita		= date('d M Y H:i');
$aksiku			= $_POST['aksi'];

$order = "INSERT INTO berita VALUES ('$judul_berita','$isi_berita',SYSDATETIME(),'$aksiku')";
$result = mssql_query($order);	
if($result)
{
	echo"
<script> 
		alert('BERITA SUKSES DITAMBAH');
		window.location.replace('index.php?page=26'); </script> ";
}
else
{
	echo("<br>Input data is fail");
}
?>