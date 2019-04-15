<?php
session_start();
include('include/config.php');

	// deklarasikan variabel
	$npp			= $_POST['npp'];
	$grade			= $_POST['grade'];
	$year			= $_POST['year'];
	$month			= $_POST['month'];
	$tanggal_update	= $_POST['tanggal_update'];
	$keterangan 	= $_POST['keterangan'];
				
			$grade2= mssql_query("UPDATE performances SET 
								grade			= '$grade'
								WHERE npp='$npp' and year='$year' and month='$month'
								");
			
			$grade1= mssql_query("INSERT INTO history_grade(npp,grade,keterangan,tgl_update,month,year,nama_pemproses)
			VALUES('$npp','$grade','$keterangan',SYSDATETIME(),'$month','$year','$_SESSION[namauser]')");
		
			
			$grade = mssql_query("UPDATE sales SET 
			grade			= '$grade',
			keterangan 		= '$keterangan'
			WHERE npp ='$npp'
			");
	
			
			 
			if($grade && $grade1 && $grade2 ){
			echo" <script> 
				alert('DATA SUKSES DIUPDATE');
				window.location.replace('index.php?page=34');
				</script>";	
			} else{
				
			echo " DATA GAGAL DIUPDATE ".mssql_get_last_message();
				}
			
?>
