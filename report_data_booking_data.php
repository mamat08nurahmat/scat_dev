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
$perusahaan	=$_SESSION['id_perusahaan'];
$level		=$_SESSION['user_level'];
if($ket==1)
{
	$where="";
}
elseif($ket==2||$ket==3)
{
	$where ="and p.ket='$ket'";
}
include "include/config.php";
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=pipeline.xls");
$i = 1;
	if($_SESSION['user_level']==15 )
	{
	$sql=mssql_query(" SELECT 
					p.nama_pemproses,
					p.ket,
					p.id_pipeline, 
					p.no_aplikasi,
					p.nama,
					p.nominal,
					p.produk,
					b.nama_perusahaan,
					p.keterangan,
					p.nama_tl,
					p.ktp,
					p.kk,
					p.sk,
					p.buku_tabungan,
					p.rekening_koran,
					p.npwp,
					p.form_aplikasi,
					d.npp,
					c.nama_cabang, 
					p.tgl_input,
					convert(varchar(20), 
					p.tgl_input,105) as tanggal, 
					MONTH(p.tgl_input) as month,
					YEAR(p.tgl_input) as year
					FROM pipeline_vendor p
					left join perusahaan b on p.id_perusahaan=b.id_perusahaan
					left join data_booking d on p.no_aplikasi=d.no_aplikasi
					LEFT JOIN (SELECT KODE_cabang,ID_AREA,nama_cabang FROM CABANG WHERE tipe_cabang = 'KCU') c on d.id_cabang=c.kode_cabang 
					WHERE MONTH(p.tgl_input)='$month' and YEAR(p.tgl_input)='$year' $where and p.id_perusahaan='$perusahaan' and p.nama_pemproses='$_SESSION[namauser]' order by tgl_update ASC
					");
	}
	elseif($_SESSION['user_level']==1||$_SESSION['user_level']==2 )
	{
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
					p.ktp,
					p.kk,
					p.sk,
					p.buku_tabungan,
					p.rekening_koran,
					p.npwp,
					p.form_aplikasi,
					d.npp,
					d.npp,
					p.tgl_input,
					c.nama_cabang, 
					convert(varchar(20), 
					p.tgl_input,105) as tanggal, 
					MONTH(p.tgl_input) as month,
					YEAR(p.tgl_input) as year
					FROM pipeline_vendor p
					left join perusahaan b on p.id_perusahaan=b.id_perusahaan
					left join data_booking d on p.no_aplikasi=d.no_aplikasi
					LEFT JOIN (SELECT KODE_cabang,ID_AREA,nama_cabang FROM CABANG WHERE tipe_cabang = 'KCU') c on d.id_cabang=c.kode_cabang 
					WHERE MONTH(p.tgl_input)='$month' and YEAR(p.tgl_input)='$year' $where order by tgl_update ASC
					");
	}
	elseif($_SESSION['user_level']==7 )
	{

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
					p.ktp,
					p.kk,
					p.sk,
					p.buku_tabungan,
					p.rekening_koran,
					p.npwp,
					p.form_aplikasi,
					d.npp,
					d.npp,
					c.nama_cabang, 
					p.tgl_input,
					convert(varchar(20), 
					p.tgl_input,105) as tanggal, 
					MONTH(p.tgl_input) as month,
					YEAR(p.tgl_input) as year
					FROM pipeline_vendor p
					left join perusahaan b on p.id_perusahaan=b.id_perusahaan
					left join data_booking d on p.no_aplikasi=d.no_aplikasi
					LEFT JOIN (SELECT KODE_cabang,ID_AREA,nama_cabang FROM CABANG WHERE tipe_cabang = 'KCU') c on d.id_cabang=c.kode_cabang 
					WHERE MONTH(p.tgl_input)='$month' and YEAR(p.tgl_input)='$year' $where and id_cabang='$_SESSION[id_cabang]' order by tgl_update ASC
					");
	}
	elseif($level==14)
	{	
		$sql=mssql_query(" SELECT 
					p.ket,
					p.id_pipeline, 
					p.no_aplikasi,
					p.nama,
					p.nominal,
					p.produk,
					b.nama_perusahaan,
					p.keterangan,
					p.ktp,
					p.kk,
					p.sk,
					p.buku_tabungan,
					p.rekening_koran,
					p.npwp,
					p.form_aplikasi,
					d.npp,
					p.nama_tl,
					d.npp,
					c.nama_cabang, 
					convert(varchar(20), 
					p.tgl_input,105) as tanggal, 
					MONTH(p.tgl_input) as month,
					YEAR(p.tgl_input) as year
					FROM pipeline_vendor p
					left join perusahaan b on p.id_perusahaan=b.id_perusahaan
					left join data_booking d on p.no_aplikasi=d.no_aplikasi
					LEFT JOIN (SELECT KODE_cabang,ID_AREA,nama_cabang FROM CABANG WHERE tipe_cabang = 'KCU') c on d.id_cabang=c.kode_cabang 
					WHERE MONTH(p.tgl_input)='$month' and YEAR(p.tgl_input)='$year' $where and p.id_perusahaan='$perusahaan' order by tgl_update ASC
					");
	}		
				?>

<table width="663" border="0">
  <tr>
   <td colspan="13" style="background:#f5f5f5;text-align:center;">
   <span style="font-size:16px;">
   <strong>PIPELINE SALES COMPANY <br> PT. Bank Negara Indonesia </strong>
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
	<td width="53"><center><b>No</b></center></td>
    <td width="53"><center><b>Npp</b></center></td>
    <td width="53"><center><b>Nama</b></center></td>
    <td width="53"><center><b>Produk</b></center></td>
    <td width="53"><center><b>Nominal</b></center></td>
    <td width="53"><center><b>Copy KTP</b></center></td>
    <td width="53"><center><b>Copy KK</b></center></td>
    <td width="53"><center><b>Copy SK</b></center></td>
    <td width="53"><center><b>Copy Buku Tabungan 3 Bulan Terakhir</b></center></td>
    <td width="53"><center><b>Copy Rekening Koran Pinjaman</b></center></td>
    <td width="53"><center><b>Copy NPWP</b></center></td>
    <td width="53"><center><b>Form Aplikasi Kredit Konsumer</b></center></td>
    <td width="151"><center><b>Tanggal Input</b></center></td>
    <td width="53"><center><b>No Aplikasi</b></center></td>	
	<td width="133"><center><b>Nama Perusahaan</b></center></td>
	<td width="133"><center><b>Bulan</b></center></td>
	<td width="133"><center><b>Tahun</b></center></td>
	<td width="133"><center><b>Nama Cabang</b></center></td>
	<td width="133"><center><b>NPP</b></center></td>
	 <?php
		if($ket==3||$ket=1)
		{
			?>
				<td width="133"><center><b>Keterangan</b></center></td>
			<?php
		}
		else			
	?>	
  </tr>
<?php
while($baris=mssql_fetch_array($sql))
{
		$nominal=number_format($baris['nominal'],0,",",".");
		$tanggal = date('d/m/Y', strtotime($baris['tgl_input']));
		$status = "";
		$status_kk = "";
		$status_sk = "";
		$status_bt = "";
		$status_rk = "";
		$status_np = "";
		$status_fa = "";
	if($baris['ktp']==1) {
		$status ="a";
	} 
	if($baris['kk']==1) {
		$status_kk = "a";
	}
	if($baris['sk']==1) {
		$status_sk = "a";
	}
	if($baris['buku_tabungan']==1) {
		$status_bt = "a";
	}
	if($baris['rekening_koran']==1) {
		$status_rk = "a";
	}
	if($baris['npwp']==1) {
		$status_np = "a";
	}
	if($baris['form_aplikasi']==1) {
		$status_fa = "a";
	}
?>
  <tr>
	<td><?php echo $i ?></td>
    <td><?=$baris['npp'];?></td>
    <td><?=$baris['nama'];?></td>
    <td><?=$baris['produk'];?></td>
    <td><center><?=$nominal;?></center></td>
    <td style="font-family:Marlett;"><center><?=$status;?></center></td>
	<td style="font-family:Marlett;"><center><?=$status_kk;?></center></td>
	<td style="font-family:Marlett;"><center><?=$status_sk;?></center></td>
	<td style="font-family:Marlett;"><center><?=$status_bt;?></center></td>
	<td style="font-family:Marlett;"><center><?=$status_rk;?></center></td>
	<td style="font-family:Marlett;"><center><?=$status_np;?></center></td>
	<td style="font-family:Marlett;"><center><?=$status_fa;?></center></td>
    <td><center><?=$tanggal;?></center></td>
    <td>'<?=$baris['no_aplikasi'];?></td>
	<td><?=$baris['nama_perusahaan'];?></td>
    <td><?=$baris['month'];?></td>
    <td><?=$baris['year'];?></td>
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
<?php
 $i++;
}
?>  
</table>