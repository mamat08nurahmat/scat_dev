<?php
session_start();
$status_sales=$_GET['status_sales'];
$id_grup=$_GET['id_grup'];
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
	$cekcabang="and f.id_vendor =".$vdr."";	
}

elseif($level==5)
{
	$cekcabang="and b.kode_cabang =".$cbg."";
}
elseif($level==4)
{
	$cekcabang="and c.id_area =".$are."";
}


include "include/config.php";
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=data_sales.xls");

$sql=mssql_query(
"select a.npp,
CASE a.id_grup
WHEN 8 THEN 'SC'+ A.npp
WHEN 9 THEN 'SC'+A.npp
WHEN 11 THEN 'SC'+A.npp
ELSE 'SD'+A.npp
END AS npp_grup
,a.nama,a.id_grup,d.nama_grup,e.nama_grade,f.nama_vendor,b.nama_cabang,c.nama_area,a.tanggal_aktif,a.tanggal_resign,a.id_user_atasan,a.status_sales,c.id_area,b.kode_cabang,c.kode_area
				from sales a 
				left join cabang b on a.id_cabang = b.kode_cabang
				left join area c on b.id_area = c.id_area
				left join app_user_grup d on a.id_grup = d.id_grup
				left join grade e on a.grade = e.grade
				left join vendor f on a.id_vendor = f.id_vendor

				where a.status_sales = '$status_sales' and d.id_grup in (8,9,11,12) and b.tipe_cabang='KCU' ".$cekcabang." order by npp");
				
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
    <td width="87%" align="center">&nbsp;</td>
    <td width="87%" align="center">&nbsp;</td>
    <td width="87%" align="center">&nbsp;</td>
    <td width="87%" align="center">&nbsp;</td>
  </tr>
</table>

<table width="663" border="1">
 <tr style='background:#7CFC00'>
    <td width="53"><center><b>NPP</b></center></td>
    <td width="151"><center><b>NAMA</b></center></td>
    <td width="146"><center><b>TIPE</b></center></td>
	<td width="133"><center><b>GRADE</b></center></td>
	<td width="133"><center><b>VENDOR</b></center></td>
	<td width="133"><center><b>CABANG</b></center></td>
    <td width="146"><center><b>WILAYAH</b></center></td>
    <td width="146"><center><b>KODE WILAYAH</b></center></td>
	<?php
		if($status_sales==2)
		{
			?>
				<td width="146"><center><b>RESIGN</b></center></td>
			<?php
		}
		elseif($status_sales==1)
		{
			?>
				<td width="146"><center><b>AKTIF</b></center></td>
			<?php
		}
		else
	?>
    <td width="146"><center><b>UPLINER</b></center></td>
    <td width="146"><center><b>STATUS</b></center></td>
  </tr>
<?php
while($baris=mssql_fetch_array($sql))
{
?>
  <tr>
    <td><?=$baris['npp_grup'];?></td>
    <td><?=$baris['nama'];?></td>
    <td><?=$baris['nama_grup'];?></td>
    <td><?=$baris['nama_grade'];?></td>
    <td><?=$baris['nama_vendor'];?></td>
    <td><?=$baris['nama_cabang'];?></td>
    <td><?=$baris['nama_area'];?></td>
    <td><?=$baris['kode_area'];?></td>
	<?php
		if($status_sales==2)
		{
			?>
				<td><?=$baris['tanggal_resign'];?></td>
			<?php
		}
		elseif($status_sales==1)
		{
			?>
				<td><?=$baris['tanggal_aktif'];?></td>
			<?php
		}
		else	
   ?>
    <td><?=$baris['id_user_atasan'];?></td>
    <td><?=$baris['status_sales'];?></td>
	
  </tr>
<?
}
?>  
</table>




