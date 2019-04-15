<link rel="stylesheet" type="text/css/css" href="style.css">
<?php
$id=$_GET["id"]; 
//Koneksi dan memilih database di server
include('include/config.php');
/*
*/
$tampil2="SELECT * FROM cart a 
		LEFT JOIN (SELECT KODE_cabang,ID_AREA,nama_cabang FROM CABANG WHERE tipe_cabang = 'KCU') c on a.id_cabang=c.kode_cabang 
		LEFT JOIN area d on c.id_area=d.id_area
		where a.npp=$_SESSION[npp] and a.ket=2 ";
		
$sql2 = mssql_query($tampil2);
while($data2 = mssql_fetch_array($sql2))
 {
	 
echo'<br>
<h3>Data Cart</h3>
<table border ="1" style="border-collapse:collapse; width:100%;">
<tr style="background:#CCC;">
<th><center>NO</center></th>
			<th><center>CABANG</center></th>
			<th><center>NPP</center></th>
			<th><center>NAMA NASABAH</center></th>
			<th><center>PRODUK</center></th>
			<th><center>NOMINAL PENGAJUAN</center></th>
<tr>';


echo "<tabel border=1>";
echo "<thead>";
echo "<tr><td>xxx</td><td>AAA</td><td>BBB</td></tr>";
echo "</thead>";
echo "<tbody>";
echo "<tr><td>1</td><td>AA</td><td>CC</td></tr>";
echo "<tr><td>1</td><td>AA</td><td>CC</td></tr>";
echo "<tr><td>1</td><td>AA</td><td>CC</td></tr>";
echo "</tbody>";

echo "</tabel>";
 }
 