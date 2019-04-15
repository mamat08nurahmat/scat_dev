<?php
session_start();
$masuk=$_SESSION['username'];
$level=$_SESSION['user_level'];
$penyelia=$_SESSION['id_user_atasan'];
include "include/config.php";
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=leads_expired.xls");
$i = 1;

if($level==1||$level==2)
{
	$sql=mssql_query("select * from( SELECT id,ROW_NUMBER() OVER (ORDER BY id) AS ROWNUM,id_cabang,nama_prospek,produk,nominal_pengajuan,tgl_input,tgl_exp,ket FROM leads where is_expired=1 and ket=7 ) AS a 
									LEFT JOIN (SELECT KODE_cabang,ID_AREA,nama_cabang FROM CABANG WHERE tipe_cabang = 'KCU') c on a.id_cabang=c.kode_cabang 
									LEFT JOIN area d on c.id_area=d.id_area ");
				
}
elseif($level==6||$level==7||$level==8||$level==9||$level==10||$level==11||$level==12)
{
	$sql=mssql_query("select * from( SELECT id,ROW_NUMBER() OVER (ORDER BY id) AS ROWNUM,id_cabang,nama_prospek,produk,nominal_pengajuan,tgl_input,tgl_exp,ket FROM leads where is_expired=1 and ket=7 and id_cabang='$_SESSION[id_cabang]') AS a 
									LEFT JOIN (SELECT KODE_cabang,ID_AREA,nama_cabang FROM CABANG WHERE tipe_cabang = 'KCU') c on a.id_cabang=c.kode_cabang 
									LEFT JOIN area d on c.id_area=d.id_area ");
				
}
else
{
	
}

?>

<table width="663" border="0">
  <tr>
   <td colspan="6" style="background:#f5f5f5;text-align:center;">
   <span style="font-size:16px;">
   <strong>LEADS MART EXPIRED SALES COMPANY <br> PT. Bank Negara Indonesia </strong>
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
	<th><center>NAMA PROSPEK</center></th>
	<th><center>PRODUK</center></th>
	<th><center>NOMINAL PENGAJUAN</center></th>
	<th><center>TANGGAL INPUT</center></th>
	<th><center>TANGGAL EXPIRED</center></th>
</tr>
<?php
while($data=mssql_fetch_array($sql))
{
	$tgl1 = date('m-d-Y',strtotime($data['tgl_input']));
	$tgl2 = date('m-d-Y',strtotime($data['tgl_exp']));
?>
		<tr>
			<td><font color='black'><?php echo $i;?></font></td>
			<td><font color='black'><?php echo $data['nama_cabang']; ?></font></td>
			<td><font color='black'><?php echo $data['npp']; ?></font></td>
			<td><font color='black'><?php echo $data['nama_prospek']; ?></font></td>
			<td><font color='black'><?php echo $data['produk']; ?></font></td>   		
			<?php $nominal=number_format($data['nominal_pengajuan'],0,",","."); ?>
			<td><font color='black'><center><?php echo $nominal; ?></center></font></td>
			<td><font color='black'><center><?php echo $tgl1; ?></center></font></td>
			<td><font color='black'><center><?php echo $tgl2; ?></center></font></td>
		</tr>	
<?php
 $i++;
}
?>  
</table>
