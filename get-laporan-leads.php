<?php
session_start();
$sts=$_GET['status'];
$month=$_GET['month'];
$year=$_GET['year'];
$cbg=$_SESSION['id_cabang'];
//$uname=$_SESSION['username'];
$are=$_SESSION['id_area'];
$vdr=$_SESSION['id_vendor'];
$level=$_SESSION['user_level'];
$pyl=$_SESSION['id_user_atasan'];



include "include/config.php";
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=leads.xls");

$sql=mssql_query("select a.*,b.nama_cabang,c.nama from leads a join cabang b on a.kode_cabang=b.kode_cabang left join sales c on a.npp=c.npp
					where b.tipe_cabang='kcu' and a.month = '$month' and a.year = '$year' and a.npp = '$_SESSION[username]' and a.status = '$sts'");
?>


<table width="663" border="0">
  <tr>
    <!--<td colspan="4" ><span style="font-size:16px;"><strong>DATA SALES COMPANY <br> PT. Bank Negara Indonesia </strong></span></td>-->
    <td colspan="14" style="background:#f5f5f5;text-align:center;">
	<span style="font-size:16px;">
	<strong>
	LEADS SALES COMPANY 
	<br>
	PT. Bank Negara Indonesia
	</strong>
	</span>
	</td>
  </tr>
  <tr>
    <td width="87%" align="center">&nbsp;</td>
    <td width="87%" align="center">&nbsp;</td>
    <td width="87%" align="center">&nbsp;</td>
    <td width="87%" align="center">&nbsp;</td>
    <td width="87%" align="center">&nbsp;</td>

  </tr>
</table>

<table width="663" border="1">
 <tr style='background:#7CFC00'>
    <td><center><b>NPP</b></center></td>
    <td><center><b>NAMA</b></center></td>
    <td><center><b>NAMA PROSPEK</b></center></td>
    <td><center><b>CABANG</b></center></td>
    <td><center><b>REKENING</b></center></td>
    <td><center><b>TELP</b></center></td>
    <td><center><b>PRODUK</b></center></td>
    <td><center><b>COLLECT</b></center></td>
    <td><center><b>INPUT</b></center></td>
    <td><center><b>BOOKING</b></center></td>
    <td><center><b>BULAN</b></center></td>
    <td><center><b>TAHUN</b></center></td>
    <td><center><b>NOMINAL</b></center></td>
    <td><center><b>KETERANGAN</b></center></td>
  </tr>
<?php
while($baris=mssql_fetch_array($sql))
{
?>
  <tr>
    <td><?=$baris['npp'];?></td>
    <td><?=$baris['nama'];?></td>
    <td><?=$baris['nama_prospek'];?></td>
    <td><?=$baris['nama_cabang'];?></td>
    <td><?=$baris['no_rekening'];?></td>
    <td><?=$baris['no_telp'];?></td>
    <td><?=$baris['produk'];?></td>
    <td><?=$baris['kolek_data'];?></td>
    <td><?=$baris['input_elo'];?></td>
    <td><?=$baris['booking'];?></td>
	<td><center><?=$baris['month'];?></center></td>
	<td><center><?=$baris['year'];?></center></td>
	<td><?=number_format($baris['nominal']);?></td>
	<td><?=$baris['ket'];?></td>

  </tr>
<?
}
?>  
</table>