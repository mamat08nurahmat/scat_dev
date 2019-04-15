<?php
session_start();
$masuk=$_SESSION['username'];
$level=$_SESSION['user_level'];
$penyelia=$_SESSION['id_user_atasan'];
include "include/config.php";
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=sales_approve.xls");
$i = 1;
$sql=mssql_query("SELECT * FROM  (SELECT  id,ROW_NUMBER() OVER (ORDER BY id DESC) AS ROWNUM,id_grup,id_cabang,nama_lengkap,alamat,hp,ket,tgl FROM contoh  where ket='5') AS a 
				LEFT JOIN app_user_grup b on a.id_grup = b.id_grup LEFT JOIN (SELECT KODE_cabang,ID_AREA,nama_cabang FROM CABANG WHERE tipe_cabang =  'KCU') c on a.id_cabang=c.kode_cabang LEFT JOIN area d on c.id_area=d.id_area
				");
				
				?>

<table width="663" border="0">
  <tr>
   <td colspan="13" style="background:#f5f5f5;text-align:center;">
   <span style="font-size:16px;">
   <strong>APPROVE SALES COMPANY <br> PT. Bank Negara Indonesia </strong>
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
    <td width="53"><center><b>Tipe</b></center></td>
    <td width="53"><center><b>Nama Cabang</b></center></td>
    <td width="53"><center><b>Nama Lengkap</b></center></td>
    <td width="53"><center><b>Alamat</b></center></td>
    <td width="151"><center><b>No Handphone</b></center></td>
    <td width="151"><center><b>Tanggal Approve</b></center></td>
  </tr>
<?php
while($data=mssql_fetch_array($sql))
{
?>
		<tr>
			<td><font color='black'><?php echo $i;?></font></td>
			<td><font color='black'><?php echo $data['nama_grup']; ?></font></td>
			<td><font color='black'><?php echo $data['nama_cabang']; ?></font></td>
			<td><font color='black'><?php echo $data['nama_lengkap']; ?></font></td>
			<td><font color='black'><?php echo $data['alamat']; ?></font></td>
			<td><font color='black'><?php echo $data['hp']; ?></font></td>	   		
			<?php $format=date('d-m-Y',strtotime($data['tgl'])); ?>
			<td><font color='black'><center><?php echo $format; ?></center></font></td>
		</tr>	
<?php
 $i++;
}
?>  
</table>
