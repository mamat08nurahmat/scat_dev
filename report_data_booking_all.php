<?php
session_start();
include "include/config.php";
$ket		=$_GET['ket'];
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
					p.ket,
					p.id_pipeline, 
					p.no_aplikasi,
					p.nama,
					p.nominal,
					p.produk,
					b.nama_perusahaan,
					p.keterangan,
					p.nama_tl,
					b.npp,
					c.nama_cabang, 
					convert(varchar(20), 
					p.tgl_input,105) as tanggal, 
					MONTH(p.tgl_input) as month,
					YEAR(p.tgl_input) as year
					FROM pipeline_vendor p
					left join data_booking b on p.no_aplikasi=b.no_aplikasi
					LEFT JOIN (SELECT KODE_cabang,ID_AREA,nama_cabang FROM CABANG WHERE tipe_cabang = 'KCU') c on b.id_cabang=c.kode_cabang 
					WHERE MONTH(p.tgl_input)='$month' and YEAR(p.tgl_input)='$year' order by tgl_update ASC
					");
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=data_booking_pipeline"._.$month._.$year.".xls");




?>				

<table width="663" border="0">
  <tr>
   <td colspan="12" ><center><span style="font-size:16px;" ><strong>DATA BOOKING PIPELINE <?php echo $ket ?> SALES COMPANY<br> PT. Bank Negara Indonesia </strong></span></center></td>
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
    <td width="151"><center><b>Nominal</b></center></td>
	<td width="53"><center><b>Nama Produk</b></center></td>	
	<td width="133"><center><b>Nama Perusahaan</b></center></td>
	<td width="133"><center><b>Bulan</b></center></td>
	<td width="133"><center><b>Tahun</b></center></td>
	<td width="133"><center><b>Tanggal Update</b></center></td>
	<td width="133"><center><b>Nama Cabang</b></center></td>
	<td width="133"><center><b>NPP</b></center></td>
	<td width="133"><center><b>Keterangan</b></center></td>
  </tr>

  
<?php
 $i++;
while($baris=mssql_fetch_array($sql))
{
	$nominal=number_format($baris['nominal'],0,",",".");
	$tgl_update = date('d/m/Y', strtotime($baris['tgl_update']));
	$status = $baris['ket'];
?>
  <tr>
	<td><?php echo $i++ ?></td>
    <td>'<?=$baris['no_aplikasi'];?></td>
    <td><?=$baris['nama'];?></td>
	<td><?=$nominal;?></td>
	<td><?=$baris['produk'];?></td>
	<td><?=$baris['nama_perusahaan'];?></td>
    <td><?=$baris['month'];?></td>
    <td><?=$baris['year'];?></td>
	<td><center><?=$tgl_update;?></center></td>
	 <td><?=$baris['nama_cabang'];?></td>
	 <td><?=$baris['npp'];?></td>
	 <?php
		if($status==3)
		{
			?>
				<td><?=$baris['keterangan'];?></td>
			<?php
		}
		else			
   ?>
  </tr>
<?
}
?>  
</table>