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
$sql=mssql_query("select * from
					(
					SELECT 
					a.npp,
					c.nama,
					c.id_user_atasan,
					d.nama_cabang,
					e.kode_area,
					upper (a.nama_prospek) as nama_prospek,
					upper (a.periode) as periode,
					a.no_telp,
					b.product_name,
					a.nominal,
					upper (a.developer) as developer,
					upper (a.keterangan) as keterangan,
					convert(varchar(20), 
					a.tgl_input,105) as tanggal, 
					MONTH(a.tgl_input) as month,
					YEAR(a.tgl_input) as year
									FROM pipeline a left join product b on a.produk = b.productID 
									left join sales c on a.npp = c.npp 
									left join cabang d on c.id_cabang = d.kode_cabang 
									left join area e on d.id_area = e.id_area
									WHERE 
									c.id_grup in (6,8,9,11) and d.tipe_cabang='KCU' ".$ceknpp."
					)p
					WHERE p.month=MONTH(getdate()) and p.year=YEAR(getdate()) order by p.tanggal DESC");
				
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
    <td width="53"><center><b>Npp</b></center></td>
    <td width="53"><center><b>Nama Sales</b></center></td>
    <td width="53"><center><b>Cabang</b></center></td>
    <td width="53"><center><b>Wilayah</b></center></td>
    <td width="151"><center><b>Nama Prospek</b></center></td>
    <td width="146"><center><b>Periode</b></center></td>
	<td width="133"><center><b>Telp</b></center></td>
	<td width="133"><center><b>Produk</b></center></td>
	<td width="133"><center><b>Nominal</b></center></td>
    <td width="146"><center><b>Developer</b></center></td>
    <td width="146"><center><b>Keterangan</b></center></td>
    <td width="146"><center><b>Tanggal</b></center></td>
  </tr>
<?php
while($baris=mssql_fetch_array($sql))
{
?>
  <tr>
	<td><?php echo $i ?></td>
    <td><?=$baris['npp'];?></td>
    <td><?=$baris['nama'];?></td>
    <td><?=$baris['nama_cabang'];?></td>
    <td><?=$baris['kode_area'];?></td>
    <td><?=$baris['nama_prospek'];?></td>
    <td><?=$baris['periode'];?></td>
    <td><?=$baris['no_telp'];?></td>
    <td><?=$baris['product_name'];?></td>
    <td><?=$baris['nominal'];?></td>
    <td><?=$baris['developer'];?></td>
    <td><?=$baris['keterangan'];?></td>
    <td><?=$baris['tanggal'];?></td>
	
<?php
 $i++;
}
?>  
</table>
