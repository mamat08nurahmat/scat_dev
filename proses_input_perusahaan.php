<?php 
session_start();
include('include/config.php');
$perusahaan		= $_POST['nama_perusahaan'];
$leads 			= $_POST['pilih'];
$jumlah_dipilih = count($leads);

	
        for($x=0; $x < $jumlah_dipilih; $x++)
        {
            $var1=$leads[$x];
            $table = "update data_booking set nama_perusahaan='$perusahaan' WHERE id='$var1'";
			$query= mssql_query($table);			
			$table2 ="INSERT INTO history_data_booking(id,net_booking,nama_perusahaan,nama_pemproses,tgl_update)
						SELECT id,net_booking,nama_perusahaan,nama_pemproses,SYSDATETIME()
						FROM data_booking where id='$var1'";
			$query1= mssql_query($table2);
		}
		if($query && $query1)
		{
		 echo"<script> 
		alert('PERUSAHAAN SUKSES DIPILIH');
		window.location.replace('index.php?page=30a'); </script>";
		}
		else
		{
       echo("PERUSAHAAN GAGAL DIPILIH".mssql_get_last_message());
		}
	
?> 	