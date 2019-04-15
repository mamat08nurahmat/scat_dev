<?php
session_start();
include ('excel_reader2.php');
include('include/config.php');

$data 	  		= new Spreadsheet_Excel_Reader($_FILES['fileexcel']['tmp_name']);
$hasildata 		= $data->rowcount($sheet_index=0);

for ($i=1; $i<=$hasildata; $i++)
{
	$nomor_pinjaman			= $data->val($i,2);
	$nama_nasabah			= $data->val($i,3);
	$cabang					= $data->val($i,4);
	$cabang_padanan_bukopin	= $data->val($i,5); 
	$plafond_awal			= $data->val($i,6); 
	$os_juni_2018			= $data->val($i,7);
	$tgl_akad				= $data->val($i,8);
	$tgl_jatuh_tempo		= $data->val($i,9);
	$suku_bunga				= $data->val($i,10);
	$coll_25_juni_2018		= $data->val($i,11);
	$rekening_bayar			= $data->val($i,12);
	$tgl_lahir				= $data->val($i,13);	
	$produk					= $data->val($i,14);	
	$notas					= $data->val($i,15);	
	$pengelola				= $data->val($i,16);
	$no_ktp					= $data->val($i,17);
	$npwp					= $data->val($i,18);
	$gaji					= $data->val($i,19);
	$alamat_1				= $data->val($i,20);
	$alamat_2				= $data->val($i,21);
	$alamat_3				= $data->val($i,22);
	$alamat_4				= $data->val($i,23);
	$jenis_kelamin			= $data->val($i,24);
	$jenis_pensiun			= $data->val($i,25);
	$bank					= $data->val($i,26);
	$id_cabang	 			= $data->val($i,27);
	
 $query = "insert into temp_report_tl(
		nomor_pinjaman
		,nama_nasabah
		,cabang
		,cabang_padanan_bukopin
		,plafond_awal
		,os_juni_2018
		,tgl_akad
		,tgl_jatuh_tempo
		,suku_bunga
		,coll_25_juni_2018
		,rekening_bayar
        ,tgl_lahir
		,produk
		,notas
		,pengelola
		,no_ktp
		,npwp
		,gaji
		,alamat_1
		,alamat_2
		,alamat_3
		,alamat_4
		,jenis_kelamin
		,jenis_pensiun
		,bank
		,id_cabang
		,ket
		,tgl_input
		,nama_pemproses)
		values(
		'$nomor_pinjaman'
		,'$nama_nasabah'
		,'$cabang'
		,'$cabang_padanan_bukopin'
		,'$plafond_awal'
		,'$os_juni_2018'
		,'$tgl_akad'
		,'$tgl_jatuh_tempo'
		,'$suku_bunga'
		,'$coll_25_juni_2018'
		,'$rekening_bayar'
		,'$tgl_lahir'
		,'$produk'
		,'$notas'
		,'$pengelola'
		,'$no_ktp'
		,'$npwp'
		,'$gaji'
		,'$alamat_1'
		,'$alamat_2'
		,'$alamat_3'
		,'$alamat_4'
		,'$jenis_kelamin'
		,'$jenis_pensiun'
		,'$bank'
		,'$id_cabang'
		,'1'
		,SYSDATETIME() 
		,'$_SESSION[namauser]')";
		
$query1="merge report_tl a using (select * from temp_report_tl)b on (a.nomor_pinjaman=b.nomor_pinjaman) when matched then update set a.id_cabang = b.id_cabang,a.cabang = b.cabang
		when not matched then insert (
		nomor_pinjaman
		,nama_nasabah
		,cabang
		,cabang_padanan_bukopin
		,plafond_awal
		,os_juni_2018
		,tgl_akad
		,tgl_jatuh_tempo
		,suku_bunga
		,coll_25_juni_2018
		,rekening_bayar
        ,tgl_lahir
		,produk
		,notas
		,pengelola
		,no_ktp
		,npwp
		,gaji
		,alamat_1
		,alamat_2
		,alamat_3
		,alamat_4
		,jenis_kelamin
		,jenis_pensiun
		,bank
		,id_cabang
		,ket
		,tgl_input
		,nama_pemproses)
values(  b.nomor_pinjaman
		,b.nama_nasabah
		,b.cabang
		,b.cabang_padanan_bukopin
		,b.plafond_awal
		,b.os_juni_2018
		,b.tgl_akad
		,b.tgl_jatuh_tempo
		,b.suku_bunga
		,b.coll_25_juni_2018
		,b.rekening_bayar
        ,b.tgl_lahir
		,b.produk
		,b.notas
		,b.pengelola
		,b.no_ktp
		,b.npwp
		,b.gaji
		,b.alamat_1
		,b.alamat_2
		,b.alamat_3
		,b.alamat_4
		,b.jenis_kelamin
		,b.jenis_pensiun
		,b.bank
		,b.id_cabang
		,b.ket
		,b.tgl_input
		,b.nama_pemproses
		);";
 $query2="delete from  temp_report_tl";
//print_r($data);die();  
 $hasil=mssql_query($query);

}
	if($hasil)
	{
		mssql_query($query1);
		mssql_query($query2);
	?>
		<script> alert('DATA BERHASIL DIUPLOAD');
					   window.location.replace('index.php?page=31a');
			</script>
	<?php
}
else
{
	//mssql_query($query2);
echo " DATA GAGAL DIUPLOAD ". mssql_get_last_message();
}
?>
