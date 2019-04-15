<?php 
session_start();
include('include/config.php');
$npp_session = $_SESSION['npp'];
$sql = mssql_query ("select npp,nama,id_user_atasan from sales WHERE npp  = '$npp_session'");
$datax=mssql_fetch_array($sql);
$id_user_atasan = $datax['id_user_atasan'];
$leads 			= $_POST['pilih'];
$jumlah_dipilih = count($leads);

	if($jumlah_dipilih == 0)
	{
		 echo("LEADS GAGAL DIPILIH".mssql_get_last_message());
	}
	else
	{
        for($x=0; $x < $jumlah_dipilih; $x++)
        {
            $var1=$leads[$x];
            $table = "update leads set ket='2',npp='$_SESSION[npp]',nama_sales='$_SESSION[namauser]',nama_user='$_SESSION[namauser]',id_user_atasan='$datax[id_user_atasan]' WHERE id='$var1' and npp is null";	
            mssql_query($table);
			$table2 = "INSERT INTO cart(id,id_user_atasan,npp,nama_sales,nama_nasabah,alamat,no_telp,produk,
						nominal_pengajuan,id_cabang,alamat_perusahaan,sumber_data,ket,tgl_input,is_expired,is_assign  )
						SELECT id,$datax[id_user_atasan] id_user_atasan,$_SESSION[npp] npp,nama_sales,nama_prospek,alamat,no_telp,produk,nominal_pengajuan,id_cabang,
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
	
?>