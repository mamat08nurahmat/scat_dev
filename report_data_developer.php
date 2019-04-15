<?php
session_start();
include "include/config.php";
$status_developer	=$_GET['status_developer'];
$month				=$_GET['month'];
$year				=$_GET['year'];
$masuk				=$_SESSION['username'];
$npp				=$_SESSION['npp'];
$cbg				=$_SESSION['id_cabang'];
$are				=$_SESSION['id_area'];
$vdr				=$_SESSION['id_vendor'];
$level				=$_SESSION['user_level'];

if($status_developer==0)
{
	$where="";
}
elseif($status_developer==1||$status_developer==2)
{
	$where ="and p.status_developer='$status_developer'";
}

$sql=mssql_query(" SELECT 
					p.id_developer,
					p.npp,
					p.nama_sales,
					p.nama_developer,
					p.project_developer,
					p.alamat_developer,
					p.id_cabang,
					c.nama_cabang,
					p.jml_unit,
					p.sisa_unit,
					p.tanggal_mulai,
					p.status_developer,
					p.tanggal_berakhir,
					p.keterangan,
					convert(varchar(20), 
					p.tanggal_mulai,105) as tanggal, 
					MONTH(p.tanggal_mulai) as bulan,
					YEAR(p.tanggal_mulai) as tahun 
					FROM data_developer p
					LEFT JOIN (SELECT KODE_cabang,ID_AREA,nama_cabang FROM CABANG WHERE tipe_cabang = 'KCU') c on p.id_cabang=c.kode_cabang 
					WHERE MONTH(p.tanggal_mulai)='$month' and YEAR(p.tanggal_mulai)='$year' $where order by tanggal_mulai ASC
					");
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=data_developer"._.$month._.$year.".xls");




?>				

<table width="663" border="0">
  <tr>
   <td colspan="12" ><center><span style="font-size:16px;" ><strong>DATA DEVELOPER SALES COMPANY<br> PT. Bank Negara Indonesia </strong></span></center></td>
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
    <td width="53"><center><b>NPP</b></center></td>
    <td width="53"><center><b>Nama Sales</b></center></td>
    <td width="53"><center><b>Nama Developer</b></center></td>
    <td width="53"><center><b>Project Developer</b></center></td>
    <td width="53"><center><b>Alamat Developer</b></center></td>
    <td width="53"><center><b>Nama Cabang</b></center></td>
    <td width="53"><center><b>Jumlah Unit</b></center></td>
    <td width="151"><center><b>Sisa Unit</b></center></td>
	<td width="133"><center><b>Tanggal Mulai</b></center></td>	
	<td width="133"><center><b>Status Developer</b></center></td>	
	<?php
		if($status_developer==2)
		{
			?>
				<td width="133"><center><b>Tanggal Berakhir </b></center></td>
				<td width="133"><center><b>Keterangan</b></center></td>
			<?php
		}
		else
	?>
  </tr>

  
<?php
 $i++;
while($baris=mssql_fetch_array($sql))
{ 
	if($baris['status_developer']==2) {
		$status = "NON AKTIF";		
    }
	elseif($baris['status_developer']==1) {
        $status = "AKTIF";
    }
	
	$tanggal = date('d/m/Y', strtotime($baris['tanggal_mulai']));
	$tgl = date('d/m/Y', strtotime($baris['tanggal_berakhir']));
?>
  <tr>
	<td><?php echo $i++ ?></td>
    <td><?=$baris['npp'];?></td>
    <td><?=$baris['nama_sales'];?></td>
    <td><?=$baris['nama_developer'];?></td>
    <td><?=$baris['project_developer'];?></td>
    <td><?=$baris['alamat_developer'];?></td>
    <td><?=$baris['nama_cabang'];?></td>
    <td><?=$baris['jml_unit'];?></td>
    <td><?=$baris['sisa_unit'];?></td>
    <td><center><?=$tanggal?></center></td>
	 <td><center><?=$status?></center></td>
    <?php
		if($status_developer==2)
		{
			?>
				<td><center><?=$tgl?></center></td>
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