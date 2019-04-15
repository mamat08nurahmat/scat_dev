<head>
	<title>Script Import File Excel</title>
 <!--   <link rel="stylesheet" type="text/css/css" href="style.css"> -->
</head>
<div class="span12">
<h2>Import Data Leads </h2>
</div>
<br>
<form id="upload-pencapaian" action="?page=29" method="post" enctype="multipart/form-data">
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
  
  $kode_cabang = $data->val($i,1); 
  $id_area = $data->val($i,2); 
  $nama_prospek = $data->val($i,3);
  $no_telp = $data->val($i,4);
  $alamat = $data->val($i,5);
  $produk = $data->val($i,6);
  $status = $data->val($i,7);
  $bulan = $data->val($i,8);
  $tahun = $data->val($i,9);
 
 $query = "insert into leads (kode_cabang,id_area,nama_prospek,no_telp,alamat,produk,status,bulan,tahun)
			values('$kode_cabang',' $id_area','$nama_prospek','$no_telp','$alamat','$produk','$status','$bulan','$tahun')";

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
