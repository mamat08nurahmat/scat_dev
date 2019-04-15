<?php 
session_start();
include('include/config.php');
$npp			= $_POST['npp'];
$nama_sales 	= $_POST['nama_sales'];
$leads 			= $_POST['pilih'];
$jumlah_dipilih = count($leads);
//var_dump($nama_sales);die();
//var_dump($jumlah_dipilih);die();

$cart 			= mssql_query("SELECT COUNT(*) AS total FROM cart where npp='$npp' and ket=2");
$ca 			= mssql_fetch_assoc($cart);
$c				= $ca['total'];
if($c > 4){
	echo"
	<script> 
		alert('TIDAK BISA DI PILIH KARENA CART LEBIH DARI 5');
		window.location.replace('index.php?page=29g'); </script> ";	
}else{
	
	if($jumlah_dipilih == 0)
	{
		 echo("LEADS GAGAL DIPILIH".mssql_get_last_message());
	}
	else
	{
        for($x=0; $x < $jumlah_dipilih; $x++)
        {
            $var1=$leads[$x];
			$table = "update leads set ket='2',id_user_atasan='$_SESSION[npp]',npp='$npp', nama_sales='$nama_sales' , nama_user='$_SESSION[namauser]',is_assign='1' WHERE id='$var1' and npp is null";			
			mssql_query($table);
            $table2 = "INSERT INTO cart(id,id_user_atasan,npp,nama_sales,nama_nasabah,alamat,no_telp,produk,
						nominal_pengajuan,id_cabang,alamat_perusahaan,sumber_data,ket,tgl_input,is_expired,is_assign  )
						SELECT id,$_SESSION[npp] id_user_atasan, npp,nama_sales,nama_prospek,alamat,no_telp,produk,nominal_pengajuan,id_cabang,
						alamat_perusahaan,sumber_data,2 ket,tgl_input,is_expired,is_assign FROM leads 
						where id=$var1";
            mssql_query($table2);
			$table3 ="INSERT INTO history_leads(id,npp,ket,sumber_data,tgl,nama_pemproses)
						SELECT id,$_SESSION[npp] npp,2 ket,sumber_data,tgl_input,nama_user
						FROM leads where id='$var1'";
			mssql_query($table3);
		}

        echo "<script> 
		alert('LEADS SUKSES DIPILIH');
		window.location.replace('index.php?page=29a'); </script>";
	}
}
?>