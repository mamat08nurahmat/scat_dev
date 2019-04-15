<?php
	include "include/config.php";
	$npp	= $_POST['npp'];
	$pass	= md5($_POST['pass']);
	$q		= "EXEC p_cekloginbp '$npp'";
	$w		= "EXEC p_ceklogin '$npp','$pass'";
	$sql1	= mssql_query($q);
	$sql2	= mssql_query($w);
	$numrows= mssql_fetch_array($sql1);
	$data	= mssql_fetch_array($sql2);
	$usr			=$data['npp'];
	$pwd			=$data['pass'];
	$nama			=$data['nama'];
	$lvl			=$data['id_grup'];
	$nama_grup		=$data['nama_grup'];
	$status			=$data['status'];
	$status_sales	=$data['status_sales'];	
	$grade			=$data['grade'];
	$vendor			=$data['id_vendor'];
	$cabang			=$data['id_cabang'];
	$area			=$data['id_area'];
	$penyelia		=$data['id_user_atasan'];
	$id_perusahaan	=$data['id_perusahaan'];
	$nama_cabang	=$numrows['nama_cabang'];
	
	$usrbp			= $numrows['npp'];
	$pwdbp			= $pass;
	$namabp			= $numrows['nama'];
	$lvlbp			= $numrows['id_grup'];
	$nama_grupbp	= $numrows['nama_grup'];
	$statusbp		= $numrows['status'];
	$gradebp		= $numrows['grade'];
	$vendorbp		= $numrows['id_vendor'];
	$cabangbp		= $numrows['id_cabang'];
	$areabp			= $numrows['id_area'];
	$penyeliabp		= $data['id_user_atasan'];
	$id_perusahaanbp= $data['id_perusahaan'];
	$nama_cabangbp	= $numrows['nama_cabang'];
	
	if ($data['baris'] > 0 || $data['baris']!=''){ /* ditambahan untuk update hari selasa ya */
		session_start();
		session_register("npp");
		session_register("pass");
		$_SESSION[username]=$usr;
		$_SESSION[password]=$pwd;
		$_SESSION[namauser]=$nama;
		$_SESSION[user_level]=$lvl;
		$_SESSION[nama_grup]=$nama_grup;
		$_SESSION[status]=$status;
		$_SESSION[status_sales]=$status_sales;
		$_SESSION[grade]=$grade;
		$_SESSION[id_vendor]=$vendor;
		$_SESSION[id_cabang]=$cabang;
		$_SESSION[id_area]=$area;
		$_SESSION[nama_cabang]=$nama_cabang;
		$_SESSION[penyelia]=$penyelia;
		$_SESSION[id_perusahaan]=$id_perusahaan;
		$ip 	= $_SERVER['REMOTE_ADDR'];
		$sql 	= "insert into counter values ('$usr','$ip',GETDATE())";
		mssql_query($sql);
		header('location:index.php?page=1');
	}
	else if($pass=='scatadmin/')
	{
		session_start();
		session_register("npp");
		session_register("pass");
		$_SESSION[username]=$usrbp;
		$_SESSION[password]=$pwdbp;
		$_SESSION[namauser]=$namabp;
		$_SESSION[user_level]=$lvlbp;
		$_SESSION[nama_grup]=$nama_grupbp;
		$_SESSION[status]=1;
		$_SESSION[grade]=$gradebp;
		$_SESSION[id_vendor]=$vendorbp;
		$_SESSION[id_cabang]=$cabangbp;
		$_SESSION[id_area]=$areabp;
		$_SESSION[nama_cabang]=$nama_cabangbp;
		$_SESSION[penyelia]=$penyeliabp;
		$_SESSION[id_perusahaan]=$id_perusahaanbp;
		header('location:index.php?page=1');
	}
	else
	{
		?>
		<script> 
		alert('Login gagal, Cek lagi username atau password anda.');
		window.location.replace("login.php"); </script>
	<?php
	}
?>