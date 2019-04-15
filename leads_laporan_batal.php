<?php
session_start();
include "include/config.php";
$status=$_GET['status'];
$id_grup=$_GET['id_grup'];
$month=$_GET['month'];
$year=$_GET['year'];
$masuk=$_SESSION['username'];
$npp=$_SESSION['npp'];
$cbg=$_SESSION['id_cabang'];
$are=$_SESSION['id_area'];
$vdr=$_SESSION['id_vendor'];
$level=$_SESSION['user_level'];
//8,9,11
if($level==1||$level==2)
{
	$cek='';
}
elseif($level==10)
{
	$cek="and f.id_vendor =".$vdr."";	
}

elseif($level==6)
{
	$cek="and id_user_atasan =".$masuk."";
}
elseif($level==8 || $level==9 || $level==11)
{
	$cek="and npp =".$npp."";
}

elseif($level==4)
{
	$cek="and c.id_area =".$are."";
}

$sql=mssql_query("
select * from(
					SELECT 
					a.npp,
					a.nama_sales,
					c.id_user_atasan,
					d.nama_cabang,
					e.kode_area,
					upper (a.nama_nasabah) as nama_prospek,
					a.no_telp,
					a.produk,
					a.nominal_pengajuan,
					upper (a.ket) as keterangan,
					a.no_aplikasi,
					a.no_rekening,
					convert(varchar(20), 
					a.tgl_input,105) as tanggal, 
					MONTH(a.tgl_input) as month,
					YEAR(a.tgl_input) as year,
					f.keterangan as alasan
									FROM cart a 
									left join sales c on a.npp = c.npp 
									left join cabang d on c.id_cabang = d.kode_cabang 
									left join area e on d.id_area = e.id_area
									left join history_leads f on a.id = f.id
									WHERE 
									c.id_grup in (6,8,9,11) and d.tipe_cabang='KCU' and f.ket='$status' 
					)p
					WHERE p.month='$month' and p.year='$year' and p.keterangan='$status'  ".$cek."
					order by p.tanggal DESC

					");
					
					
						
//$baris=mssql_fetch_array($sql);
//print_r($baris);die();
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=data_leads"._.$month._.$year.".xls");

				
?>

<table width="663" border="0">
  <tr>
   <td colspan="4" ><span style="font-size:16px;" ><strong>DATA LEADS SALES COMPANY<br> PT. Bank Negara Indonesia </strong></span></td>
  
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
	<td width="53"><center><b>No</b></center></td>
    <td width="53"><center><b>Npp</b></center></td>
    <td width="53"><center><b>Nama Sales</b></center></td>
    <td width="53"><center><b>Cabang</b></center></td>
    <td width="53"><center><b>Wilayah</b></center></td>
    <td width="151"><center><b>Nama Prospek</b></center></td>
	<td width="133"><center><b>Telp</b></center></td>
	<td width="133"><center><b>Produk</b></center></td>
	<td width="133"><center><b>Nominal Pengajuan</b></center></td>
	
	<?php
		if($status==5)
		{
			?>
				<td width="146"><center><b>Tidak Tertarik</b></center></td>
			<?php
		}
		elseif($status==6)
		{
			?>
				<td width="146"><center><b>BATAL</b></center></td>
			<?php
		}else{
			?>
				<td width="146"><center><b>No Aplikasi</b></center></td>
				<td width="146"><center><b>No Rekening</b></center></td>
			<?php
		}
	?>	
    <td width="146"><center><b>Tanggal</b></center></td>
  </tr>

  
<?php
 $i++;
while($baris=mssql_fetch_array($sql))
{
?>
  <tr>
	<td><?php echo $i++ ?></td>
    <td><?=$baris['npp'];?></td>
    <td><?=$baris['nama_sales'];?></td>
    <td><?=$baris['nama_cabang'];?></td>
    <td><?=$baris['kode_area'];?></td>
    <td><?=$baris['nama_prospek'];?></td>
    <td><?=$baris['no_telp'];?></td>
    <td><?=$baris['produk'];?></td>
    <td><?=$baris['nominal_pengajuan'];?></td>

	<?php
		if($status==5 || $status==6 )
		{
			?>
				<td><?=$baris['alasan'];?></td>
			<?php
		}
		else
		{
			?>
				<td><?=$baris['no_aplikasi'];?></td>
				<td><?=$baris['no_rekening'];?></td>
			<?php
		}
   ?>
    <td><?=$baris['tanggal'];?></td>
	
<?php

?>	
  </tr>
<?
}
?>  
</table>