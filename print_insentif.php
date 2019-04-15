<?php
session_start();
//$month=1;
//$year=2018;
$level=1;
$month=$_GET['month'];
$year=$_GET['year'];
/*
$level=$GET['level'];

$level=$_SESSION['user_level'];
$cbg=$_SESSION['id_cabang'];
$are=$_SESSION['id_area'];
$vdr=$_SESSION['id_vendor'];
$pyl=$_SESSION['id_user_atasan'];
*/
if($level==1||$level==2)
{
	$cekcabang='';
}
elseif($level==10)
{
	$cekcabang="and id_vendor =".$vdr."";	
}
elseif($level==4)
{
	$cekcabang="and id_area =".$are."";
}
elseif($level==5)
{
	$cekcabang="and kode_cabang =".$cbg."";
}
else
{
	$cekcabang="and kode_cabang =".$cbg."";
}



include "include/config.php";
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=insentif.xls");


			
?>
<?php
$query_wilayah =mssql_query("select * from area");
while($wilayah=mssql_fetch_array($query_wilayah))
{
/*
*/
$kode_area = $wilayah['kode_area'];
$nama_area = $wilayah['nama_area'];
?>


<!-------SALES LEVEL------->

<table width="663" border="0">
  <tr>
    <td width="87%" align="center">&nbsp;</td>
    <td width="87%" align="center">&nbsp;</td>
    <td width="87%" align="center">&nbsp;</td>
    <td width="87%" align="center">&nbsp;</td>
    <td width="87%" align="center">&nbsp;</td>
    <td width="87%" align="center">&nbsp;</td>

  </tr>


  <tr>
    <!--<td colspan="4" ><span style="font-size:16px;"><strong>DATA SALES COMPANY <br> PT. Bank Negara Indonesia </strong></span></td>-->
    <td colspan="12" style="background:#f5f5f5;text-align:center;">
	<span style="font-size:16px;">
	<strong>
	INSENTIF SALES COMPANY 
	<br>
	PT. Bank Negara Indonesia <?php //echo date('M-Y');?>
	<br>
	Wilayah <?=$wilayah['nama_area']." (".$wilayah['kode_area'].")";?>
	<?//=$kode_area;?>
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
    <td width="87%" align="center">&nbsp;</td>

  </tr>
</table>

<table width="663" border="1">
 <tr style='background:#7CFC00'>
    <td><center><b>NO</b></center></td>
    <td><center><b>NPP</b></center></td>
    <td><center><b>NAMA</b></center></td>
    <td><center><b>TIPE</b></center></td>
    <td><center><b>GRADE</b></center></td>
    <td><center><b>CABANG</b></center></td>

    <td><center><b>VENDOR</b></center></td>

    <td><center><b>PERFORMANCE</b></center></td>
    <td><center><b>INSENTIF</b></center></td>

	</tr>
<?php
$sql=mssql_query("select 
		a.npp,
		a.nama,
		a.nama_grup,
		a.nama_grade,
		a.id_user_atasan,
		a.nama_cabang,
		a.nama_area,
		a.nama_vendor,
		a.realisasi,
		total,
		insentif,
		a.month,
		a.year,
		a.id_vendor
		 from
			(select a.npp,b.nama,b.id_user_atasan,b.status_sales,h.realisasi,d.nama_grup,c.nama_cabang,c.tipe_cabang,c.atasan_cabang,c.kode_cabang,e.nama_grade,f.nama_area,g.nama_vendor,a.year,a.month,b.grade,g.id_vendor,f.id_area,ISNULL(sum(performance),0) as total,
			CASE
			WHEN ISNULL(sum(performance),0) >=1000 THEN 1000
			ELSE ISNULL(sum(performance),0)
			END AS Perform
			 from performances a 
					left join sales b on a.npp = b.npp
					left join cabang c on b.id_cabang = c.kode_cabang
					left join app_user_grup d on b.id_grup = d.id_grup
					left join grade e on b.grade = e.grade
					left join area f on c.id_area = f.id_area
					left join vendor g on b.id_vendor = g.id_vendor
					left join (select npp,realisasi,month,year from sales_target) h on a.npp=h.npp and a.month=h.month and a.year=h.year

				 group by a.npp,b.nama,b.id_user_atasan,d.nama_grup,a.year,a.month,b.grade,c.nama_cabang,c.tipe_cabang,c.atasan_cabang,c.kode_cabang,f.nama_area,g.nama_vendor,e.nama_grade,g.id_vendor,f.id_area,b.status_sales,h.realisasi
			)a
			left join (select npp,month,year,performance,insentif from vw_insentif where bobot=100) b
			on a.npp = b.npp and a.month = b.month and a.year = b.year and a.perform = b.performance
			where 
				a.nama_area='$nama_area' and  a.month = '$month' and a.year = '$year' and a.tipe_cabang = 'KCU' and a.nama_grade <> 'Trainee' and a.status_sales=1 ".$cekcabang."
				and insentif >0
order by insentif	desc
			");


$no=1;
while($baris=mssql_fetch_array($sql))
{
?>
  <tr>
    <td><?=$no++;?></td>
    <td><?=$baris['npp'];?></td>
    <td><?=$baris['nama'];?></td>
    <td><?=$baris['nama_grup'];?></td>
    <td><?=$baris['nama_grade'];?></td>
    <td><?=$baris['nama_cabang'];?></td>

    <td><?=$baris['nama_vendor'];?></td>

    <td><center><?=$baris['total'];?></center></td>
	<td><?=number_format($baris['insentif']);?></td>

	
  </tr>
<?
}
?>  
</table>
<!-------SALES LEVEL------->




<!-------SALES TRAINEE------->
<table width="663" border="0">

  <tr>
    <td width="87%" align="center">&nbsp;</td>
    <td width="87%" align="center">&nbsp;</td>
    <td width="87%" align="center">&nbsp;</td>
    <td width="87%" align="center">&nbsp;</td>
    <td width="87%" align="center">&nbsp;</td>
    <td width="87%" align="center">&nbsp;</td>

  </tr>


  <tr>
    <!--<td colspan="4" ><span style="font-size:16px;"><strong>DATA SALES COMPANY <br> PT. Bank Negara Indonesia </strong></span></td>-->
    <td colspan="12" style="background:#f5f5f5;text-align:center;">
	<span style="font-size:16px;">
	<strong>
	INSENTIF SALES COMPANY 
	<br>
	PT. Bank Negara Indonesia <?php //echo date('M-Y');?>
	<br>
	Wilayah <?=$wilayah['nama_area']." (".$wilayah['kode_area'].")";?>
	<?//=$kode_area;?>
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
    <td width="87%" align="center">&nbsp;</td>

  </tr>
</table>

<table width="663" border="1">
 <tr style='background:#7CFC00'>
    <td><center><b>NO</b></center></td>
    <td><center><b>NPP</b></center></td>
    <td><center><b>NAMA</b></center></td>
    <td><center><b>TIPE</b></center></td>
    <td><center><b>GRADE</b></center></td>
    <td><center><b>CABANG</b></center></td>

    <td><center><b>VENDOR</b></center></td>

    <td><center><b>REALISASI</b></center></td>
    <td><center><b>INSENTIF</b></center></td>

	</tr>
<?php
$sql2=mssql_query("
	
		select 
		a.npp,
		a.nama,
		a.nama_grup,
		a.nama_grade,
		a.id_user_atasan,
		a.nama_cabang,
		a.nama_area,
		a.nama_vendor,
		a.realisasi,
		total,
		(a.realisasi * 0.003) as insentif,
		a.month,
		a.year,
		a.id_vendor
		 from
			(select a.npp,b.nama,b.id_user_atasan,b.status_sales,h.realisasi,d.nama_grup,c.nama_cabang,c.tipe_cabang,c.atasan_cabang,c.kode_cabang,e.nama_grade,f.nama_area,g.nama_vendor,a.year,a.month,b.grade,g.id_vendor,f.id_area,ISNULL(sum(performance),0) as total,
			CASE
			WHEN ISNULL(sum(performance),0) >=1000 THEN 1000
			ELSE ISNULL(sum(performance),0)
			END AS Perform
			 from performances a 
					left join sales b on a.npp = b.npp
					left join cabang c on b.id_cabang = c.kode_cabang
					left join app_user_grup d on b.id_grup = d.id_grup
					left join grade e on b.grade = e.grade
					left join area f on c.id_area = f.id_area
					left join vendor g on b.id_vendor = g.id_vendor
					left join (select npp,realisasi,month,year from sales_target) h on a.npp=h.npp and a.month=h.month and a.year=h.year

				 group by a.npp,b.nama,b.id_user_atasan,d.nama_grup,a.year,a.month,b.grade,c.nama_cabang,c.tipe_cabang,c.atasan_cabang,c.kode_cabang,f.nama_area,g.nama_vendor,e.nama_grade,g.id_vendor,f.id_area,b.status_sales,h.realisasi
			)a
			left join (select npp,month,year,performance,insentif from vw_insentif where bobot=100) b
			on a.npp = b.npp and a.month = b.month and a.year = b.year and a.perform = b.performance
			where 
			a.nama_area='$nama_area' and a.month = '$month' and a.year = '$year' and a.tipe_cabang = 'KCU' and a.nama_grade = 'Trainee' and a.status_sales=1 ".$cekcabang."
		and total > 0
order by insentif	desc		
			");


$no=1;
while($baris=mssql_fetch_array($sql2))
{
?>
  <tr>
    <td><?=$no++;?></td>
    <td><?=$baris['npp'];?></td>
    <td><?=$baris['nama'];?></td>
    <td><?=$baris['nama_grup'];?></td>
    <td><?=$baris['nama_grade'];?></td>
    <td><?=$baris['nama_cabang'];?></td>

    <td><?=$baris['nama_vendor'];?></td>

    <td><center><?=number_format($baris['realisasi']);?></center></td>
	<td><?=number_format($baris['insentif']);?></td>

	
  </tr>
<?
}
?>  
</table>
<!-------SALES TRAINEE------->


<?
}
?>  

