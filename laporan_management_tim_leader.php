<?php
session_start();
$masuk=$_SESSION['username'];
$level=$_SESSION['user_level'];
$penyelia=$_SESSION['id_user_atasan'];


include "include/config.php";
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=report_tl.xls");
$i = 1;
if($level==1||$level==2)
{
	$sql=mssql_query("
					SELECT * FROM ( SELECT id_report,ROW_NUMBER() OVER (ORDER BY nama_nasabah DESC) AS ROWNUM,nomor_pinjaman,no_rekening_affiliasi,nama_nasabah,persetujuan_pengalihan,nominal,no_perjanjian,no_rekening,keterangan,id_cabang,ket,tgl_input
												FROM report_tl where ket='1' and persetujuan_pengalihan is null) AS a  
												LEFT JOIN (SELECT KODE_cabang,ID_AREA,nama_cabang FROM CABANG WHERE tipe_cabang =  'KCU') c on a.id_cabang=c.kode_cabang LEFT JOIN area d on c.id_area=d.id_area
												");
}
elseif($level==7)
{
	$sql=mssql_query("
					SELECT * FROM ( SELECT id_report,ROW_NUMBER() OVER (ORDER BY nama_nasabah DESC) AS ROWNUM,nomor_pinjaman,nama_nasabah,no_rekening_affiliasi,persetujuan_pengalihan,nominal,no_perjanjian,no_rekening,keterangan,id_cabang,ket,tgl_input
												FROM report_tl where ket='1' and persetujuan_pengalihan is null and id_cabang='$_SESSION[id_cabang]') AS a  
												LEFT JOIN (SELECT KODE_cabang,ID_AREA,nama_cabang FROM CABANG WHERE tipe_cabang =  'KCU') c on a.id_cabang=c.kode_cabang LEFT JOIN area d on c.id_area=d.id_area
												");
}
else
{
	
}

				
				?>

<table width="663" border="0">
  <tr>
   <td colspan="6" style="background:#f5f5f5;text-align:center;">
   <span style="font-size:16px;">
   <strong>REPORT STORE TIM LEADER SALES COMPANY  <br> PT. Bank Negara Indonesia </strong>
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
			<th><center>No Pinjaman</center></th>
			<th><center>No Rekening Affiliasi</center></th>
			<th><center>Nama Nasabah</center></th>
			<th><center>Nama Cabang</center></th>
			<!--<th><center>Persetujuan Pengalihan Mutasi Bayar dan Pinjaman</center></th>
			<th><center>Nominal Kredit</center></th>
			<th><center>No Perjanjian Kredit</center></th>
			<th><center>No Rekening Pinjaman</center></th>
			<th><center>Keterangan<center></th>-->
			<th><center>Tanggal</center></th>
			<!--<th style="width:35px;"><center>AKSI</center></th>-->
  </tr>
<?php
while($data=mssql_fetch_array($sql))
{
	$tgl = date('m/d/Y',strtotime($data['tgl_input']));
			if($data['persetujuan_pengalihan']==1) {
                $pp = "Ya";	
            }
			elseif($data['persetujuan_pengalihan']==2) {
                $pp = "Tidak";
            }
?>
	<tr>
		<td><?php echo $i ?></td>
		<td><?php echo $data['nomor_pinjaman'] ?></td>
		<td><?php echo $data['no_rekening_affiliasi'] ?></td>
        <td><?php echo $data['nama_nasabah']?></td>
        <td><?php echo $data['nama_cabang']?></td>
		<!--<td><center><?php echo $pp ?></center></td>
        <td><?php echo $data['nominal'] ?></td>
        <td><?php echo $data['no_perjanjian'] ?></td>
		<td><?php echo $data['no_rekening'] ?></td>
		<td><?php echo $data['keterangan'] ?></td>-->
		<td><?php echo $tgl ?></td>
   </tr>	
<?php
 $i++;
}
?>  
</table>
