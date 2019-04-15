<?php
session_start();
include "include/config.php";
$perusahaan	=$_GET['perusahaan'];
$id_grup	=$_GET['id_grup'];
$month		=$_GET['month'];
$year		=$_GET['year'];
$masuk		=$_SESSION['username'];
$npp		=$_SESSION['npp'];
$cbg		=$_SESSION['id_cabang'];
$are		=$_SESSION['id_area'];
$vdr		=$_SESSION['id_vendor'];
$level		=$_SESSION['user_level'];

$sql=mssql_query(" SELECT 
					p.id, 
					p.no_aplikasi,
					p.nama_nasabah,
					p.tanggal_booking,
					p.nama_produk,
					p.nominal,
					p.npp,
					p.nama_perusahaan,
					p.bulan,
					p.tahun,
					b.net_booking,
					b.tgl_update,
					c.nama_cabang
					FROM data_booking p
					LEFT JOIN (SELECT KODE_cabang,ID_AREA,nama_cabang FROM CABANG WHERE tipe_cabang = 'KCU') c on p.id_cabang=c.kode_cabang 
					left join history_data_booking b on p.id=b.id
					WHERE p.bulan='$month' and p.tahun='$year' and p.nama_perusahaan is not null order by tgl_update ASC
					");
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=data_booking"._.$month._.$year.".xls");




?>				

<table width="663" border="0">
  <tr>
   <td colspan="12" ><center><span style="font-size:16px;" ><strong>DATA BOOKING PERUSAHAAN  SALES COMPANY <br> PT. Bank Negara Indonesia </strong></span></center></td>
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
	<td width="87%" align="center">&nbsp;</td>
  </tr>
</table>

<table width="663" border="1">
 <tr style='background:#7CFC00'>
	<td width="53"><center><b>No</b></center></td>
    <td width="53"><center><b>No Aplikasi</b></center></td>
    <td width="53"><center><b>Nama Nasabah</b></center></td>
    <td width="53"><center><b>Tanggal Booking</b></center></td>
    <td width="53"><center><b>Nama Produk</b></center></td>
    <td width="151"><center><b>Nominal</b></center></td>
	<td width="133"><center><b>Net Booking</b></center></td>	
	<td width="133"><center><b>Nama Perusahaan</b></center></td>
	<td width="133"><center><b>Bulan</b></center></td>
	<td width="133"><center><b>Tahun</b></center></td>
	<td width="133"><center><b>Tanggal Update</b></center></td>
	<td width="133"><center><b>Nama Cabang</b></center></td>
	<td width="133"><center><b>NPP</b></center></td>
  </tr>

  
<?php
 $i++;
while($baris=mssql_fetch_array($sql))
{ 
	$net_booking=number_format($baris['net_booking'],0,",",".");
	$nominal=number_format($baris['nominal'],0,",",".");
	$tanggal = date('d/m/Y', strtotime($baris['tanggal_booking']));
	$tgl_update = date('d/m/Y', strtotime($baris['tgl_update']));
?>
  <tr>
	<td><?php echo $i++ ?></td>
    <td>'<?=$baris['no_aplikasi'];?></td>
    <td><?=$baris['nama_nasabah'];?></td>
    <td><center><?=$tanggal?></center></td>
    <td><?=$baris['nama_produk'];?></td>
	<td><?=$nominal;?></td>
	<?php
		if($net_booking==null)
		{
			?>
				<td><?=$nominal;?></td>
			<?php
		}
			elseif($net_booking > null)
		{
			?>
				<td><?=$net_booking;?></td>
			<?php
		}
		else			
   ?>
    <td><?=$baris['nama_perusahaan'];?></td>
    <td><?=$baris['bulan'];?></td>
    <td><?=$baris['tahun'];?></td>
	
	<td><center><?=$tgl_update;?></center></td>
	 <td><?=$baris['nama_cabang'];?></td>
	 <td><?=$baris['npp'];?></td>
  </tr>
<?
}
?>  
</table>