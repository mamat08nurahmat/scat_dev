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
	$cekcabang="and c.id_cabang =".$cbg."";
}
include "include/config.php";
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=performance.xls");

$sql=mssql_query("SELECT a.npp,c.nama,d.nama_grup,h.nama_grade,e.nama_cabang,f.nama_area,g.nama_vendor,b.nama_kpi,a.bobot,a.realisasi,a.performance,a.month,a.year
				  FROM performances a LEFT JOIN tmp_kpi b ON a.kpiid = b.kpiid 
				  LEFT JOIN sales c on a.npp = c.npp 
				  LEFT JOIN app_user_grup d on c.id_grup = d.id_grup
				  LEFT JOIN cabang e on e.kode_cabang = c.id_cabang
				  LEFT JOIN area f on e.id_area = f.id_area
				  LEFT JOIN vendor g on c.id_vendor = g.id_vendor
				  LEFT JOIN grade h on c.grade = h.grade
				  where month = $month and year = $year and c.status_sales=1 and e.tipe_cabang='KCU' ".$cekcabang."
				  union
SELECT a.npp,c.nama,d.nama_grup,h.nama_grade,e.nama_cabang,f.nama_area,g.nama_vendor,'TOTAL KPI' nama_kpi,sum(a.bobot) bobot,null realisasi,sum(a.performance) performance,a.month,a.year
				  FROM performances a LEFT JOIN kpi b ON a.kpiid = b.kpiid 
				  LEFT JOIN sales c on a.npp = c.npp 
				  LEFT JOIN app_user_grup d on c.id_grup = d.id_grup
				  LEFT JOIN cabang e on e.kode_cabang = c.id_cabang
				  LEFT JOIN area f on e.id_area = f.id_area
				  LEFT JOIN vendor g on c.id_vendor = g.id_vendor
				  LEFT JOIN grade h on c.grade = h.grade
				  where month = $month and year = $year and c.status_sales=1 and e.tipe_cabang='KCU' ".$cekcabang."
				  
				  group by a.npp,c.nama,d.nama_grup,h.nama_grade,e.nama_cabang,f.nama_area,g.nama_vendor,a.month,a.year
				  order by npp,bobot"
				);


?>

<table width="663" border="0">
  <tr>
   <td colspan="4" ><span style="font-size:16px;" ><strong>DATA SALES COMPANY <br> PT. Bank Negara Indonesia </strong></span></td>
  
  </tr>
  <tr>
    <td width="87%" align="center">&nbsp;</td>
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
    <td width="250"><center><b>NAMA</b></center></td>
    <td width="200"><center><b>TIPE</b></center></td>
    <td width="200"><center><b>GRADE</b></center></td>
    <td width="200"><center><b>CABANG</b></center></td>
    <td width="200"><center><b>WILAYAH</b></center></td>
    <td width="200"><center><b>VENDOR</b></center></td>
    <td width="53"><center><b>PRODUK KPI</b></center></td>
	 <td width="133"><center><b>BOBOT</b></center></td>
	 <td width="133"><center><b>REALISASI</b></center></td>
    <td width="146"><center><b>PERFORMANCE</b></center></td>
	<td width="146"><center><b>BULAN</b></center></td>
	<td width="151"><center><b>TAHUN</b></center></td>
    
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
    <td><?=$baris['nama_kpi'];?></td>
	<td><center><?=$baris['bobot'];?></center></td>
	<td><center><?=$baris['realisasi'];?></center></td>
    <td><center><?=$baris['performance'];?></center></td>
	<td><center><?=$baris['month'];?></center></td>
	<td><center><?=$baris['year'];?></center></td>
  </tr>
<?
}
?>  
</table>




