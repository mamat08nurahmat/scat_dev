<?php
$id=$_GET["id"]; 
include('include/config.php');
$tampil2 = "SELECT * FROM cart a 
						LEFT JOIN (SELECT KODE_cabang,ID_AREA,nama_cabang FROM CABANG WHERE tipe_cabang = 'KCU') c on a.id_cabang=c.kode_cabang 
						LEFT JOIN area d on c.id_area=d.id_area
						where a.npp='$id' and ket=2";
$sql2 = mssql_query($tampil2);
while($data2 = mssql_fetch_array($sql2))
 { 
echo ''; 
}
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

$cek="select * from sales where npp='$id'";
$xcek = mssql_query($cek);
$wcek = mssql_fetch_array($xcek);
$scek=$wcek['id_grup'];

$tampil = "SELECT * FROM cart a 
			LEFT JOIN (SELECT KODE_cabang,ID_AREA,nama_cabang FROM CABANG WHERE tipe_cabang = 'KCU') c on a.id_cabang=c.kode_cabang 
			LEFT JOIN area d on c.id_area=d.id_area
			where a.npp='$id' and ket=2";
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