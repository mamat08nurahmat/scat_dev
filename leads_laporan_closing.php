<?php
session_start();
$month=$_GET['month'];
$year=$_GET['year'];
$cbg=$_SESSION['id_cabang'];
$are=$_SESSION['id_area'];
$vdr=$_SESSION['id_vendor'];
$level=$_SESSION['user_level'];
if($level==1||$level==2)
{
	$cekcabang='';
}
elseif($level==10)
{
	$cekcabang="and g.id_vendor =".$vdr."";	
}
elseif($level==4)
{
	$cekcabang="and f.id_area =".$are."";	
}
else
{
	$cekcabang="and c.kode_cabang =".$cbg."";
}
include "include/config.php";
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=realisasi.xls");

$sql=mssql_query("select a.npp,b.nama,d.nama_grup,e.nama_grade,c.nama_cabang,f.nama_area,g.nama_vendor,h.product_name,a.target,a.realisasi,a.month,a.year
				from sales_target a 
				left join sales b on a.npp = b.npp
				left join cabang c on b.id_cabang = c.kode_cabang
				left join app_user_grup d on b.id_grup = d.id_grup
				left join grade e on b.grade = e.grade
				left join area f on c.id_area = f.id_area
				left join vendor g on b.id_vendor = g.id_vendor
				left join product h on a.productID = h.productID
				
				where a.month = $month and a.year = $year and b.status_sales=1 and c.tipe_cabang='KCU' ".$cekcabang."
				");

$persen = 100;
?>

<table width="663" border="0">
  <tr>
    <td colspan="12" style="background:#f5f5f5;text-align:center;">
	<span style="font-size:16px;">
	<strong>REALISASI SALES COMPANY <br> PT. Bank Negara Indonesia </strong>
	</span>
	</td>
  
  </tr>
  <tr>
    <td width="87%" align="center">&nbsp;</td>
    <td width="87%" align="center">&nbsp;</td>
    <td width="87%" align="center">&nbsp;</td>
    <td width="87%" align="center">&nbsp;</td>
    <td width="87%" align="center">&nbsp;</td>
    <td width="87%" align="center">&nbsp;</td>
  </tr>
</table>

<table width="663" border="1">
 <tr style='background:#7CFC00'>
    <td width="53"><center><b>NPP</b></center></td>
    <td width="53"><center><b>NAMA</b></center></td>
	<td width="200"><center><b>TIPE</b></center></td>
	<td width="200"><center><b>GRADE</b></center></td>
    <td width="53"><center><b>CABANG</b></center></td>
    <td width="53"><center><b>WILAYAH</b></center></td>
    <td width="53"><center><b>VENDOR</b></center></td>
	 <td width="53"><center><b>PRODUK</b></center></td>
    <td width="151"><center><b>TARGET</b></center></td>
    <td width="146"><center><b>PENCAPAIAN</b></center></td>
	 <td width="133"><center><b>BULAN</b></center></td>
    <td width="146"><center><b>TAHUN</b></center></td>
	
  </tr>
<?php
while($baris=mssql_fetch_array($sql))
{
?>
  <tr>
    <td><?=$baris['npp'];?></td>
    <td><?=$baris['nama'];?></td>
    <td><?=$baris['nama_grup'];?></td>
    <td><?=$baris['nama_grade'];?></td>
    <td><?=$baris['nama_cabang'];?></td>
    <td><?=$baris['nama_area'];?></td>
    <td><?=$baris['nama_vendor'];?></td>
	<td><?=$baris['product_name'];?></td>
    <td><?=number_format($baris['target']);?></td>
    <td><?=number_format($baris['realisasi']);?></td>
	<td><center><?=$baris['month'];?></center></td>
    <td><center><?=$baris['year'];?></center></td>
  </tr>
<?
}
?>  
</table>




