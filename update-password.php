<?php
	SESSION_START();
	include "include/config.php";
	$npp=$_POST['npp'];
	$pass=$_POST['pass'];
	$pass_lama=$_POST['pass_lama'];
	$ulangi_password=$_POST['pass_lagi'];
	$q="update sales set pass='$pass',status=1 where npp='$npp'";
	if($pass_lama == $_SESSION['pass'] && $pass == $ulangi_password){
	mssql_query($q);
	?>
		<script> 
		alert('Password anda sudah terupdate silahkan login kembali.');
	window.location.replace("login.php"); </script> 
	<?php }

else	{
?>
<script>
alert('Password baru dan password lama anda tidak sesuai.');
window.location.replace("ganti-password.php");
 </script>
<?
}
?>
	
