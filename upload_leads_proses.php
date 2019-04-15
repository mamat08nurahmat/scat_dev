<?php
session_start();
include ('excel_reader2.php');
include('include/config.php');

$id				= $_POST['id'];
$ket			= $_POST['ket'];
$sumber_data	= $_POST['sumber_data'];
$tgl_input 		= date('d M Y H:i');
$upload			= mssql_query("select max(upload) upload from leads");
$datax			= mssql_fetch_assoc($upload);
$uploads	    = $datax['upload'] + 1;
$data 	  		= new Spreadsheet_Excel_Reader($_FILES['fileexcel']['tmp_name']);
$hasildata 		= $data->rowcount($sheet_index=0);
$nama_user		= $_SESSION['namauser'];

for ($i=2; $i<=$hasildata; $i++)
{
  $nama_prospek			= $data->val($i,1);
  $alamat 				= $data->val($i,2);
  $no_telp 				= $data->val($i,3);
  $produk 				= $data->val($i,4);
  $nominal_pengajuan 	= $data->val($i,5);
  $id_cabang 			= $data->val($i,6);
  $alamat_perusahaan	= $data->val($i,7);

$query = "insert into temp_leads(nama_prospek,alamat,no_telp,produk,nominal_pengajuan,id_cabang,alamat_perusahaan,sumber_data,ket,tgl_input,is_expired,upload,nama_pemproses)
			values('$nama_prospek','$alamat','$no_telp','$produk','$nominal_pengajuan','$id_cabang','$alamat_perusahaan','upload','1', SYSDATETIME(),NULL,'$uploads','$_SESSION[namauser]')";
$hasil=mssql_query($query);
 
$query1="merge leads a using (
		select * from temp_leads)b on (a.nama_prospek = b.nama_prospek and a.no_telp=b.no_telp) when matched then update set a.id_cabang = b.id_cabang,a.ket=b.ket,a.is_expired=b.is_expired,a.tgl_input=b.tgl_input
		when not matched then insert 
		(nama_prospek,alamat,no_telp,produk,nominal_pengajuan,id_cabang,alamat_perusahaan,sumber_data,ket,tgl_input,upload,nama_pemproses)
		values(b.nama_prospek,b.alamat,b.no_telp,b.produk,b.nominal_pengajuan,b.id_cabang,b.alamat_perusahaan,b.sumber_data,b.ket,b.tgl_input,b.upload,b.nama_pemproses);";
$query2="delete from  temp_leads_baru";
}
$order = mssql_query("merge history_leads a using (select * from leads)b on (a.id = b.id and a.ket=b.ket and convert(varchar(20),a.tgl,105)=convert(varchar(20),b.tgl_input,105) ) when matched then update set a.tgl = b.tgl_input
		when not matched then insert (id,ket,tgl,sumber_data,nama_pemproses)
		values(b.id,b.ket,b.tgl_input,b.sumber_data,b.nama_pemproses);");
						
	if($hasil && $order)
	{
		mssql_query($query1);
		mssql_query($query2);
	?>
		<script> alert('DATA BERHASIL DIUPLOAD');
					   window.location.replace('index.php?page=29a');
			</script>
	<?php
}
else
{
echo " DATA GAGAL DIUPLOAD ". mssql_get_last_message();
}
?>