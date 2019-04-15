<!DOCTYPE html>
<head>
	<meta charset="utf-8">
	<title>scat</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">
</head>
<div class="span12">
<h2>Import Data Booking BFP </h2>
</div>
	<form id="upload_booking" action="?page=7" method="post" enctype="multipart/form-data">
		<div class="form_settings">
			<div class="span12">
				<p><span>Pilih File  *xls</span><span>&nbsp;</span><input  type="file" name="fileexcel"  /></p>
			</div><br>
			<div class="span12">
				<p><span>&nbsp;</span><span>&nbsp;</span><input class="submit" type="submit" name="upload" value="Import" /></p>
			</div>
		</div>
	</form>
		<div class="pull-right">
			<td><a href="uploads/data_booking.xls" class="btn " download>Download Template Upload Excel</a></td><p></p>
		</div>


<?php
session_start();
include ('excel_reader2.php');
include('include/config.php');

$data = new Spreadsheet_Excel_Reader($_FILES['fileexcel']['tmp_name']);
$hasildata = $data->rowcount($sheet_index=0);

for ($i=1; $i<=$hasildata; $i++)
{
  
  $noaplikasi 		= $data->val($i,1); 
  $namanasabah 		= $data->val($i,2); 
  $tanggalbooking 	= $data->val($i,3);
  $namaproduk		= $data->val($i,4);
  $nominal			= $data->val($i,5);
  $npp 				= $data->val($i,6);
  $idcabang 		= $data->val($i,7);
  $idproduk 		= $data->val($i,8);
  $bulan 			= $data->val($i,9);
  $tahun 			= $data->val($i,10);
  

 
 $query = "insert into temp_data_booking (no_aplikasi,nama_nasabah,tanggal_booking,nama_produk,nominal,npp,id_cabang,id_produk,bulan,tahun,nama_pemproses)
			values('$noaplikasi','$namanasabah','$tanggalbooking','$namaproduk','$nominal','$npp','$idcabang','$idproduk','$bulan','$tahun','$_SESSION[namauser]')";
		
$query1="merge data_booking a using (select * from temp_data_booking)b on (a.no_aplikasi = b.no_aplikasi and a.bulan=b.bulan and a.tahun=b.tahun) when matched then update set a.id_cabang = b.id_cabang,a.nominal= b.nominal
		 when not matched then insert (no_aplikasi,nama_nasabah,tanggal_booking,nama_produk,nominal,npp,id_cabang,id_produk,bulan,tahun,nama_pemproses)
		 values
		 (b.no_aplikasi,b.nama_nasabah,b.tanggal_booking,b.nama_produk,b.nominal,b.npp,b.id_cabang,b.id_produk,b.bulan,b.tahun,b.nama_pemproses);";
 $query2="delete from  temp_data_booking";
  
 $hasil=mssql_query($query);

}
	if($hasil)
	{
		mssql_query($query1);
		mssql_query($query2);
	?>
		<script>alert("DATA BERHASIL DIUPLOAD")</script>
	<?php
}
else
{
	mssql_query($query2);
	//echo " DATA GAGAL DIUPLOAD ". mssql_get_last_message();
}
?>
