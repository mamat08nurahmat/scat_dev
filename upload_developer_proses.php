<?php
session_start();
include ('excel_reader2.php');
include('include/config.php');

$data = new Spreadsheet_Excel_Reader($_FILES['fileexcel']['tmp_name']);
$hasildata = $data->rowcount($sheet_index=0);

for ($i=1; $i<=$hasildata; $i++)
{
  
  $nama_perusahaan	= $data->val($i,1); 
  $alamat	 		= $data->val($i,2); 
  $kota			 	= $data->val($i,3);
  $kodepos			= $data->val($i,4);
  $no_telp 			= $data->val($i,5);
  $idproduk 		= $data->val($i,6);
 
 $query = "insert into temp_data_developer(nama_perusahaan,alamat,id_area,kodepos,no_telp,id_produk,tgl_input,nama_pemproses)
			values('$nama_perusahaan','$alamat','$kota','$kodepos','$no_telp','$idproduk',SYSDATETIME(),'$_SESSION[namauser]')";
		
$query1="merge data_developer a using (select * from temp_data_developer)b on (a.nama_perusahaan = b.nama_perusahaan and a.alamat=b.alamat) when matched then update set a.no_telp = b.no_telp
when not matched then insert (nama_perusahaan,alamat,id_area,kodepos,no_telp,id_produk,tgl_input,nama_pemproses)
values(b.nama_perusahaan,b.alamat,b.id_area,b.kodepos,b.no_telp,b.id_produk,b.tgl_input,b.nama_pemproses);";
 $query2="delete from  temp_data_developer";
  
 $hasil=mssql_query($query);

}
	if($hasil)
	{
		mssql_query($query1);
		mssql_query($query2);
	?>
		<script> alert('DATA BERHASIL DIUPLOAD');
					   window.location.replace('index.php?page=8');
			</script>
	<?php
}
else
{
	//mssql_query($query2);
echo " DATA GAGAL DIUPLOAD ". mssql_get_last_message();
}
?>
