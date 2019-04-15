<?php
session_start();
include('include/config.php');
$kd_npp = $_POST['id'];
$level=$_SESSION['user_level'];
if($_SESSION['user_level']==8||$_SESSION['user_level']==9||$_SESSION['user_level']==11||$_SESSION['user_level']==12)
	{
	$tombol='';
	$tombol .='<a href="#dialog-developer" id="0" class="btn tambah" data-toggle="modal">
				<i class="icon-plus"></i> Tambah Data
			</a>';
}
else
{
	$tombol='';
	$tombol .='';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<link rel="shortcut icon" href="images/add2.png"/>
	<title>scat</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="shortcut icon" href="favicon.png"/>
	<link href="sales-css/bootstrap.min.css" rel="stylesheet" media="screen">
</head>
<body>
 <div align="center" style="border:1px solid;background-color:#20B2AA;"><strong><p>DATA DEVELOPER ADMIN</strong></p></div><br>
	<div class="row" style="width:98%;margin-left:10px;">
		<h3>
			<!-- textbox untuk pencarian -->
			<div class="input-prepend pull-right">
				<span class="add-on"><i class="icon-search"></i></span>
				<input class="span2" id="prependedInput" type="text" name="cari_dev" placeholder="Pencarian All...">
			</div>
			<?=$tombol;?>
		</h3>
		<div id="data-developer"></div>	
	</div>
	
<div id="dialog-developer" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-header">
		<button type="button" class="fa fa-close pull-right " data-dismiss="modal" aria-hidden="true"></button>
		<h3 id="myModalLabel">Tambah Data Developer</h3>
	</div>
	<div class="modal-body"></div>
</div>	
<script src="jquery-1.8.3.min.js"></script>
<script src="sales-js/bootstrap.min.js"></script>
<script src="aplikasi.data.developerr.js"></script>
</body>
</html>
