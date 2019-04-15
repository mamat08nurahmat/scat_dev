<?php
session_start();
$masuk=$_SESSION['username'];
$level=$_SESSION['user_level'];
$penyelia=$_SESSION['id_user_atasan'];
include "include/config.php";
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=leads_report_succes.xls");
$i = 1;
if($level==1||$level==2)
{
	$sql=mssql_query("SELECT * FROM ( SELECT id,ROW_NUMBER() OVER (ORDER BY id) AS ROWNUM,npp,id_cabang,nama_nasabah,produk,nominal_pengajuan,no_aplikasi,no_rekening,tgl_update,ket FROM cart where ket=8 ) AS a 
													LEFT JOIN (SELECT KODE_cabang,ID_AREA,nama_cabang FROM CABANG WHERE tipe_cabang = 'KCU') c on a.id_cabang=c.kode_cabang 
													LEFT JOIN area d on c.id_area=d.id_area
					");
}
elseif($level==6||$level==7||$level==8||$level==9||$level==10||$level==11||$level==12)
{
	$sql=mssql_query("SELECT * FROM ( SELECT id,ROW_NUMBER() OVER (ORDER BY id) AS ROWNUM,npp,id_cabang,nama_nasabah,produk,nominal_pengajuan,no_aplikasi,no_rekening,tgl_update,ket FROM cart where ket=8 and id_cabang='$_SESSION[id_cabang]' ) AS a 
												LEFT JOIN (SELECT KODE_cabang,ID_AREA,nama_cabang FROM CABANG WHERE tipe_cabang = 'KCU') c on a.id_cabang=c.kode_cabang 
												LEFT JOIN area d on c.id_area=d.id_area
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
   <strong>LEADS MART CART SALES COMPANY <br> PT. Bank Negara Indonesia </strong>
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
	<td width="87%" align="center">&nbsp;</td>
  </tr>
</table>

<table width="663" border="1">
 <tr style='background:#7CFC00'>	
	<th><center>NO</center></th>
	<th><center>CABANG</center></th>
	<th><center>NPP</center></th>
	<th><center>NAMA NASABAH</center></th>
	<th><center>PRODUK</center></th>
	<th><center>NOMINAL PENGAJUAN</center></th>
	<th><center>NOMOR APLIKASI</center></th>
	<th><center>NOMOR REKENING PINJAMAN</center></th>
	<th><center>TANGGAL UPDATE</center></th>
</tr>
<?php
while($data=mssql_fetch_array($sql))
{
	$tgl = date('m-d-Y',strtotime($data['tgl_update']));
?>
		<tr>
			<td><font color='black'><?php echo $i;?></font></td>
			<td><font color='black'><?php echo $data['nama_cabang']; ?></font></td>
			<td><font color='black'><?php echo $data['npp']; ?></font></td>
			<td><font color='black'><?php echo $data['nama_nasabah']; ?></font></td>
			<td><font color='black'><?php echo $data['produk']; ?></font></td>   		
			<?php $nominal=number_format($data['nominal_pengajuan'],0,",","."); ?>
			<td><font color='black'><center><?php echo $nominal; ?></center></font></td>
			<td><font color='black'><?php echo $data['no_aplikasi']; ?></font></td>  
			<td><font color='black'><?php echo $data['no_rekening']; ?></font></td>  
			<td><font color='black'><?php echo $tgl; ?></font></td>  
		</tr>	
<?php
 $i++;
}
?>  
</table>
