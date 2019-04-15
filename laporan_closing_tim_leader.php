<?php
session_start();
$masuk=$_SESSION['username'];
$level=$_SESSION['user_level'];
$penyelia=$_SESSION['id_user_atasan'];


include "include/config.php";
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=report_tl_closing.xls");
$i = 1;
if($level==1||$level==2)
{
	$sql=mssql_query("SELECT * FROM ( SELECT id_report,ROW_NUMBER() OVER (ORDER BY nama_nasabah DESC) AS ROWNUM,nomor_pinjaman,nama_nasabah,persetujuan_pengalihan,nominal,no_perjanjian,no_rekening,no_rekening_affiliasi,angsuran,keterangan,id_cabang,ket,tgl_update,npp,perusahaan
												FROM report_tl where ket='2' and persetujuan_pengalihan='1' ) AS a  
												LEFT JOIN (SELECT KODE_cabang,ID_AREA,nama_cabang FROM CABANG WHERE tipe_cabang =  'KCU') c on a.id_cabang=c.kode_cabang LEFT JOIN area d on c.id_area=d.id_area
												");
}
elseif($level==7)
{
	$sql=mssql_query("SELECT * FROM ( SELECT id_report,ROW_NUMBER() OVER (ORDER BY nama_nasabah DESC) AS ROWNUM,nomor_pinjaman,nama_nasabah,persetujuan_pengalihan,nominal,no_perjanjian,no_rekening,no_rekening_affiliasi,angsuran,keterangan,id_cabang,ket,tgl_update,npp,perusahaan
												FROM report_tl where ket='2' and persetujuan_pengalihan='1' and id_cabang='$_SESSION[id_cabang]') AS a  
												LEFT JOIN (SELECT KODE_cabang,ID_AREA,nama_cabang FROM CABANG WHERE tipe_cabang =  'KCU') c on a.id_cabang=c.kode_cabang LEFT JOIN area d on c.id_area=d.id_area
												");
}
else
{
	
}

				
?>

<table width="663" border="0">
  <tr>
   <td colspan="13" style="background:#f5f5f5;text-align:center;">
   <span style="font-size:16px;">
   <strong>REPORT CLOSING TIM LEADER SALES COMPANY  <br> PT. Bank Negara Indonesia </strong>
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
			<!--<th><center>Keterangan<center></th>-->
			<th><center>Tanggal</center></th>
			<th><center>NPP Sales</center></th>
			<th><center>Nama Perusahaan</center></th>
	</tr>
<?php
while($data=mssql_fetch_array($sql))
{
	$tgl = date('m-d-Y',strtotime($data['tgl_update']));
			$nominal=number_format($data['nominal'],0,",",".");
			$angsuran=number_format($data['angsuran'],0,",",".");
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
	  <td><?php echo $i ?></td>
		<td><?php echo $data['nomor_pinjaman']?></td>
        <td><?php echo $data['nama_nasabah']?></td>
        <td><?php echo $data['nama_cabang']?></td>
		<td><center><?php echo $pp ?></center></td>
        <td>Rp. <?php echo  $nominal;?></td>
        <td><?php echo $data['no_perjanjian'] ?></td>
		<td><?php echo $data['no_rekening'] ?></td>
		<td><?php echo $data['no_rekening_affiliasi'] ?></td>
		<td>Rp. <?php echo  $angsuran;?></td>
		<!--<td><?php echo $data['keterangan'] ?></td>-->
		<td><?php echo $tgl ?></td>
		<td><?php echo $data['npp'] ?></td>
		<td><?php echo $perusahaan ?></td>
   </tr>	
<?php
 $i++;
}
?>  
</table>
