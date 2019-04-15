<?php
session_start();
$masuk=$_SESSION['username'];
$level=$_SESSION['user_level'];
$penyelia=$_SESSION['id_user_atasan'];
if($level==8||$level==9||$level==11)
{
	$ceknpp = "and c.npp ='$masuk'";
}
elseif($level==6)
{
	$ceknpp="and c.id_user_atasan ='$masuk'";
}
else
{
	
}

include "include/config.php";
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=pipeline.xls");
$i = 1;
	if($level==1||$level==2)
	{
		$sql=mssql_query("SELECT *  FROM pipeline_vendor where ket='1' order by tgl_input DESC ");
	}
	elseif($level==14)
	{	
		$sql=mssql_query("SELECT *  FROM pipeline_vendor where ket='1' and id_perusahaan='$_SESSION[id_perusahaan]' order by tgl_input DESC ");
	}
	elseif($level==15)
	{	
		$sql=mssql_query("SELECT *  FROM pipeline_vendor where ket='1' and nama_pemproses='$_SESSION[namauser]' order by tgl_input DESC ");
	}
	elseif($level==7)
	{	
		$sql=mssql_query("SELECT *  FROM pipeline_vendor where ket='1' and id_cabang='$_SESSION[id_cabang]' order by tgl_input DESC ");
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
   </tr>	
<?php
 $i++;
}
?>  
</table>