<?php
session_start();
include "include/config.php";
$tgl_awal	=$_GET['tgl_awal'];
//$jam_awal	=date("Y-m-d h:i:sa")
$tgl_akhir	=$_GET['tgl_akhir'];
$masuk		=$_SESSION['username'];
$npp		=$_SESSION['npp'];
$cbg		=$_SESSION['id_cabang'];
$are		=$_SESSION['id_area'];
$perusahaan	=$_SESSION['id_perusahaan'];
$level		=$_SESSION['user_level'];


$sql=mssql_query(" SELECT 
					p.tgl_update,
					p.nomor_pinjaman,
					p.nama_nasabah,
					p.persetujuan_pengalihan, 
					p.nominal,
					p.no_perjanjian,
					p.no_rekening,
					p.no_rekening_affiliasi,
					p.angsuran,
					p.keterangan,
					p.ket,
					p.tgl_input,
					p.nama_pemproses,
					c.nama_cabang,
					p.npp,
					convert(varchar(20), 
					p.tgl_update,105) as tanggal,
					p.perusahaan
					FROM report_tl p
					LEFT JOIN (SELECT KODE_cabang,ID_AREA,nama_cabang FROM CABANG WHERE tipe_cabang = 'KCU') c on p.id_cabang=c.kode_cabang 
					WHERE  p.ket='2' and p.tgl_update BETWEEN '$tgl_awal 17:00:00' AND '$tgl_akhir 16:00:00' order by tgl_update ASC
					");
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=data_laporan_tim_leader"._.$tgl_awal._.$tgl_akhir.".xls");

	
?>				

<table width="663" border="0">
  <tr>
   <td colspan="12" ><center><span style="font-size:16px;" ><strong>DATA LAPORAN TIM LEADER <?php echo $ket ?> SALES COMPANY<br> PT. Bank Negara Indonesia </strong></span></center></td>
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
	<th><center>No</center></th>
	<th><center>Nomor Pinjaman</center></th>
	<th><center>Nama Nasabah</center></th>
	<th><center>Nama Cabang</center></th>
	<th><center>Persetujuan Pengalihan Mutasi Bayar dan Pinjaman</center></th>
	<th><center>Nominal Kredit</center></th>
	<th><center>No Perjanjian Kredit</center></th>
	<th><center>No Rekening Pinjaman</center></th>
	<th><center>No Rekening Affiliasi</center></th>
	<th><center>Angsurang ( Pokok + Bunga )</center></th>
	<th><center>Keterangan (diisi apabila Nasabah tidak setuju) <center></th>
	<th><center>Tanggal</center></th>
	<th width="53"><center><b>Jam</b></center></th>
	<th width="133"><center><b>NPP Sales</b></center></th>
	<th><center>Nama Perusahaan</center></th>
  </tr>

  
<?php
 $i++;
while($data=mssql_fetch_array($sql))
{
	$nominal=number_format($data['nominal'],0,",",".");
	$tgl = date('m-d-Y',strtotime($data['tgl_update']));
	$jam = date('H:i:s',strtotime($data['tgl_update']));
			if($data['persetujuan_pengalihan']==1) {
                $pp = "Ya";	
            }
			elseif($data['persetujuan_pengalihan']==2) {
                $pp = "Tidak";
            }
			
			if($data['perusahaan']==1) {
					$perusahaan = "BSR";	
				}elseif($data['perusahaan']==2) {
				   $perusahaan = "TAS";	
				}elseif($data['perusahaan']==3) {
				   $perusahaan = "MKSA";	
				}elseif($data['perusahaan']==4) {
				   $perusahaan = "ETS";	
				}else
				{
				   $perusahaan = "";	
				}
?>
  <tr>
		<td><?php echo $i++ ?></td>
		<td><?php echo $data['nomor_pinjaman']?></td>
        <td><?php echo $data['nama_nasabah']?></td>
        <td><?php echo $data['nama_cabang']?></td>
		<td><center><?php echo $pp ?></center></td>
        <td><?php echo $data['nominal'] ?></td>
        <td><?php echo $data['no_perjanjian'] ?></td>
		<td><?php echo $data['no_rekening'] ?></td>
		<td><?php echo $data['no_rekening_affiliasi'] ?></td>
		<td><?php echo $data['angsuran'] ?></td>
		<td><?php echo $data['keterangan'] ?></td>
		<td><?php echo $tgl ?></td>
		<td><?=$jam;?></td>
		<td><?php echo $data['npp'];?></td>
		<td><?php echo $perusahaan ?></td>
  </tr>
<?
}
?>  
</table>