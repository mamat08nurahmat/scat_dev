<?php
include('include/config.php');
$id=$_GET["id"]; 
$month=$_GET["month"];
$year=$_GET["year"];
echo '
<br>
<h3>Detail Realisasi</h3>
<table border ="1" style="border-collapse:collapse; width:100%;">
<tr style="background:#CCC;">
<th>No</th>
<th>Nama</th>
<th>Produk</th>
<th>Nomnal</th>
<th>Bulan</th>
<th>Tahun</th>

</tr>
<tr>';
//
$tampil = "select * from lending where npp=$id and tahun=$year and bulan=$month";
//perintah menampilkan data dikerjakan
$sql = mssql_query($tampil);
//tampilkan seluruh data yang ada pada tabel user
while($data = mssql_fetch_array($sql))
 {
echo "
 <td><center>".$data['no_aplikasi']."</center></td>
 <td>".$data['nama_nasabah']."</td>
 <td>".$data['nama_produk']."</td>
 <td>Rp. ".number_format ($data['nominal'])."</td>
 <td>".$data['bulan']."</td>
 <td>".$data['tahun']."</td>
 </tr>";
 }
echo "</table><br>";