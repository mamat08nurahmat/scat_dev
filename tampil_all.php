<?php
session_start();
$id=$_GET["id"];
$spv =$_GET["id_user_atasan"]; 
include('include/config.php');
if($_SESSION['user_level']==6)
	{
echo'
<br>
<h3><center>CART KELOLAAN</center> </h3>
<table border ="1" style="border-collapse:collapse; width:100%;">
<tr style="background:#CCC;">
<th><center>NO</center></th>
<th><center>CABANG</center></th>
<th><center>NPP</center></th>
<th><center>NAMA NASABAH</center></th>
<th><center>PRODUK</center></th>
<th><center>NOMINAL PENGAJUAN</center></th>
<th><center>AKSI</center></th>
<tr>';

$tampil = "SELECT * FROM cart a 
			LEFT JOIN (SELECT KODE_cabang,ID_AREA,nama_cabang FROM CABANG WHERE tipe_cabang = 'KCU') c on a.id_cabang=c.kode_cabang 
			LEFT JOIN area d on c.id_area=d.id_area
			where a.id_user_atasan='$_SESSION[npp]' and ket=2";
$sql = mssql_query($tampil);
$no = 1;
while($data = mssql_fetch_array($sql))
 {
echo "
 <td><center>".$no++."</center></td>
 <td><center>".$data['nama_cabang']."</center></td>
 <td><center>".$data['npp']."</center></td>
 <td><center>".$data['nama_nasabah']."</center></td>
 <td><center>".$data['produk']."</center></td>
 <td><center>Rp. ".number_format($data['nominal_pengajuan'])."</center></td>
 <td><a href='index.php?page=29k&id=".$data['id']."' class='btn'>view</a></td>
 </tr>
 ";
 }

echo "</table></br>";
} elseif($_SESSION['user_level'] == 1 )
	{
		echo'
<br>
<h3><center>CART KELOLAAN</center> </h3>
<table border ="1" style="border-collapse:collapse; width:100%;">
<tr style="background:#CCC;">
<th><center>NO</center></th>
<th><center>CABANG</center></th>
<th><center>NPP</center></th>
<th><center>NAMA NASABAH</center></th>
<th><center>PRODUK</center></th>
<th><center>NOMINAL PENGAJUAN</center></th>
<th><center>AKSI</center></th>
<tr>';

$tampil = "SELECT * FROM cart a 
			LEFT JOIN (SELECT KODE_cabang,ID_AREA,nama_cabang FROM CABANG WHERE tipe_cabang = 'KCU') c on a.id_cabang=c.kode_cabang 
			LEFT JOIN area d on c.id_area=d.id_area
			where ket=2";
$sql = mssql_query($tampil);
$no = 1;
while($data = mssql_fetch_array($sql))
 {
echo "
 <td><center>".$no++."</center></td>
 <td><center>".$data['nama_cabang']."</center></td>
 <td><center>".$data['npp']."</center></td>
 <td><center>".$data['nama_nasabah']."</center></td>
 <td><center>".$data['produk']."</center></td>
 <td><center>Rp. ".number_format($data['nominal_pengajuan'])."</center></td>
 <td><a href='index.php?page=29k&id=".$data['id']."' class='btn'>view</a></td>
 </tr>
 ";
 }

echo "</table></br>";
	}