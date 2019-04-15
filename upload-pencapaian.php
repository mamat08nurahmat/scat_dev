<head>
	<title>Script Import File Excel</title>
 <!--   <link rel="stylesheet" type="text/css/css" href="style.css"> -->
</head>
<div class="span12">
<h2>Import Data Realisasi </h2>
</div>
<br>
<form id="upload-pencapaian" action="?page=6" method="post" enctype="multipart/form-data">
			  <div class="form_settings">
				<div class="span12">
				<p><span>Pilih File</span><span>&nbsp;</span><input  type="file" name="fileexcel"  /></p>
				</div>
				<br>
				<div class="span12">
				<p><span>&nbsp;</span><span>&nbsp;</span><input class="submit" type="submit" name="upload" value="Import" /></p>
				</div>
				</div>
			</form>

<?php
include ('excel_reader2.php');
include('include/config.php');

// file yang tadinya di upload, di simpan di temporary file PHP, file tersebut yang kita ambil
// dan baca dengan PHP Excel Class
$data = new Spreadsheet_Excel_Reader($_FILES['fileexcel']['tmp_name']);
$hasildata = $data->rowcount($sheet_index=0);



for ($i=1; $i<=$hasildata; $i++)
{
  
  $noaplikasi = $data->val($i,1); 
  $namanasabah = $data->val($i,2); 
  $tanggalbooking = $data->val($i,3);
  $namaproduk = $data->val($i,4);
  $nominal = $data->val($i,5);
  $npp = $data->val($i,6);
  $idproduk = $data->val($i,7);
  $bulan = $data->val($i,8);
  $tahun = $data->val($i,9);
 
 $query = "insert into temp_lending (no_aplikasi,nama_nasabah,tanggal_booking,nama_produk,nominal,npp,id_produk,bulan,tahun)
			values('$noaplikasi','$namanasabah','$tanggalbooking','$namaproduk','$nominal','$npp','$idproduk','$bulan','$tahun')";
		
$query1="merge lending a using (select * from temp_lending)b on (a.no_aplikasi = b.no_aplikasi and a.bulan=b.bulan and a.tahun=b.tahun) when matched then update set a.id_produk = b.id_produk,a.nominal = b.nominal
		 when not matched then insert (no_aplikasi,nama_nasabah,tanggal_booking,nama_produk,nominal,npp,id_produk,bulan,tahun)
		 values
		 (b.no_aplikasi,b.nama_nasabah,b.tanggal_booking,b.nama_produk,b.nominal,b.npp,b.id_produk,b.bulan,b.tahun);";
 $query2="delete from temp_lending";
  
 $hasil=mssql_query($query);
// echo $query;
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
//echo mssql_get_last_message();
}
?>
